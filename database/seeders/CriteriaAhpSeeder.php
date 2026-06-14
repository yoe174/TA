<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CriteriaAHP;

class CriteriaAhpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CriteriaAHP::create([
            'nama_kriteria' => 'Kinerja',
            'kode' => 'C1',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Presensi Hadir',
            'kode' => 'C2',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Lama Bekerja',
            'kode' => 'C3',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Presensi Kegiatan',
            'kode' => 'C4',
            'jenis' => 'benefit',
        ]);
        CriteriaAHP::create([
            'nama_kriteria' => 'Tanggung Jawab',
            'kode' => 'C5',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Pengalaman',
            'kode' => 'C6',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Komunikasi',
            'kode' => 'C7',
            'jenis' => 'benefit',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Keterlambatan',
            'kode' => 'C8',
            'jenis' => 'cost',
        ]);

        CriteriaAHP::create([
            'nama_kriteria' => 'Kemampuan Pendukung',
            'kode' => 'C9',
            'jenis' => 'benefit',
        ]);
    }
}
