<?php

namespace App\Filament\Resources\HasilUtilitasSmarts\Tables;

use App\Models\AlternatifSmart;
use App\Models\CriteriaSmart;
use App\Models\HasilUtilitasSmart;
use App\Models\PeriodeSmart;
use App\Services\UtilitasSmartService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class HasilUtilitasSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('alternatifSmart.kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alternatifSmart.nama')
                    ->label('Nama Alternatif')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('criteriaSmart.kode')
                    ->label('Kode Kriteria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('criteriaSmart.nama_kriteria')
                    ->label('Nama Kriteria')
                    ->searchable(),

                BadgeColumn::make('criteriaSmart.jenis')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'benefit',
                        'danger'  => 'cost',
                    ]),

                TextColumn::make('nilai_aktual')
                    ->label('Nilai')
                    ->formatStateUsing(fn($state) => number_format($state, 2))
                    ->sortable(),

                TextColumn::make('nilai_min')
                    ->label('Min')
                    ->formatStateUsing(fn($state) => number_format($state, 2))
                    ->sortable(),

                TextColumn::make('nilai_max')
                    ->label('Max')
                    ->formatStateUsing(fn($state) => number_format($state, 2))
                    ->sortable(),

                TextColumn::make('nilai_utilitas')
                    ->label('Utilitas')
                    ->formatStateUsing(fn($state) => number_format($state, 6))
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('alternatif_smart_id')
                    ->label('Filter Alternatif')
                    ->options(
                        AlternatifSmart::aktif()
                            ->orderBy('kode')
                            ->pluck('nama', 'id')
                    ),

                SelectFilter::make('criteria_smart_id')
                    ->label('Filter Kriteria')
                    ->options(
                        CriteriaSmart::orderBy('kode')
                            ->get()
                            ->mapWithKeys(fn($c) => [$c->id => "{$c->kode} - {$c->nama_kriteria}"])
                    ),

                SelectFilter::make('jenis')
                    ->label('Filter Jenis')
                    ->relationship('criteriaSmart', 'jenis')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost'    => 'Cost',
                    ]),
            ])
            ->headerActions([
                Action::make('hitung_utilitas')
                    ->label('Hitung Utilitas')
                    ->icon('heroicon-o-calculator')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Hitung Utilitas SMART')
                    ->modalDescription('Sistem akan menghitung nilai utilitas semua alternatif berdasarkan penilaian yang sudah diisi. Lanjutkan?')
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

                        $service = new UtilitasSmartService();
                        $result  = $service->hitung($periode);

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->persistent()
                                ->send();
                            return;
                        }

                        Notification::make()
                            ->title('Berhasil!')
                            ->body("{$result['processed']} utilitas berhasil dihitung untuk periode {$result['periode']}.")
                            ->success()
                            ->send();
                    }),
                    Action::make('kosongkan_utilitas')
                    ->label('Kosongkan Data')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Kosongkan Data Utilitas?')
                    ->modalDescription('Semua data hasil utilitas periode ini akan dihapus. Tindakan ini tidak bisa dibatalkan.')
                    ->action(function () {
                        $periode = PeriodeSmart::where('status', 'aktif')->first();

                        if (!$periode) {
                            Notification::make()->title('Tidak ada periode aktif.')->danger()->send();
                            return;
                        }

                        HasilUtilitasSmart::where('periode_smart_id', $periode->id)->delete();

                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Data utilitas telah dikosongkan.')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('alternatif_smart_id', 'asc')
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
