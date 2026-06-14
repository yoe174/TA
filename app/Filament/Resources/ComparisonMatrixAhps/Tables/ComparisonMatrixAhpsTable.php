<?php

namespace App\Filament\Resources\ComparisonMatrixAhps\Tables;

use App\Models\ComparisonMatrixAHP;
use App\Models\CriteriaAHP;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
// use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class ComparisonMatrixAhpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('criteriaFrom.kode')
                    ->label('Dari (Baris)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('criteriaFrom.nama_kriteria')
                    ->label('Nama Kriteria Baris')
                    ->searchable(),

                TextColumn::make('criteriaTo.kode')
                    ->label('Ke (Kolom)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('criteriaTo.nama_kriteria')
                    ->label('Nama Kriteria Kolom')
                    ->searchable(),

                TextColumn::make('value')
                    ->label('Nilai')
                    ->formatStateUsing(function ($state) {
                        // Tampilkan dalam bentuk pecahan jika < 1
                        if ($state == 1) return '1';
                        if ($state > 1) return number_format($state, 0);
                        // Cari penyebut pecahan
                        $fractions = [
                            '0.5'    => '1/2',
                            '0.3333' => '1/3',
                            '0.25'   => '1/4',
                            '0.2'    => '1/5',
                            '0.1667' => '1/6',
                            '0.1429' => '1/7',
                            '0.125'  => '1/8',
                            '0.1111' => '1/9',
                        ];
                        foreach ($fractions as $decimal => $fraction) {
                            if (abs($state - $decimal) < 0.001) return $fraction;
                        }
                        return number_format($state, 4);
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('criteria_id_from')
                    ->label('Filter Kriteria Baris')
                    ->options(CriteriaAHP::orderBy('kode')->pluck('nama_kriteria', 'id')),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('generate')
                    ->label('Generate Matriks Otomatis')
                    ->icon('heroicon-o-sparkles')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Generate Matriks Perbandingan')
                    ->modalDescription('Ini akan membuat semua pasangan kriteria dengan nilai default 1. Data lama akan dihapus. Lanjutkan?')
                    ->action(function () {
                        $criterias = CriteriaAHP::orderBy('kode')->get();

                        if ($criterias->count() < 2) {
                            Notification::make()
                                ->title('Minimal 2 kriteria diperlukan!')
                                ->danger()
                                ->send();
                            return;
                        }

                        DB::transaction(function () use ($criterias) {
                            ComparisonMatrixAHP::query()->delete();

                            foreach ($criterias as $from) {
                                foreach ($criterias as $to) {
                                    ComparisonMatrixAHP::create([
                                        'criteria_id_from' => $from->id,
                                        'criteria_id_to'   => $to->id,
                                        'value'            => 1, // default sama penting
                                    ]);
                                }
                            }
                        });

                        Notification::make()
                            ->title('Matriks berhasil digenerate!')
                            ->body('Silakan edit nilai perbandingan sesuai kebutuhan.')
                            ->success()
                            ->send();
                    })
            ]);
    }
}
