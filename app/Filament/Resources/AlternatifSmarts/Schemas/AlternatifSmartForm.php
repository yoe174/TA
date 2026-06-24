<?php

namespace App\Filament\Resources\AlternatifSmarts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlternatifSmartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Alternatif')
                    ->schema([
                        TextInput::make('kode')
                            ->label('Kode')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(10)
                            ->placeholder('Contoh: A01, A02'),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('telepon')
                            ->label('Telepon')
                            ->tel()
                            ->nullable()
                            ->maxLength(20),

                        Select::make('jabatan')
                            ->label('Jabatan')
                            ->options([
                                'kepala_sekolah' => 'Kepala Sekolah',
                                'guru'           => 'Guru',
                                'staff'          => 'Staff',
                                'lainnya'        => 'Lainnya',
                            ])
                            ->required()
                            ->native(false)
                            ->default('guru'),

                        Select::make('tahun_masuk')
                            ->label('Tahun Masuk')
                            ->options(function () {
                                $options = [];
                                $tahunSekarang = (int) date('Y');
                                for ($t = $tahunSekarang; $t >= $tahunSekarang - 30; $t--) {
                                    $options[$t] = $t;
                                }
                                return $options;
                            })
                            ->required()
                            ->native(false)
                            ->default((int) date('Y')),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif'    => 'Aktif',
                                'nonaktif' => 'Nonaktif',
                            ])
                            ->required()
                            ->native(false)
                            ->default('aktif'),
                    ])->columns(2),

                Section::make('Alamat')
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->nullable()
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
