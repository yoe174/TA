<?php

namespace App\Filament\Resources\ComparisonMatrixAhps\Schemas;

use App\Models\CriteriaAHP;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
// use Filament\Forms\Components\TextInput;
// use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ComparisonMatrixAhpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('criteria_id_from')
                //     ->label('Kriteria Dari')
                //     ->required(),
                // TextInput::make('criteria_id_to')
                //     ->label('Kriteria Ke')
                //     ->required(),
                // TextInput::make('value')
                //     ->label('Nilai Perbandingan')
                //     ->required()
                //     ->numeric()
                //     ->minValue(0.0001)
                //     ->maxValue(9),
                // Section::make('Input Perbandingan')
                //     ->schema([
                        Select::make('criteria_id_from')
                            ->label('Kriteria (Baris)')
                            ->options(CriteriaAHP::orderBy('kode')->pluck('nama_kriteria', 'id'))
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->disabled(fn ($record) => $record !== null), // Disable saat edit

                        Select::make('criteria_id_to')
                            ->label('Kriteria (Kolom)')
                            ->options(CriteriaAHP::orderBy('kode')->pluck('nama_kriteria', 'id'))
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->disabled(fn ($record) => $record !== null), // Disable saat edit

                        Select::make('value')
                            ->label('Nilai Perbandingan')
                            ->options([
                                '9'      => '9 — Mutlak lebih penting',
                                '7'      => '7 — Sangat lebih penting',
                                '5'      => '5 — Lebih penting',
                                '3'      => '3 — Sedikit lebih penting',
                                '1'      => '1 — Sama penting',
                                '0.3333' => '1/3 — Sedikit kurang penting',
                                '0.2'    => '1/5 — Kurang penting',
                                '0.1429' => '1/7 — Sangat kurang penting',
                                '0.1111' => '1/9 — Mutlak kurang penting',
                            ])
                            ->required()
                            ->native(false),

                        Placeholder::make('Info Input Perbandingan')
                            ->label('')
                            ->content('Nilai diagonal (A vs A) otomatis = 1. Nilai kebalikan (reciprocal) otomatis dihitung saat menyimpan.'),
                    // ])
                    // ->columns(2),

                // Section::make('Info')
                //     ->schema([
                //         Placeholder::make('info')
                //             ->label('')
                //             ->content('Nilai diagonal (A vs A) otomatis = 1. Nilai kebalikan (reciprocal) otomatis dihitung saat menyimpan.'),
                //     ]),
            ]);
    }
}
