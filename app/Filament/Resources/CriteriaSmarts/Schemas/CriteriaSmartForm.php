<?php

namespace App\Filament\Resources\CriteriaSmarts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;

class CriteriaSmartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Kriteria SMART')
                ->schema([
                    TextInput::make('kode')
                        ->label('Kode')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(10)
                        ->placeholder('Contoh: K1, K2'),

                    TextInput::make('nama_kriteria')
                        ->label('Nama Kriteria')
                        ->required()
                        ->maxLength(255),

                    Select::make('jenis')
                        ->label('Jenis')
                        ->options([
                            'benefit' => 'Benefit',
                            'cost'    => 'Cost',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('bobot')
                        ->label('Bobot')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1)
                        ->step(0.000001)
                        ->placeholder('Contoh: 0.250000'),
                ])
                ->columns(2),

            Section::make('Pengaturan Penilaian')
                ->schema([
                    Toggle::make('use_parameter')
                        ->label('Gunakan Parameter')
                        ->helperText('Aktifkan jika penilaian menggunakan pilihan parameter (dropdown). Nonaktifkan jika menggunakan input angka langsung.')
                        ->default(false)
                        ->onColor('success')
                        ->offColor('gray'),

                    Placeholder::make('info_parameter')
                        ->label('')
                        ->content('Jika diaktifkan, pastikan mengisi data parameter di menu Parameter SMART setelah menyimpan kriteria ini.'),
                ]),
            ]);
    }
}
