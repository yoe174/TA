<?php

namespace App\Filament\Resources\HasilAkhirSmarts\Schemas;

use App\Models\HasilUtilitasSmart;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class HasilAkhirSmartInfolist
{
    public static function configure(Schema $schema): Schema
    {
        // return $schema
        //     ->components([
        //         Section::make('Informasi Alternatif')
        //             ->schema([
        //                 TextEntry::make('alternatifSmart.kode')
        //                     ->label('Kode'),

        //                 TextEntry::make('alternatifSmart.nama')
        //                     ->label('Nama'),

        //                 TextEntry::make('rangking')
        //                     ->label('Rangking')
        //                     ->badge()
        //                     ->color(fn($state) => match (true) {
        //                         $state === 1 => 'success',
        //                         $state === 2 => 'info',
        //                         $state === 3 => 'warning',
        //                         default      => 'gray',
        //                     }),

        //                 TextEntry::make('nilai_total')
        //                     ->label('Nilai Total')
        //                     ->formatStateUsing(fn($state) => number_format($state, 6))
        //                     ->weight('bold'),
        //             ])
        //             ->columns(4),

        //         Section::make('Detail Perhitungan per Kriteria')
        //             ->schema([
        //                 RepeatableEntry::make('detail_kriteria')
        //                     ->label('')
        //                     ->getStateUsing(function ($record) {
        //                         return HasilUtilitasSmart::where('periode_smart_id', $record->periode_smart_id)
        //                             ->where('alternatif_smart_id', $record->alternatif_smart_id)
        //                             ->with('criteriaSmart')
        //                             ->get()
        //                             ->map(function ($u) {
        //                                 return [
        //                                     'kriteria'  => "{$u->criteriaSmart->kode} - {$u->criteriaSmart->nama_kriteria}",
        //                                     'jenis'     => $u->criteriaSmart->jenis,
        //                                     'bobot'     => $u->criteriaSmart->bobot,
        //                                     'utilitas'  => $u->nilai_utilitas,
        //                                     'skor'      => $u->nilai_utilitas * $u->criteriaSmart->bobot,
        //                                 ];
        //                             })
        //                             ->toArray();
        //                     })
        //                     ->schema([
        //                         TextEntry::make('kriteria')
        //                             ->label('Kriteria'),

        //                         TextEntry::make('jenis')
        //                             ->label('Jenis')
        //                             ->badge()
        //                             ->color(fn($state) => $state === 'benefit' ? 'success' : 'danger'),

        //                         TextEntry::make('bobot')
        //                             ->label('Bobot')
        //                             ->formatStateUsing(fn($state) => number_format($state, 4)),

        //                         TextEntry::make('utilitas')
        //                             ->label('Utilitas')
        //                             ->formatStateUsing(fn($state) => number_format($state, 4)),

        //                         TextEntry::make('skor')
        //                             ->label('Bobot × Utilitas')
        //                             ->formatStateUsing(fn($state) => number_format($state, 6))
        //                             ->weight('bold'),
        //                     ])
        //                     ->columns(5),
        //             ]),
        //     ]);

        return $schema
            ->components([
                // 1. Satukan semua dalam satu Section Utama
                Section::make('View Hasil Akhir')
                    ->description('Detail hasil akhir per alternatif, termasuk perhitungan utilitas × bobot tiap kriteria.')
                    ->schema([
                        
                        // 2. Gunakan Grid untuk membungkus Informasi Alternatif (Posisi Atas)
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('alternatifSmart.kode')
                                    ->label('Kode'),

                                TextEntry::make('alternatifSmart.nama')
                                    ->label('Nama'),

                                TextEntry::make('rangking')
                                    ->label('Rangking')
                                    ->badge()
                                    ->color(fn($state) => match (true) {
                                        $state === 1 => 'success',
                                        $state === 2 => 'info',
                                        $state === 3 => 'warning',
                                        default      => 'gray',
                                    }),

                                TextEntry::make('nilai_total')
                                    ->label('Nilai Total')
                                    ->formatStateUsing(fn($state) => number_format($state, 6))
                                    ->weight('bold'),
                            ]),

                        // 3. Batas pemisah visual antar bagian data
                        Grid::make(1)
                            ->schema([
                                TextEntry::make('-')
                                    ->label('')
                                    ->formatStateUsing(fn() => '')
                                    ->extraAttributes(['class' => 'border-t border-gray-200 dark:border-gray-700 my-4']),
                            ]),

                        // 4. Detail Perhitungan diletakkan langsung di bawahnya
                        RepeatableEntry::make('detail_kriteria')
                            ->label('Detail Perhitungan per Kriteria')
                            ->getStateUsing(function ($record) {
                                return HasilUtilitasSmart::where('periode_smart_id', $record->periode_smart_id)
                                    ->where('alternatif_smart_id', $record->alternatif_smart_id)
                                    ->with('criteriaSmart')
                                    ->get()
                                    ->map(function ($u) {
                                        return [
                                            'kriteria'  => "{$u->criteriaSmart->kode} - {$u->criteriaSmart->nama_kriteria}",
                                            'jenis'     => $u->criteriaSmart->jenis,
                                            'bobot'     => $u->criteriaSmart->bobot,
                                            'utilitas'  => $u->nilai_utilitas,
                                            'skor'      => $u->nilai_utilitas * $u->criteriaSmart->bobot,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->schema([
                                TextEntry::make('kriteria')
                                    ->label('Kriteria'),

                                TextEntry::make('jenis')
                                    ->label('Jenis')
                                    ->badge()
                                    ->color(fn($state) => $state === 'benefit' ? 'success' : 'danger'),

                                TextEntry::make('bobot')
                                    ->label('Bobot')
                                    ->formatStateUsing(fn($state) => number_format($state, 4)),

                                TextEntry::make('utilitas')
                                    ->label('Utilitas')
                                    ->formatStateUsing(fn($state) => number_format($state, 4)),

                                TextEntry::make('skor')
                                    ->label('Bobot × Utilitas')
                                    ->formatStateUsing(fn($state) => number_format($state, 6))
                                    ->weight('bold'),
                            ])
                            ->columns(5),
                    ]),
            ]);
    }
}
