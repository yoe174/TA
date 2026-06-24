<?php

namespace App\Filament\Resources\HasilUtilitasSmarts\Pages;

use App\Filament\Resources\HasilUtilitasSmarts\HasilUtilitasSmartResource;
use App\Models\PeriodeSmart;
use Filament\Resources\Pages\ListRecords;

class ListHasilUtilitasSmarts extends ListRecords
{
    protected static string $resource = HasilUtilitasSmartResource::class;

    public function getHeading(): string
    {
        $periode = PeriodeSmart::where('status', 'aktif')->first();

        if (!$periode) {
            return 'Hasil Utilitas — Tidak Ada Periode Aktif';
        }

        return "Hasil Utilitas — {$periode->nama_bulan} {$periode->tahun}";
    }

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
