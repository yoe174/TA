<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan SPK SMART</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0;
        }
        .header p {
            font-size: 11px;
            margin: 2px 0;
        }
        .info-box {
            margin-bottom: 15px;
            border: 1px solid #333;
            padding: 8px;
        }
        .info-box table {
            width: 100%;
        }
        .info-box td {
            padding: 2px 5px;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px 8px;
            margin-top: 20px;
            margin-bottom: 8px;
            border-left: 4px solid #333;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table.data-table th,
        table.data-table td {
            border: 1px solid #888;
            padding: 4px 6px;
            text-align: center;
        }
        table.data-table th {
            background-color: #e8e8e8;
            font-weight: bold;
        }
        table.data-table td.text-left {
            text-align: left;
        }
        .badge-benefit {
            color: #1a7f37;
            font-weight: bold;
        }
        .badge-cost {
            color: #c41e3a;
            font-weight: bold;
        }
        .rank-1 {
            background-color: #fff3cd;
            font-weight: bold;
        }
        .footer-total {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>

    {{-- MENGURUTKAN DATA BERDASARKAN KODE ALTERNATIF --}}
    @php
        $alternatifUrutKode = collect($alternatif)
            ->sortBy(function ($item) {
                preg_match('/\d+/', $item['kode'], $match);
                return isset($match[0]) ? (int) $match[0] : 0;
            })
            ->values();
    @endphp

    {{-- HEADER --}}
    <div class="header">
        <h1>SISTEM PENDUKUNG KEPUTUSAN METODE SMART</h1>
        <p>Laporan Hasil Perangkingan Periode {{ $periode['label'] }}</p>
    </div>

    {{-- INFO BOX --}}
    <div class="info-box">
        <table>
            <tr>
                <td width="20%"><strong>Periode</strong></td>
                <td width="30%">: {{ $periode['label'] }}</td>
                <td width="20%"><strong>Status</strong></td>
                <td width="30%">: {{ $history->status === 'valid' ? 'Valid' : 'Tidak Valid' }}</td>
            </tr>
            <tr>
                <td><strong>Dicetak Tanggal</strong></td>
                <td>: {{ now()->format('d F Y, H:i') }}</td>
                <td><strong>Keterangan</strong></td>
                <td>: {{ $history->keterangan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- BAGIAN 1: DAFTAR ALTERNATIF --}}
    <div class="section-title">1. Daftar Alternatif yang Dirangkingkan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode</th>
                <th width="35%">Nama</th>
                <th width="25%">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifUrutKode as $i => $alt)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $alt['kode'] }}</td>
                <td class="text-left">{{ $alt['nama'] }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $alt['jabatan'])) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 2: DAFTAR KRITERIA --}}
    <div class="section-title">2. Kriteria yang Digunakan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode</th>
                <th width="35%">Nama Kriteria</th>
                <th width="15%">Jenis</th>
                <th width="15%">Bobot</th>
                <th width="15%">Bobot (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriteria as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k['kode'] }}</td>
                <td class="text-left">{{ $k['nama_kriteria'] }}</td>
                <td class="{{ $k['jenis'] === 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                    {{ ucfirst($k['jenis']) }}
                </td>
                <td>{{ number_format($k['bobot'], 4) }}</td>
                <td>{{ number_format($k['bobot'] * 100, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    {{-- BAGIAN 3: PENILAIAN (MATRIX 2D) --}}
    <div class="section-title">3. Tabel Penilaian SMART</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="20%">Alternatif</th>
                @foreach ($kriteria as $k)
                <th>{{ $k['kode'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifUrutKode as $alt)
            <tr>
                <td class="text-left"><strong>{{ $alt['kode'] }}</strong> — {{ $alt['nama'] }}</td>
                @foreach ($kriteria as $k)
                    @php
                        $nilai = collect($alt['penilaian'])->firstWhere('kode_kriteria', $k['kode']);
                    @endphp
                    <td>{{ $nilai['nilai_input'] ?? '-' }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 4: HASIL UTILITAS (MATRIX 2D) --}}
    <div class="section-title">4. Tabel Hasil Utilitas</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="20%">Alternatif</th>
                @foreach ($kriteria as $k)
                <th>{{ $k['kode'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifUrutKode as $alt)
            <tr>
                <td class="text-left"><strong>{{ $alt['kode'] }}</strong> — {{ $alt['nama'] }}</td>
                @foreach ($kriteria as $k)
                    @php
                        $u = collect($alt['utilitas'])->firstWhere('kode_kriteria', $k['kode']);
                    @endphp
                    <td>{{ $u ? number_format($u['nilai_utilitas'], 4) : '-' }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    {{-- BAGIAN 5: HASIL AKHIR (MATRIX 2D + TOTAL) --}}
    <div class="section-title">5. Tabel Hasil Akhir (Bobot × Utilitas)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="20%">Alternatif</th>
                @foreach ($kriteria as $k)
                <th>{{ $k['kode'] }}</th>
                @endforeach
                <th width="10%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifUrutKode as $alt)
            <tr>
                <td class="text-left"><strong>{{ $alt['kode'] }}</strong> — {{ $alt['nama'] }}</td>
                @foreach ($kriteria as $k)
                    @php
                        $u = collect($alt['utilitas'])->firstWhere('kode_kriteria', $k['kode']);
                    @endphp
                    <td>{{ $u ? number_format($u['skor'], 4) : '-' }}</td>
                @endforeach
                <td class="footer-total">{{ number_format($alt['nilai_total'], 6) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 6: PERANGKINGAN --}}
    <div class="section-title">6. Hasil Perangkingan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">Rangking</th>
                <th width="15%">Kode</th>
                <th width="40%">Nama</th>
                <th width="20%">Jabatan</th>
                <th width="15%">Nilai Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatif as $alt)
            <tr class="{{ $alt['rangking'] === 1 ? 'rank-1' : '' }}">
                <td>{{ $alt['rangking'] }}</td>
                <td>{{ $alt['kode'] }}</td>
                <td class="text-left">{{ $alt['nama'] }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $alt['jabatan'])) }}</td>
                <td>{{ number_format($alt['nilai_total'], 6) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>