<?php

namespace App\Services;

// use App\Models\AlternatifSmart;
use App\Models\CriteriaSmart;
use App\Models\HasilAkhirSmart;
use App\Models\HasilUtilitasSmart;
use App\Models\HistoryRankingSmart;
// use App\Models\ParameterSmart;
use App\Models\PenilaianSmart;
use App\Models\PeriodeSmart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryRankingSmartService
{
    public function eksporKeHistory(PeriodeSmart $periode): array
    {
        $hasilAkhirList = HasilAkhirSmart::where('periode_smart_id', $periode->id)
            ->with('alternatifSmart')
            ->orderBy('rangking')
            ->get();

        if ($hasilAkhirList->isEmpty()) {
            return ['error' => 'Belum ada hasil akhir. Hitung hasil akhir terlebih dahulu.'];
        }

        // Cek apakah periode ini sudah pernah diekspor
        $alreadyExported = HistoryRankingSmart::where('periode_smart_id', $periode->id)->exists();
        if ($alreadyExported) {
            return ['error' => 'Periode ini sudah pernah diekspor ke History.'];
        }

        $result = null;

        DB::transaction(function () use ($periode, $hasilAkhirList, &$result) {

            // -----------------------------------------------
            // Kumpulkan snapshot SEMUA data periode ini
            // -----------------------------------------------

            // 1. Data kriteria (sama untuk semua alternatif)
            $criterias = CriteriaSmart::orderBy('kode')->get()->map(function ($c) {
                return [
                    'kode'          => $c->kode,
                    'nama_kriteria' => $c->nama_kriteria,
                    'jenis'         => $c->jenis,
                    'bobot'         => (float) $c->bobot,
                    'use_parameter' => $c->use_parameter,
                ];
            })->toArray();

            // 2. Data tiap alternatif: penilaian + utilitas + hasil akhir
            $alternatifData = [];

            foreach ($hasilAkhirList as $hasil) {
                $alternatif = $hasil->alternatifSmart;

                $penilaian = PenilaianSmart::where('periode_smart_id', $periode->id)
                    ->where('alternatif_smart_id', $alternatif->id)
                    ->with(['criteriaSmart', 'parameterSmart'])
                    ->get()
                    ->map(function ($p) {
                        return [
                            'kode_kriteria' => $p->criteriaSmart->kode,
                            'nilai_input'   => $p->parameter_smart_id
                                ? $p->parameterSmart->label . ' (' . $p->parameterSmart->nilai . ')'
                                : (string) $p->nilai_manual,
                        ];
                    })->toArray();

                $utilitas = HasilUtilitasSmart::where('periode_smart_id', $periode->id)
                    ->where('alternatif_smart_id', $alternatif->id)
                    ->with('criteriaSmart')
                    ->get()
                    ->map(function ($u) {
                        return [
                            'kode_kriteria'  => $u->criteriaSmart->kode,
                            'nilai_aktual'   => (float) $u->nilai_aktual,
                            'nilai_min'      => (float) $u->nilai_min,
                            'nilai_max'      => (float) $u->nilai_max,
                            'nilai_utilitas' => (float) $u->nilai_utilitas,
                            'skor'           => (float) $u->nilai_utilitas * (float) $u->criteriaSmart->bobot,
                        ];
                    })->toArray();

                $alternatifData[] = [
                    'kode'        => $alternatif->kode,
                    'nama'        => $alternatif->nama,
                    'jabatan'     => $alternatif->jabatan,
                    'penilaian'   => $penilaian,
                    'utilitas'    => $utilitas,
                    'nilai_total' => (float) $hasil->nilai_total,
                    'rangking'    => $hasil->rangking,
                ];
            }

            // 3. Susun snapshot lengkap
            $snapshot = [
                'periode' => [
                    'bulan' => $periode->bulan,
                    'tahun' => $periode->tahun,
                    'label' => $periode->nama_bulan . ' ' . $periode->tahun,
                ],
                'kriteria'   => $criterias,
                'alternatif' => $alternatifData,
            ];

            // Alternatif terbaik (rangking 1)
            $terbaik = $hasilAkhirList->firstWhere('rangking', 1);

            $history = HistoryRankingSmart::create([
                'periode_smart_id'      => $periode->id,
                'alternatif_terbaik_id' => $terbaik->alternatif_smart_id,
                'nilai_terbaik'         => $terbaik->nilai_total,
                'status'                => 'valid',
                'keterangan'            => null,
                'detail_snapshot'       => $snapshot,
                'created_by'            => Auth::id(),
            ]);

            // Bersihkan utilitas & hasil akhir (penilaian TETAP disimpan)
            HasilUtilitasSmart::where('periode_smart_id', $periode->id)->delete();
            HasilAkhirSmart::where('periode_smart_id', $periode->id)->delete();

            // Tutup periode
            $periode->update(['status' => 'selesai']);

            $result = $history;
        });

        return [
            'success' => true,
            'periode' => $periode->label,
        ];
    }
}