<?php

namespace App\Services;

use App\Models\HasilAkhirSmart;
use App\Models\HasilUtilitasSmart;
use App\Models\PeriodeSmart;

class HasilAkhirSmartService
{
    public function hitung(PeriodeSmart $periode): array
    {
        // Ambil semua hasil utilitas + bobot kriteria
        $utilitasList = HasilUtilitasSmart::where('periode_smart_id', $periode->id)
            ->with('criteriaSmart')
            ->get();

        if ($utilitasList->isEmpty()) {
            return ['error' => 'Belum ada data utilitas. Hitung utilitas terlebih dahulu.'];
        }

        // -----------------------------------------------
        // STEP 1: Kelompokkan & jumlahkan (utilitas x bobot) per alternatif
        // -----------------------------------------------
        $totalPerAlternatif = [];

        foreach ($utilitasList as $u) {
            $alternatifId = $u->alternatif_smart_id;
            $bobot        = (float) $u->criteriaSmart->bobot;
            $utilitas     = (float) $u->nilai_utilitas;

            $skor = $utilitas * $bobot;

            if (!isset($totalPerAlternatif[$alternatifId])) {
                $totalPerAlternatif[$alternatifId] = 0;
            }

            $totalPerAlternatif[$alternatifId] += $skor;
        }

        // -----------------------------------------------
        // STEP 2: Urutkan dari nilai terbesar untuk ranking
        // -----------------------------------------------
        arsort($totalPerAlternatif); // urut desc, tetap pertahankan key

        // -----------------------------------------------
        // STEP 3: Hapus data lama, simpan data baru dengan ranking
        // -----------------------------------------------
        HasilAkhirSmart::where('periode_smart_id', $periode->id)->delete();

        $rangking = 1;
        foreach ($totalPerAlternatif as $alternatifId => $total) {
            HasilAkhirSmart::create([
                'periode_smart_id'    => $periode->id,
                'alternatif_smart_id' => $alternatifId,
                'nilai_total'         => round($total, 6),
                'rangking'            => $rangking,
            ]);
            $rangking++;
        }

        return [
            'processed' => count($totalPerAlternatif),
            'periode'   => $periode->label,
        ];
    }
}