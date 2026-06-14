<?php

namespace App\Filament\Resources\CriteriaAHPS\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CriteriaAHPForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kriteria')
                    ->label('Nama Kriteria')
                    ->required(),
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->unique(table: 'criteria_ahp', column: 'kode', ignoreRecord: true),
                Select::make('jenis')
                    ->label('Jenis')
                    ->required()
                    ->options([
                        'benefit' => 'Benefit',
                        'cost' => 'Cost',
                    ]),
            ]);
    }
}
