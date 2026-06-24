<?php

namespace App\Services;

use App\Models\AlternatifSmart;
use App\Models\CriteriaSmart;
use App\Models\PenilaianSmart;
use App\Models\PeriodeSmart;
use Illuminate\Support\Facades\Auth;

class PenilaianSmartService
{
    // Generate baris penilaian untuk semua alternatif aktif x semua kriteria
    public function generate(PeriodeSmart $periode): array
    {
        $alternatifs = AlternatifSmart::aktif()->orderBy('kode')->get();
        $criterias   = CriteriaSmart::orderBy('kode')->get();

        if ($alternatifs->isEmpty()) {
            return ['error' => 'Tidak ada alternatif aktif.'];
        }

        if ($criterias->isEmpty()) {
            return ['error' => 'Tidak ada kriteria SMART.'];
        }

        $added   = 0;
        $skipped = 0;

        foreach ($alternatifs as $alt) {
            foreach ($criterias as $crit) {
                $exists = PenilaianSmart::where('periode_smart_id', $periode->id)
                    ->where('alternatif_smart_id', $alt->id)
                    ->where('criteria_smart_id', $crit->id)
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                PenilaianSmart::create([
                    'periode_smart_id'    => $periode->id,
                    'alternatif_smart_id' => $alt->id,
                    'criteria_smart_id'   => $crit->id,
                    'parameter_smart_id'  => null,
                    'nilai_manual'        => null,
                    'created_by'          => Auth::id(),
                ]);

                $added++;
            }
        }

        return [
            'added'   => $added,
            'skipped' => $skipped,
        ];
    }

    // Cek apakah semua penilaian sudah terisi
    public function isComplete(PeriodeSmart $periode): bool
    {
        return !PenilaianSmart::where('periode_smart_id', $periode->id)
            ->where(function ($q) {
                $q->whereNull('parameter_smart_id')
                  ->whereNull('nilai_manual');
            })
            ->exists();
    }
}