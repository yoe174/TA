<?php

namespace App\Filament\Resources\CriteriaSmarts\Tables;

use App\Models\CriteriaFinal;
use App\Models\CriteriaSmart;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CriteriaSmartsTable
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
                    ->formatStateUsing(fn ($state) => number_format($state, 6))
                    ->sortable(),

                TextColumn::make('bobot_persen')
                    ->label('Bobot (%)')
                    ->getStateUsing(fn ($record) => number_format($record->bobot * 100, 2) . '%'),

                IconColumn::make('use_parameter')
                    ->label('Pakai Parameter')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('parameters_count')
                    ->label('Jumlah Parameter')
                    ->counts('parameters')
                    ->sortable(),

                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->label('Filter Jenis')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost'    => 'Cost',
                    ]),

                SelectFilter::make('use_parameter')
                    ->label('Filter Penilaian')
                    ->options([
                        '1' => 'Pakai Parameter',
                        '0' => 'Input Manual',
                    ]),
            ])
            ->headerActions([
                // Tombol ekspor dari criteria_final
                Action::make('ekspor_dari_final')
                    ->label('Ekspor dari Kriteria Final')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Ekspor dari Kriteria Final')
                    ->modalDescription('Data dari Kriteria Final akan disalin ke Kriteria SMART. Data Kriteria SMART yang sudah ada tidak akan dihapus, hanya ditambahkan yang belum ada. Lanjutkan?')
                    ->action(function () {
                        $criteriaFinals = CriteriaFinal::all();

                        if ($criteriaFinals->isEmpty()) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body('Belum ada data di Kriteria Final. Silakan ekspor dari AHP terlebih dahulu.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $imported = 0;
                        $skipped  = 0;

                        DB::transaction(function () use ($criteriaFinals, &$imported, &$skipped) {
                            foreach ($criteriaFinals as $cf) {
                                // Cek berdasarkan kode, skip jika sudah ada
                                $exists = CriteriaSmart::where('kode', $cf->kode)->exists();

                                if ($exists) {
                                    $skipped++;
                                    continue;
                                }

                                CriteriaSmart::create([
                                    'kode'          => $cf->kode,
                                    'nama_kriteria' => $cf->nama_kriteria,
                                    'jenis'         => $cf->jenis,
                                    'bobot'         => $cf->bobot,
                                    'use_parameter' => false, // default, user atur sendiri
                                    'created_by'    => Auth::id(),
                                ]);

                                $imported++;
                            }
                        });

                        Notification::make()
                            ->title('Ekspor Selesai!')
                            ->body("{$imported} kriteria berhasil diimpor, {$skipped} dilewati (sudah ada).")
                            ->success()
                            ->send();
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('kode', 'asc');
    }
}
