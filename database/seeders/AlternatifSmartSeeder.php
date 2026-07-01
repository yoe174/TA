<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlternatifSmart;

class AlternatifSmartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 9 Data Pertama (Kode A01 - A09 dengan Status Aktif)
        AlternatifSmart::create([
            'kode' => 'A01',
            'nama' => 'Aini',
            'email' => 'aini01@example.com',
            'telepon' => '08123456701',
            'alamat' => 'Jl. Contoh No. 1',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A02',
            'nama' => 'Windhy',
            'email' => 'windhy02@example.com',
            'telepon' => '08123456702',
            'alamat' => 'Jl. Contoh No. 2',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A03',
            'nama' => 'Ferdinan',
            'email' => 'ferdinan03@example.com',
            'telepon' => '08123456703',
            'alamat' => 'Jl. Contoh No. 3',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A04',
            'nama' => 'Wahyu',
            'email' => 'wahyu04@example.com',
            'telepon' => '08123456704',
            'alamat' => 'Jl. Contoh No. 4',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A05',
            'nama' => 'Ririn',
            'email' => 'ririn05@example.com',
            'telepon' => '08123456705',
            'alamat' => 'Jl. Contoh No. 5',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A06',
            'nama' => 'Fernandes',
            'email' => 'fernandes06@example.com',
            'telepon' => '08123456706',
            'alamat' => 'Jl. Contoh No. 6',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A07',
            'nama' => 'Kris',
            'email' => 'kris07@example.com',
            'telepon' => '08123456707',
            'alamat' => 'Jl. Contoh No. 7',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A08',
            'nama' => 'Kristoper',
            'email' => 'kristoper08@example.com',
            'telepon' => '08123456708',
            'alamat' => 'Jl. Contoh No. 8',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A09',
            'nama' => 'Yudi',
            'email' => 'yudi09@example.com',
            'telepon' => '08123456709',
            'alamat' => 'Jl. Contoh No. 9',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'aktif',
            'created_by' => 1,
        ]);

        // Sisa Data dari Gambar (Kode A10 - A14 dengan Status Nonaktif)
        AlternatifSmart::create([
            'kode' => 'A10',
            'nama' => 'Riska',
            'email' => 'riska10@example.com',
            'telepon' => '08123456710',
            'alamat' => 'Jl. Contoh No. 10',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'nonaktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A11',
            'nama' => 'Yeni',
            'email' => 'yeni11@example.com',
            'telepon' => '08123456711',
            'alamat' => 'Jl. Contoh No. 11',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'nonaktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A12',
            'nama' => 'Rafi',
            'email' => 'rafi12@example.com',
            'telepon' => '08123456712',
            'alamat' => 'Jl. Contoh No. 12',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'nonaktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A13',
            'nama' => 'Rilfi',
            'email' => 'rilfi13@example.com',
            'telepon' => '08123456713',
            'alamat' => 'Jl. Contoh No. 13',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'nonaktif',
            'created_by' => 1,
        ]);

        AlternatifSmart::create([
            'kode' => 'A14',
            'nama' => 'Aisya',
            'email' => 'aisya14@example.com',
            'telepon' => '08123456714',
            'alamat' => 'Jl. Contoh No. 14',
            'jabatan' => 'guru',
            'tahun_masuk' => 2026,
            'status' => 'nonaktif',
            'created_by' => 1,
        ]);
    }
}
