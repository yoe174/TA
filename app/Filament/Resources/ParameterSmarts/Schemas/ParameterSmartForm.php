<?php

namespace App\Filament\Resources\ParameterSmarts\Schemas;

use App\Models\CriteriaSmart;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ParameterSmartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Parameter SMART')
                    ->schema([
                        Select::make('criteria_smart_id')
                            ->label('Kriteria SMART')
                            ->options(
                                CriteriaSmart::where('use_parameter', true)
                                    ->orderBy('kode')
                                    ->get()
                                    ->mapWithKeys(fn($c) => [$c->id => "{$c->kode} - {$c->nama_kriteria}"])
                            )
                            ->required()
                            ->native(false)
                            ->searchable(),

                        Select::make('nilai')
                            ->label('Nilai')
                            ->options([
                                1 => '1 — Sangat Kurang',
                                2 => '2 — Kurang',
                                3 => '3 — Cukup',
                                4 => '4 — Baik',
                                5 => '5 — Sangat Baik',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('label')
                            ->label('Label Parameter')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Sangat Baik, Terlambat 1x, > 5 Tahun'),
                    ])
                    ->columns(3),
            ]);
    }
}
