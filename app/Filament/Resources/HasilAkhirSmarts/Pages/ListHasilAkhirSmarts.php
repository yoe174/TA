<?php

namespace App\Filament\Resources\HasilAkhirSmarts\Pages;

use App\Filament\Resources\HasilAkhirSmarts\HasilAkhirSmartResource;
// use Filament\Actions\CreateAction;
use App\Models\PeriodeSmart;
use Filament\Resources\Pages\ListRecords;

class ListHasilAkhirSmarts extends ListRecords
{
    protected static string $resource = HasilAkhirSmartResource::class;

    public function getHeading(): string
    {
        $periode = PeriodeSmart::where('status', 'aktif')->first();

        if (!$periode) {
            return 'Hasil Akhir — Tidak Ada Periode Aktif';
        }

        return "Hasil Akhir & Rangking — {$periode->nama_bulan} {$periode->tahun}";
    }

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
