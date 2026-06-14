<?php

namespace App\Services;

use App\Models\ComparisonMatrixAhp;
use App\Models\CriteriaAHP;
use App\Models\NormalizationMatrixAhp;
use App\Models\WeightAhpResult;

class AhpCalculationService
{
    public function calculate(): array
    {
        $criterias = CriteriaAHP::orderBy('kode')->get();
        $n = $criterias->count();

        if ($n < 2) {
            return ['error' => 'Minimal 2 kriteria diperlukan.'];
        }

        // -----------------------------------------------
        // STEP 1: Bangun matriks dari database
        // -----------------------------------------------
        $matrix = [];
        foreach ($criterias as $from) {
            foreach ($criterias as $to) {
                $record = ComparisonMatrixAhp::where('criteria_id_from', $from->id)
                    ->where('criteria_id_to', $to->id)
                    ->first();
                $matrix[$from->id][$to->id] = $record ? (float) $record->value : 1;
            }
        }

        // -----------------------------------------------
        // STEP 2: Jumlah tiap kolom
        // -----------------------------------------------
        $colSum = [];
        foreach ($criterias as $to) {
            $colSum[$to->id] = 0;
            foreach ($criterias as $from) {
                $colSum[$to->id] += $matrix[$from->id][$to->id];
            }
        }

        // -----------------------------------------------
        // STEP 3: Normalisasi (tiap nilai ÷ jumlah kolom)
        // -----------------------------------------------
        $normalized = [];
        foreach ($criterias as $from) {
            foreach ($criterias as $to) {
                $normalized[$from->id][$to->id] = $matrix[$from->id][$to->id] / $colSum[$to->id];
            }
        }

        // -----------------------------------------------
        // STEP 4: Priority Vector (rata-rata tiap baris)
        // -----------------------------------------------
        $priorityVector = [];
        foreach ($criterias as $from) {
            $rowSum = array_sum($normalized[$from->id]);
            $priorityVector[$from->id] = $rowSum / $n;
        }

        // -----------------------------------------------
        // STEP 5: Hitung λ_max
        // -----------------------------------------------
        $lambdaMax = 0;
        foreach ($criterias as $from) {
            $weightedSum = 0;
            foreach ($criterias as $to) {
                $weightedSum += $matrix[$from->id][$to->id] * $priorityVector[$to->id];
            }
            $lambdaMax += $weightedSum / $priorityVector[$from->id];
        }
        $lambdaMax = $lambdaMax / $n;

        // -----------------------------------------------
        // STEP 6: CI dan CR
        // -----------------------------------------------
        $ci = ($lambdaMax - $n) / ($n - 1);

        $riTable = [
            1 => 0.00, 2 => 0.00, 3 => 0.58,
            4 => 0.90, 5 => 1.12, 6 => 1.24,
            7 => 1.32, 8 => 1.41, 9 => 1.45,
            10 => 1.49,
        ];
        $ri = $riTable[$n] ?? 1.49;
        $cr = ($ri > 0) ? ($ci / $ri) : 0;
        $isConsistent = $cr <= 0.1;

        // -----------------------------------------------
        // STEP 7: Simpan ke normalization_matrices
        // -----------------------------------------------
        NormalizationMatrixAhp::query()->delete();
        foreach ($criterias as $from) {
            foreach ($criterias as $to) {
                NormalizationMatrixAhp::create([
                    'criteria_id_from' => $from->id,
                    'criteria_id_to'   => $to->id,
                    'normalized_value' => round($normalized[$from->id][$to->id], 6),
                    'priority_vector'  => round($priorityVector[$from->id], 6),
                ]);
            }
        }

        // -----------------------------------------------
        // STEP 8: Simpan ke weight_results
        // -----------------------------------------------

        WeightAhpResult::query()->delete();
        foreach ($criterias as $criteria) {
            WeightAhpResult::create([
                'criteria_ahp_id'   => $criteria->id,
                'bobot'         => round($priorityVector[$criteria->id], 6),
                'lambda_max'    => round($lambdaMax, 6),
                'ri'            => $ri,
                'ci'            => round($ci, 6),
                'cr'            => round($cr, 6),
                'is_consistent' => $isConsistent,
            ]);
        }

        return [
            'criterias'      => $criterias,
            'matrix'         => $matrix,
            'colSum'         => $colSum,
            'normalized'     => $normalized,
            'priorityVector' => $priorityVector,
            'lambdaMax'      => round($lambdaMax, 6),
            'ci'             => round($ci, 6),
            'cr'             => round($cr, 6),
            'ri'             => $ri,
            'isConsistent'   => $isConsistent,
            'n'              => $n,
        ];
    }
}