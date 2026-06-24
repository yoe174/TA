<?php

namespace App\Services;

use App\Models\CriteriaAHP;
use App\Models\CriteriaFinal;
use App\Models\ComparisonMatrixAhp;
use App\Models\NormalizationMatrixAhp;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPdfAhpService
{
    public function generate()
    {
        $criterias = CriteriaAHP::orderBy('kode')->get();

        if ($criterias->isEmpty()) {
            return ['error' => 'Belum ada data kriteria AHP.'];
        }

        // -----------------------------------------------
        // Bagian 1: Daftar Kriteria
        // -----------------------------------------------
        $daftarKriteria = $criterias->map(function ($c) {
            return [
                'kode'          => $c->kode,
                'nama_kriteria' => $c->nama_kriteria,
                'jenis'         => $c->jenis,
            ];
        });

        // -----------------------------------------------
        // Bagian 2: Matrix Perbandingan (2D)
        // -----------------------------------------------
        $matrixPerbandingan = [];
        foreach ($criterias as $from) {
            $row = ['kode' => $from->kode, 'nilai' => []];
            foreach ($criterias as $to) {
                $record = ComparisonMatrixAhp::where('criteria_id_from', $from->id)
                    ->where('criteria_id_to', $to->id)
                    ->first();
                $row['nilai'][$to->kode] = $record ? (float) $record->value : 1;
            }
            $matrixPerbandingan[] = $row;
        }

        // -----------------------------------------------
        // Bagian 3: Normalisasi Bobot (2D)
        // -----------------------------------------------
        $matrixNormalisasi = [];
        foreach ($criterias as $from) {
            $row = ['kode' => $from->kode, 'nilai' => []];
            foreach ($criterias as $to) {
                $record = NormalizationMatrixAhp::where('criteria_id_from', $from->id)
                    ->where('criteria_id_to', $to->id)
                    ->first();
                $row['nilai'][$to->kode] = $record ? (float) $record->normalized_value : 0;
            }
            $matrixNormalisasi[] = $row;
        }

        // -----------------------------------------------
        // Bagian 4: Kriteria Final + Info Konsistensi
        // -----------------------------------------------
        $criteriaFinals = CriteriaFinal::orderBy('kode')->get();

        if ($criteriaFinals->isEmpty()) {
            return ['error' => 'Belum ada data Kriteria Final. Ekspor terlebih dahulu dari Hasil Bobot.'];
        }

        $infoKonsistensi = [
            'ci'            => (float) $criteriaFinals->first()->ri ? null : null, // placeholder, diisi di bawah
            'ri'            => (float) $criteriaFinals->first()->ri,
            'cr'            => (float) $criteriaFinals->first()->cr,
            'is_consistent' => (bool) $criteriaFinals->first()->is_consistent,
        ];

        // CI dihitung ulang dari CR x RI (karena tidak disimpan langsung di criteria_finals)
        $infoKonsistensi['ci'] = $infoKonsistensi['ri'] > 0
            ? round($infoKonsistensi['cr'] * $infoKonsistensi['ri'], 6)
            : 0;

        $pdf = Pdf::loadView('pdf.laporan-ahp', [
            'daftarKriteria'     => $daftarKriteria,
            'criterias'          => $criterias,
            'matrixPerbandingan' => $matrixPerbandingan,
            'matrixNormalisasi'  => $matrixNormalisasi,
            'criteriaFinals'     => $criteriaFinals,
            'infoKonsistensi'    => $infoKonsistensi,
        ])->setPaper('a4', 'landscape');

        return ['pdf' => $pdf];
    }
}