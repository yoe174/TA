<?php

namespace App\Filament\Resources\PenilaianSmarts\Pages;

use App\Filament\Resources\PenilaianSmarts\PenilaianSmartResource;
use App\Models\PeriodeSmart;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianSmarts extends ListRecords
{
    protected static string $resource = PenilaianSmartResource::class;

    // Tampilkan info periode aktif di heading
    public function getHeading(): string
    {
        $periode = PeriodeSmart::where('status', 'aktif')->first();

        if (!$periode) {
            return 'Penilaian — Tidak Ada Periode Aktif';
        }

        return "Penilaian — {$periode->nama_bulan} {$periode->tahun}";
    }
    
    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
