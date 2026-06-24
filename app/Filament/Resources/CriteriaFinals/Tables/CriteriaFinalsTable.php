<?php

namespace App\Filament\Resources\CriteriaFinals\Tables;

use App\Models\CriteriaFinal;
use App\Models\WeightAhpResult;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use App\Services\LaporanPdfAhpService;

class CriteriaFinalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_kriteria')
                    ->label('Nama Kriteria')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('jenis')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'benefit',
                        'danger'  => 'cost',
                    ]),

                TextColumn::make('bobot')
                    ->label('Bobot')
                    ->formatStateUsing(fn($state) => number_format($state, 6))
                    ->sortable(),

                TextColumn::make('bobot_persen')
                    ->label('Bobot (%)')
                    ->getStateUsing(fn($record) => number_format($record->bobot * 100, 2) . '%'),

                TextColumn::make('cr')
                    ->label('CR saat Ekspor')
                    ->formatStateUsing(fn($state) => number_format($state, 6)),

                BadgeColumn::make('is_consistent')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => $state ? 'Konsisten' : 'Tidak Konsisten')
                    ->colors([
                        'success' => true,
                        'danger'  => false,
                    ]),

                TextColumn::make('updated_at')
                    ->label('Terakhir Ekspor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->label('Filter Jenis')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost'    => 'Cost',
                    ]),
            ])
            ->headerActions([
                Action::make('cetak_laporan_ahp')
                    ->label('Cetak Laporan AHP')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->action(function () {
                        $service = new LaporanPdfAhpService();
                        $result  = $service->generate();

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->send();
                            return;
                        }

                        $pdf = $result['pdf'];

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            'laporan-pembobotan-ahp.pdf'
                        );
                    }),
                Action::make('ekspor')
                    ->label('Ekspor ke Kriteria Final')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Ekspor Kriteria & Bobot')
                    ->modalDescription('Data weight results yang sudah konsisten akan disalin ke Kriteria Final. Data lama akan diganti. Lanjutkan?')
                    ->action(function () {
                        // Cek apakah weight_results ada dan konsisten
                        $weightResults = WeightAhpResult::with('criteria')->get();

                        if ($weightResults->isEmpty()) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body('Belum ada data bobot. Silakan hitung normalisasi terlebih dahulu.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek konsistensi — ambil dari record pertama
                        $firstResult = $weightResults->first();
                        if (!$firstResult->is_consistent) {
                            Notification::make()
                                ->title('Gagal! Data Tidak Konsisten')
                                ->body('CR = ' . number_format($firstResult->cr, 4) . ' (> 0.1). Perbaiki matriks perbandingan terlebih dahulu sebelum ekspor.')
                                ->danger()
                                ->persistent()
                                ->send();
                            return;
                        }

                        // Ekspor ke criteria_finals
                        DB::transaction(function () use ($weightResults) {
                            CriteriaFinal::query()->delete();

                            foreach ($weightResults as $wr) {
                                CriteriaFinal::create([
                                    'criteria_ahp_id'   => $wr->criteria_ahp_id,
                                    'kode'          => $wr->criteria->kode,
                                    'nama_kriteria' => $wr->criteria->nama_kriteria,
                                    'jenis'         => $wr->criteria->jenis,
                                    'bobot'         => $wr->bobot,
                                    'ri'            => $wr->ri,
                                    'cr'            => $wr->cr,
                                    'is_consistent' => $wr->is_consistent,
                                ]);
                            }
                        });

                        Notification::make()
                            ->title('Ekspor Berhasil!')
                            ->body('Data kriteria dan bobot berhasil disimpan ke Kriteria Final.')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('kode', 'asc')
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
