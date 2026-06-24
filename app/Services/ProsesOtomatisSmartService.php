<?php

namespace App\Services;

use App\Models\PeriodeSmart;

class ProsesOtomatisSmartService
{
    public function prosesSemua(PeriodeSmart $periode): array
    {
        // STEP 1: Hitung utilitas
        $utilitasService = new UtilitasSmartService();
        $hasilUtilitas    = $utilitasService->hitung($periode);

        if (isset($hasilUtilitas['error'])) {
            return ['error' => 'Gagal di tahap Utilitas: ' . $hasilUtilitas['error']];
        }

        // STEP 2: Hitung hasil akhir
        $hasilAkhirService = new HasilAkhirSmartService();
        $hasilAkhir         = $hasilAkhirService->hitung($periode);

        if (isset($hasilAkhir['error'])) {
            return ['error' => 'Gagal di tahap Hasil Akhir: ' . $hasilAkhir['error']];
        }

        return [
            'utilitas_processed'   => $hasilUtilitas['processed'],
            'hasil_akhir_processed' => $hasilAkhir['processed'],
            'periode'              => $periode->label,
        ];
    }
}