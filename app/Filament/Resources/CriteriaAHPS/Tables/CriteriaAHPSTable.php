<?php

namespace App\Filament\Resources\CriteriaAHPS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CriteriaAHPSTable
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

                // TextColumn::make('created_at')
                //     ->label('Dibuat')
                //     ->dateTime('d M Y')
                //     ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->label('Jenis')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost' => 'Cost',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
