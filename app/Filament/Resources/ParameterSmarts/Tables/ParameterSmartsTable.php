<?php

namespace App\Filament\Resources\ParameterSmarts\Tables;

use App\Models\CriteriaSmart;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ParameterSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('criteriaSmart.kode')
                    ->label('Kode Kriteria')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('criteriaSmart.nama_kriteria')
                    ->label('Nama Kriteria')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nilai')
                    ->label('Nilai')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('label')
                    ->label('Label Parameter')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('criteria_smart_id')
                    ->label('Filter Kriteria')
                    ->options(
                        CriteriaSmart::where('use_parameter', true)
                            ->orderBy('kode')
                            ->get()
                            ->mapWithKeys(fn ($c) => [$c->id => "{$c->kode} - {$c->nama_kriteria}"])
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('criteria_smart_id', 'asc');
    }
}
