<?php

namespace App\Services;

use App\Models\HistoryRankingSmart;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPdfSmartService
{
    public function generate(HistoryRankingSmart $history)
    {
        $snapshot = $history->detail_snapshot;

        $periode    = $snapshot['periode'];
        $kriteria   = $snapshot['kriteria'];
        $alternatif = $snapshot['alternatif']; // sudah urut rangking

        $pdf = Pdf::loadView('pdf.laporan-smart', [
            'history'    => $history,
            'periode'    => $periode,
            'kriteria'   => $kriteria,
            'alternatif' => $alternatif,
        ])->setPaper('a4', 'landscape'); // landscape karena tabel kriteria bisa banyak kolom

        return $pdf;
    }
}