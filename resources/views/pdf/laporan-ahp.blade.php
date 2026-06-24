<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembobotan AHP</title>
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
        .status-konsisten {
            color: #1a7f37;
            font-weight: bold;
        }
        .status-tidak-konsisten {
            color: #c41e3a;
            font-weight: bold;
        }
        .page-break {
            page-break-before: always;
        }
        .summary-box {
            margin-top: 15px;
            border: 2px solid #333;
            padding: 10px;
        }
        .summary-box table {
            width: 100%;
        }
        .summary-box td {
            padding: 4px 8px;
            font-size: 11px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h1>LAPORAN PEMBOBOTAN KRITERIA</h1>
        <p>Metode Analytic Hierarchy Process (AHP)</p>
    </div>

    <div class="info-box">
        <table>
            <tr>
                <td width="25%"><strong>Jumlah Kriteria</strong></td>
                <td width="25%">: {{ $criterias->count() }}</td>
                <td width="25%"><strong>Dicetak Tanggal</strong></td>
                <td width="25%">: {{ now()->format('d F Y, H:i') }}</td>
            </tr>
        </table>
    </div>

    {{-- BAGIAN 1: DAFTAR KRITERIA --}}
    <div class="section-title">1. Daftar Kriteria AHP</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="20%">Kode</th>
                <th width="50%">Nama Kriteria</th>
                <th width="20%">Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarKriteria as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k['kode'] }}</td>
                <td class="text-left">{{ $k['nama_kriteria'] }}</td>
                <td class="{{ $k['jenis'] === 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                    {{ ucfirst($k['jenis']) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 2: MATRIX PERBANDINGAN (2D) --}}
    <div class="section-title">2. Matriks Perbandingan Berpasangan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="15%">Kriteria</th>
                @foreach ($criterias as $c)
                <th>{{ $c->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($matrixPerbandingan as $row)
            <tr>
                <td class="text-left"><strong>{{ $row['kode'] }}</strong></td>
                @foreach ($criterias as $c)
                <td>{{ number_format($row['nilai'][$c->kode], 2) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    {{-- BAGIAN 3: NORMALISASI (2D) --}}
    <div class="section-title">3. Matriks Normalisasi</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="15%">Kriteria</th>
                @foreach ($criterias as $c)
                <th>{{ $c->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($matrixNormalisasi as $row)
            <tr>
                <td class="text-left"><strong>{{ $row['kode'] }}</strong></td>
                @foreach ($criterias as $c)
                <td>{{ number_format($row['nilai'][$c->kode], 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 4: KRITERIA FINAL + KONSISTENSI --}}
    <div class="section-title">4. Kriteria Final dan Bobot</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="15%">Kode</th>
                <th width="35%">Nama Kriteria</th>
                <th width="15%">Jenis</th>
                <th width="12%">Bobot</th>
                <th width="13%">Bobot (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criteriaFinals as $i => $cf)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $cf->kode }}</td>
                <td class="text-left">{{ $cf->nama_kriteria }}</td>
                <td class="{{ $cf->jenis === 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                    {{ ucfirst($cf->jenis) }}
                </td>
                <td>{{ number_format($cf->bobot, 6) }}</td>
                <td>{{ number_format($cf->bobot * 100, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- INFO KONSISTENSI --}}
    <div class="summary-box">
        <table>
            <tr>
                <td width="25%"><strong>CI (Consistency Index)</strong></td>
                <td width="25%">: {{ number_format($infoKonsistensi['ci'], 6) }}</td>
                <td width="25%"><strong>RI (Random Index)</strong></td>
                <td width="25%">: {{ number_format($infoKonsistensi['ri'], 6) }}</td>
            </tr>
            <tr>
                <td><strong>CR (Consistency Ratio)</strong></td>
                <td>: {{ number_format($infoKonsistensi['cr'], 6) }}</td>
                <td><strong>Status</strong></td>
                <td>
                    :
                    <span class="{{ $infoKonsistensi['is_consistent'] ? 'status-konsisten' : 'status-tidak-konsisten' }}">
                        {{ $infoKonsistensi['is_consistent'] ? 'KONSISTEN (CR ≤ 0.1)' : 'TIDAK KONSISTEN (CR > 0.1)' }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>