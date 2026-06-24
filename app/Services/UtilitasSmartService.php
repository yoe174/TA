<?php

namespace App\Services;

use App\Models\CriteriaSmart;
use App\Models\HasilUtilitasSmart;
use App\Models\PenilaianSmart;
use App\Models\PeriodeSmart;

class UtilitasSmartService
{
    public function hitung(PeriodeSmart $periode): array
    {
        $criterias = CriteriaSmart::orderBy('kode')->get();

        if ($criterias->isEmpty()) {
            return ['error' => 'Tidak ada kriteria SMART.'];
        }

        // Cek apakah semua penilaian sudah terisi
        $belumTerisi = PenilaianSmart::where('periode_smart_id', $periode->id)
            ->where(function ($q) {
                $q->whereNull('parameter_smart_id')
                  ->whereNull('nilai_manual');
            })
            ->count();

        if ($belumTerisi > 0) {
            return ['error' => "Masih ada {$belumTerisi} penilaian yang belum diisi."];
        }

        // Ambil semua penilaian periode ini
        $semuaPenilaian = PenilaianSmart::where('periode_smart_id', $periode->id)
            ->with(['criteriaSmart', 'parameterSmart'])
            ->get();

        // -----------------------------------------------
        // STEP 1: Hitung nilai aktual tiap penilaian
        // -----------------------------------------------
        $nilaiAktual = [];
        foreach ($semuaPenilaian as $p) {
            $nilai = $p->use_parameter ?? $p->criteriaSmart->use_parameter
                ? ($p->parameterSmart?->nilai ?? 0)
                : (float) $p->nilai_manual;

            $nilaiAktual[$p->criteria_smart_id][$p->alternatif_smart_id] = $nilai;
        }

        // -----------------------------------------------
        // STEP 2: Hitung min & max tiap kriteria
        // -----------------------------------------------
        $minMax = [];
        foreach ($nilaiAktual as $criteriaId => $nilaiPerAlt) {
            $minMax[$criteriaId] = [
                'min' => min($nilaiPerAlt),
                'max' => max($nilaiPerAlt),
            ];
        }

        // -----------------------------------------------
        // STEP 3: Hitung utilitas & simpan
        // -----------------------------------------------
        HasilUtilitasSmart::where('periode_smart_id', $periode->id)->delete();

        $processed = 0;

        foreach ($semuaPenilaian as $p) {
            $criteriaId  = $p->criteria_smart_id;
            $alternatifId = $p->alternatif_smart_id;
            $jenis       = $p->criteriaSmart->jenis;

            $nilai = $nilaiAktual[$criteriaId][$alternatifId];
            $min   = $minMax[$criteriaId]['min'];
            $max   = $minMax[$criteriaId]['max'];
            $range = $max - $min;

            if ($range == 0) {
                // Opsi B (default): utilitas = 0 jika max = min
                $utilitas = 0;

                // Opsi A: utilitas = 1 jika max = min (uncomment jika diperlukan)
                // $utilitas = 1;
            } else {
                if ($jenis === 'benefit') {
                    // Benefit: semakin besar semakin baik
                    $utilitas = ($nilai - $min) / $range;
                } else {
                    // Cost: semakin kecil semakin baik
                    $utilitas = ($max - $nilai) / $range;
                }
            }

            HasilUtilitasSmart::create([
                'periode_smart_id'    => $periode->id,
                'alternatif_smart_id' => $alternatifId,
                'criteria_smart_id'   => $criteriaId,
                'nilai_aktual'        => round($nilai, 4),
                'nilai_min'           => round($min, 4),
                'nilai_max'           => round($max, 4),
                'nilai_utilitas'      => round($utilitas, 6),
            ]);

            $processed++;
        }

        return [
            'processed' => $processed,
            'periode'   => $periode->label,
        ];
    }
}