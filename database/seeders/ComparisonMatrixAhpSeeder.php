<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComparisonMatrixAhp;

class ComparisonMatrixAhpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Data dari Kriteria 1
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 1, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 2, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 3, 'value' => 7.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 4, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 5, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 6, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 7, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 8, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 1, 'criteria_id_to' => 9, 'value' => 7.00]);

        // Data dari Kriteria 2
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 1, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 2, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 3, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 4, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 5, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 6, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 7, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 8, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 2, 'criteria_id_to' => 9, 'value' => 5.00]);

        // Data dari Kriteria 3
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 1, 'value' => 0.14]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 2, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 3, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 4, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 5, 'value' => 0.14]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 6, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 7, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 8, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 3, 'criteria_id_to' => 9, 'value' => 1.00]);

        // Data dari Kriteria 4
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 1, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 2, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 3, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 4, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 5, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 6, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 7, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 8, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 4, 'criteria_id_to' => 9, 'value' => 3.00]);

        // Data dari Kriteria 5
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 1, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 2, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 3, 'value' => 7.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 4, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 5, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 6, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 7, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 8, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 5, 'criteria_id_to' => 9, 'value' => 7.00]);

        // Data dari Kriteria 6
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 1, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 2, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 3, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 4, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 5, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 6, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 7, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 8, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 6, 'criteria_id_to' => 9, 'value' => 3.00]);

        // Data dari Kriteria 7
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 1, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 2, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 3, 'value' => 5.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 4, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 5, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 6, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 7, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 8, 'value' => 3.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 7, 'criteria_id_to' => 9, 'value' => 5.00]);

        // Data dari Kriteria 8
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 1, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 2, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 3, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 4, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 5, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 6, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 7, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 8, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 8, 'criteria_id_to' => 9, 'value' => 3.00]);

        // Data dari Kriteria 9
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 1, 'value' => 0.14]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 2, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 3, 'value' => 1.00]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 4, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 5, 'value' => 0.14]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 6, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 7, 'value' => 0.20]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 8, 'value' => 0.33]);
        ComparisonMatrixAhp::create(['criteria_id_from' => 9, 'criteria_id_to' => 9, 'value' => 1.00]);
    }
}
