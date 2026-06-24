<?php

namespace App\Filament\Resources\PenilaianSmarts\Tables;

use App\Filament\Resources\PenilaianSmarts\PenilaianSmartResource;
use App\Models\AlternatifSmart;
use App\Models\PenilaianSmart;
use App\Models\PeriodeSmart;
use App\Services\PenilaianSmartService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use App\Services\ProsesOtomatisSmartService;

class PenilaianSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                // Tampilkan daftar alternatif aktif di periode aktif
                AlternatifSmart::query()->aktif()->orderBy('kode')
            )
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Alternatif')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'kepala_sekolah' => 'Kepala Sekolah',
                        'guru'           => 'Guru',
                        'staff'          => 'Staff',
                        default          => 'Lainnya',
                    }),

                // Status pengisian nilai
                BadgeColumn::make('status_penilaian')
                    ->label('Status Penilaian')
                    ->getStateUsing(function ($record) {
                        $periode = PeriodeSmart::where('status', 'aktif')->first();
                        if (!$periode) return 'Tidak Ada Periode';

                        $total = PenilaianSmart::where('periode_smart_id', $periode->id)
                            ->where('alternatif_smart_id', $record->id)
                            ->count();

                        if ($total === 0) return 'Belum Diisi';

                        $terisi = PenilaianSmart::where('periode_smart_id', $periode->id)
                            ->where('alternatif_smart_id', $record->id)
                            ->where(function ($q) {
                                $q->whereNotNull('parameter_smart_id')
                                    ->orWhereNotNull('nilai_manual');
                            })
                            ->count();

                        return $terisi === $total ? 'Lengkap' : 'Sebagian';
                    })
                    ->colors([
                        'gray'    => 'Belum Diisi',
                        'warning' => 'Sebagian',
                        'success' => 'Lengkap',
                        'danger'  => 'Tidak Ada Periode',
                    ]),
            ])
            ->filters([
                SelectFilter::make('jabatan')
                    ->label('Filter Jabatan')
                    ->options([
                        'kepala_sekolah' => 'Kepala Sekolah',
                        'guru'           => 'Guru',
                        'staff'          => 'Staff',
                        'lainnya'        => 'Lainnya',
                    ]),
            ])
            ->headerActions([
                Action::make('generate')
                    ->label('Generate Penilaian')
                    ->icon('heroicon-o-sparkles')
                    ->color('success')
                    ->visible(function () {
                        return PeriodeSmart::where('status', 'aktif')->exists();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Generate Penilaian')
                    ->modalDescription('Sistem akan membuat baris penilaian untuk semua alternatif aktif dan semua kriteria. Data yang sudah ada tidak akan dihapus.')
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

                        $service = new PenilaianSmartService();
                        $result  = $service->generate($periode);

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->send();
                            return;
                        }

                        Notification::make()
                            ->title('Generate Berhasil!')
                            ->body("{$result['added']} baris ditambahkan, {$result['skipped']} dilewati.")
                            ->success()
                            ->send();
                    }),
                Action::make('proses_otomatis')
                    ->label('Hitung Utilitas & Hasil Akhir')
                    ->icon('heroicon-o-bolt')
                    ->color('warning')
                    ->visible(function () {
                        return PeriodeSmart::where('status', 'aktif')->exists();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Proses Otomatis')
                    ->modalDescription('Sistem akan menghitung Utilitas dan Hasil Akhir sekaligus secara berurutan. Lanjutkan?')
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

                        $service = new ProsesOtomatisSmartService();
                        $result  = $service->prosesSemua($periode);

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
                            ->title('Proses Otomatis Selesai!')
                            ->body("Utilitas: {$result['utilitas_processed']} data, Hasil Akhir: {$result['hasil_akhir_processed']} alternatif diranking.")
                            ->success()
                            ->send();
                    }),
            ])
            // ->actions([
            //     Action::make('isi_nilai')
            //         ->label('Isi Nilai')
            //         ->icon('heroicon-o-pencil-square')
            //         ->color('primary')
            //         ->visible(function () {
            //             return PeriodeSmart::where('status', 'aktif')->exists();
            //         })
            //         ->url(fn ($record) => PenilaianSmartResource::getUrl('isi-nilai', [
            //             'alternatifId' => $record->id,
            //         ])),
            // ])
            ->recordActions([
                // EditAction::make(),
                Action::make('isi_nilai')
                    ->label('Isi Nilai')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->visible(function () {
                        return PeriodeSmart::where('status', 'aktif')->exists();
                    })
                    ->url(fn($record) => PenilaianSmartResource::getUrl('isi-nilai', [
                        'alternatifId' => $record->id,
                    ])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('kode', 'asc');
    }
}
