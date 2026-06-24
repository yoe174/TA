<?php

namespace App\Filament\Resources\HasilAkhirSmarts\Tables;

use App\Models\HasilAkhirSmart;
use App\Models\PeriodeSmart;
use App\Services\HasilAkhirSmartService;
use App\Services\HistoryRankingSmartService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HasilAkhirSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rangking')
                    ->label('Rangking')
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state === 1 => 'success',
                        $state === 2 => 'info',
                        $state === 3 => 'warning',
                        default      => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('alternatifSmart.kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alternatifSmart.nama')
                    ->label('Nama Alternatif')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alternatifSmart.jabatan')
                    ->label('Jabatan')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'kepala_sekolah' => 'Kepala Sekolah',
                        'guru'           => 'Guru',
                        'staff'          => 'Staff',
                        default          => 'Lainnya',
                    }),

                TextColumn::make('nilai_total')
                    ->label('Nilai Total')
                    ->formatStateUsing(fn($state) => number_format($state, 6))
                    ->sortable(),
            ])
            ->headerActions([
                Action::make('ekspor_history')
                    ->label('Ekspor ke History')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Ekspor Hasil Akhir ke History')
                    ->modalDescription('Data hasil akhir periode aktif akan disimpan permanen ke History. Setelah ini, data Utilitas & Hasil Akhir akan dikosongkan dan periode akan ditutup (selesai). Penilaian tetap disimpan. Lanjutkan?')
                    ->action(function () {
                        $periode = PeriodeSmart::where('status', 'aktif')->first();

                        if (!$periode) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body('Tidak ada periode aktif.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $service = new HistoryRankingSmartService();
                        $result  = $service->eksporKeHistory($periode);

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->send();
                            return;
                        }

                        Notification::make()
                            ->title('Ekspor Berhasil!')
                            ->body("Hasil akhir periode {$result['periode']} berhasil disimpan ke History. Periode telah selesai.")
                            ->success()
                            ->persistent()
                            ->send();
                    }),
                Action::make('hitung_hasil_akhir')
                    ->label('Hitung Hasil Akhir')
                    ->icon('heroicon-o-trophy')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Hitung Hasil Akhir & Rangking')
                    ->modalDescription('Sistem akan menjumlahkan utilitas × bobot tiap alternatif dan mengurutkan rangking. Data lama akan diganti. Lanjutkan?')
                    ->action(function () {
                        $periode = PeriodeSmart::where('status', 'aktif')->first();

                        if (!$periode) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body('Tidak ada periode aktif.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $service = new HasilAkhirSmartService();
                        $result  = $service->hitung($periode);

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->send();
                            return;
                        }

                        Notification::make()
                            ->title('Berhasil!')
                            ->body("{$result['processed']} alternatif berhasil diranking untuk periode {$result['periode']}.")
                            ->success()
                            ->send();
                    }),
                Action::make('kosongkan_hasil_akhir')
                    ->label('Kosongkan Data')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Kosongkan Data Hasil Akhir?')
                    ->modalDescription('Semua data hasil akhir & rangking periode ini akan dihapus. Tindakan ini tidak bisa dibatalkan.')
                    ->action(function () {
                        $periode = PeriodeSmart::where('status', 'aktif')->first();

                        if (!$periode) {
                            Notification::make()->title('Tidak ada periode aktif.')->danger()->send();
                            return;
                        }

                        HasilAkhirSmart::where('periode_smart_id', $periode->id)->delete();

                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Data hasil akhir telah dikosongkan.')
                            ->success()
                            ->send();
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat Detail'),
            ])
            ->defaultSort('rangking', 'asc')
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
