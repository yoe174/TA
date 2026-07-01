<?php

namespace App\Filament\Resources\ParameterSmarts\Schemas;

use App\Models\CriteriaSmart;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ParameterSmartForm
{
    // public static function configure(Schema $schema): Schema
    // {
    //     return $schema
    //         ->components([
    //             Section::make('Data Parameter SMART')
    //                 ->schema([
    //                     Select::make('criteria_smart_id')
    //                         ->label('Kriteria SMART')
    //                         ->options(
    //                             CriteriaSmart::where('use_parameter', true)
    //                                 ->orderBy('kode')
    //                                 ->get()
    //                                 ->mapWithKeys(fn($c) => [$c->id => "{$c->kode} - {$c->nama_kriteria}"])
    //                         )
    //                         ->required()
    //                         ->native(false)
    //                         ->searchable(),

    //                     Select::make('nilai')
    //                         ->label('Nilai')
    //                         ->options([
    //                             1 => '1 — Sangat Kurang',
    //                             2 => '2 — Kurang',
    //                             3 => '3 — Cukup',
    //                             4 => '4 — Baik',
    //                             5 => '5 — Sangat Baik',
    //                         ])
    //                         ->required()
    //                         ->native(false),

    //                     TextInput::make('label')
    //                         ->label('Label Parameter')
    //                         ->required()
    //                         ->maxLength(100)
    //                         ->placeholder('Contoh: Sangat Baik, Terlambat 1x, > 5 Tahun'),
    //                 ])
    //                 ->columns(3),
    //         ]);
    // }
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
                            ->searchable()
                            ->live() // agar form reaktif saat pilihan berubah
                            ->afterStateUpdated(fn ($state, callable $set) => $set('_jenis_kriteria',
                                $state ? CriteriaSmart::find($state)?->jenis : null
                            )),

                        // Field hidden untuk menyimpan jenis kriteria sementara
                        \Filament\Forms\Components\Hidden::make('_jenis_kriteria'),

                        // Badge jenis kriteria — muncul setelah kriteria dipilih
                        Placeholder::make('info_jenis')
                            ->label('Jenis Kriteria')
                            ->content(function ($get): HtmlString {
                                $jenis = $get('_jenis_kriteria');

                                if (!$jenis) {
                                    return new HtmlString('<span style="color: #888;">— Pilih kriteria terlebih dahulu —</span>');
                                }

                                if ($jenis === 'benefit') {
                                    return new HtmlString('
                                        <span style="
                                            background-color: #dcfce7;
                                            color: #166534;
                                            padding: 3px 10px;
                                            border-radius: 999px;
                                            font-weight: 600;
                                            font-size: 13px;
                                        ">✓ BENEFIT</span>
                                    ');
                                }

                                return new HtmlString('
                                    <span style="
                                        background-color: #fee2e2;
                                        color: #991b1b;
                                        padding: 3px 10px;
                                        border-radius: 999px;
                                        font-weight: 600;
                                        font-size: 13px;
                                    ">✗ COST</span>
                                ');
                            }),

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

                // Keterangan COST — hanya muncul jika kriteria yang dipilih adalah cost
                Section::make('⚠️ Perhatian Pengisian Parameter COST')
                    ->schema([
                        Placeholder::make('keterangan_cost')
                            ->label('')
                            ->content(new HtmlString('
                                <div style="line-height: 1.8; font-size: 13px;">
                                    <p>Kriteria <strong>COST</strong> berarti <strong>semakin kecil nilainya, semakin baik</strong>.</p>
                                    <p>Pada saat perhitungan utilitas, rumus yang digunakan adalah:</p>
                                    <p style="text-align:center; font-style:italic; margin: 8px 0;">
                                        U = (Max − Nilai) / (Max − Min)
                                    </p>
                                    <p>Oleh karena itu, <strong>isi nilai parameter secara terbalik</strong> dibandingkan kriteria Benefit:</p>
                                    <table style="width:100%; border-collapse:collapse; margin-top:8px;">
                                        <thead>
                                            <tr style="background:#fee2e2;">
                                                <th style="border:1px solid #ccc; padding:5px;">Nilai</th>
                                                <th style="border:1px solid #ccc; padding:5px;">Artinya</th>
                                                <th style="border:1px solid #ccc; padding:5px;">Contoh: Keterlambatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="border:1px solid #ccc; padding:5px; text-align:center;">5</td>
                                                <td style="border:1px solid #ccc; padding:5px;">Kondisi paling buruk</td>
                                                <td style="border:1px solid #ccc; padding:5px;">&gt; 6 kali terlambat</td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid #ccc; padding:5px; text-align:center;">4</td>
                                                <td style="border:1px solid #ccc; padding:5px;">Buruk</td>
                                                <td style="border:1px solid #ccc; padding:5px;">5-6 kali terlambat</td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid #ccc; padding:5px; text-align:center;">3</td>
                                                <td style="border:1px solid #ccc; padding:5px;">Cukup</td>
                                                <td style="border:1px solid #ccc; padding:5px;">3-4 kali terlambat</td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid #ccc; padding:5px; text-align:center;">2</td>
                                                <td style="border:1px solid #ccc; padding:5px;">Baik</td>
                                                <td style="border:1px solid #ccc; padding:5px;">1-2 kali terlambat</td>
                                            </tr>
                                            <tr style="background:#dcfce7;">
                                                <td style="border:1px solid #ccc; padding:5px; text-align:center;">1</td>
                                                <td style="border:1px solid #ccc; padding:5px;">Kondisi terbaik</td>
                                                <td style="border:1px solid #ccc; padding:5px;">0 kali terlambat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p style="margin-top:10px; color:#991b1b;">
                                        ❌ Jangan isi nilai 5 untuk kondisi terbaik pada kriteria Cost — itu akan membalik hasil perhitungan utilitas!
                                    </p>
                                </div>
                            ')),
                    ])
                    ->visible(fn ($get): bool => $get('_jenis_kriteria') === 'cost')
                    ->collapsible()
                    ->collapsed(false)
                    ->extraAttributes(['style' => 'border: 2px solid #fca5a5; background-color: #fff7f7;']),
            ]);
    }
}
