<?php

namespace App\Filament\Resources\PeriodeSmarts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PeriodeSmartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Periode')
                ->schema([
                    Select::make('bulan')
                        ->label('Bulan')
                        ->options([
                            1  => 'Januari',
                            2  => 'Februari',
                            3  => 'Maret',
                            4  => 'April',
                            5  => 'Mei',
                            6  => 'Juni',
                            7  => 'Juli',
                            8  => 'Agustus',
                            9  => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ])
                        ->required()
                        ->native(false)
                        ->disabled(fn($record) => $record?->status === 'selesai'),

                    Select::make('tahun')
                        ->label('Tahun')
                        ->options(function () {
                            $tahunList = [];
                            $tahunSekarang = (int) date('Y');
                            for ($t = $tahunSekarang - 2; $t <= $tahunSekarang + 1; $t++) {
                                $tahunList[$t] = $t;
                            }
                            return $tahunList;
                        })
                        ->default((int) date('Y'))
                        ->required()
                        ->native(false)
                        ->disabled(fn($record) => $record?->status === 'selesai'),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'draft'   => 'Draft',
                            'aktif'   => 'Aktif',
                            'selesai' => 'Selesai',
                        ])
                        ->required()
                        ->native(false)
                        ->disabled(), // status tidak bisa diubah manual dari form
                ])
                ->columns(3),
        ]);
    }
}
