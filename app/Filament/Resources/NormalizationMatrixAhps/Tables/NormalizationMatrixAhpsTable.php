<?php

namespace App\Filament\Resources\NormalizationMatrixAhps\Tables;

use App\Models\CriteriaAHP;
use App\Services\AhpCalculationService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;


class NormalizationMatrixAhpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('criteriaFrom.kode')
                    ->label('Kriteria (Baris)')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('criteriaFrom.nama_kriteria')
                    ->label('Nama Kriteria Baris')
                    ->searchable(),

                TextColumn::make('criteriaTo.kode')
                    ->label('Kriteria (Kolom)')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('criteriaTo.nama_kriteria')
                    ->label('Nama Kriteria Kolom')
                    ->searchable(),

                TextColumn::make('normalized_value')
                    ->label('Nilai Normalisasi')
                    ->formatStateUsing(fn ($state) => number_format($state, 4))
                    ->sortable(),

                TextColumn::make('priority_vector')
                    ->label('Priority Vector (Bobot)')
                    ->formatStateUsing(fn ($state) => number_format($state, 4))
                    ->sortable(),
            ])
            // ->defaultSort('criteria_id_from', 'asc')
            // ->paginated(false)

            ->filters([
                SelectFilter::make('criteria_id_from')
                    ->label('Filter Kriteria Baris')
                    ->options(CriteriaAHP::orderBy('kode')->pluck('nama_kriteria', 'id')),

                SelectFilter::make('criteria_id_to')
                    ->label('Filter Kriteria Kolom')
                    ->options(CriteriaAHP::orderBy('kode')->pluck('nama_kriteria', 'id')),
            ])
            ->headerActions([
                Action::make('hitung')
                    ->label('Hitung Normalisasi')
                    ->icon('heroicon-o-calculator')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Hitung Normalisasi AHP')
                    ->modalDescription('Proses ini akan menghitung ulang normalisasi dan bobot. Lanjutkan?')
                    ->action(function () {
                        $service = new AhpCalculationService();
                        $result  = $service->calculate();

                        if (isset($result['error'])) {
                            Notification::make()
                                ->title('Gagal!')
                                ->body($result['error'])
                                ->danger()
                                ->send();
                            return;
                        }

                        $status = $result['isConsistent']
                            ? '✅ Konsisten (CR = ' . number_format($result['cr'], 4) . ')'
                            : '❌ Tidak Konsisten (CR = ' . number_format($result['cr'], 4) . ')';
 
                        Notification::make()
                            ->title('Perhitungan Selesai!')
                            ->body("λ_max: {$result['lambdaMax']} | CI: {$result['ci']} | CR: {$result['cr']} | {$status}")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('criteria_id_from', 'asc')
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
