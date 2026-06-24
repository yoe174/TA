<?php

namespace App\Filament\Resources\AlternatifSmarts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class AlternatifSmartsTable
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

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'kepala_sekolah' => 'Kepala Sekolah',
                        'guru'           => 'Guru',
                        'staff'          => 'Staff',
                        default          => 'Lainnya',
                    })
                    ->sortable(),

                TextColumn::make('tahun_masuk')
                    ->label('Tahun Masuk')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'aktif',
                        'danger'  => 'nonaktif',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
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

                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'aktif'    => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ]),
            ])
            // ->actions([
            //     EditAction::make(),
            // ])
            // ->bulkActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
            // ;
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
