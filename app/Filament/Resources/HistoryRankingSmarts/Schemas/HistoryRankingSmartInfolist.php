<?php

namespace App\Filament\Resources\HistoryRankingSmarts\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HistoryRankingSmartInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Periode')
                ->schema([
                    TextEntry::make('periodeSmart.label')
                        ->label('Periode')
                        ->getStateUsing(fn($record) => $record->periodeSmart?->nama_bulan . ' ' . $record->periodeSmart?->tahun),

                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn($state) => $state === 'valid' ? 'success' : 'danger'),

                    TextEntry::make('keterangan')
                        ->label('Keterangan')
                        ->placeholder('Tidak ada keterangan'),

                    TextEntry::make('created_at')
                        ->label('Tanggal Ekspor')
                        ->dateTime('d M Y, H:i'),
                ])
                ->columns(4),

            Section::make('Hasil Rangking Periode Ini')
                ->schema([
                    RepeatableEntry::make('detail_snapshot.alternatif')
                        ->label('')
                        ->schema([
                            TextEntry::make('rangking')
                                ->label('Rangking')
                                ->badge()
                                ->color(fn($state) => match (true) {
                                    $state === 1 => 'success',
                                    $state === 2 => 'info',
                                    $state === 3 => 'warning',
                                    default      => 'gray',
                                }),

                            TextEntry::make('kode')
                                ->label('Kode'),

                            TextEntry::make('nama')
                                ->label('Nama'),

                            TextEntry::make('jabatan')
                                ->label('Jabatan')
                                ->formatStateUsing(fn($state) => match ($state) {
                                    'kepala_sekolah' => 'Kepala Sekolah',
                                    'guru'           => 'Guru',
                                    'staff'          => 'Staff',
                                    default          => 'Lainnya',
                                }),

                            TextEntry::make('nilai_total')
                                ->label('Nilai Total')
                                ->formatStateUsing(fn($state) => number_format($state, 6))
                                ->weight('bold'),
                        ])
                        ->columns(5),
                ]),
        ]);
    }
}
