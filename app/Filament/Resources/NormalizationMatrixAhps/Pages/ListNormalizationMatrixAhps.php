<?php

namespace App\Filament\Resources\NormalizationMatrixAhps\Pages;

use App\Filament\Resources\NormalizationMatrixAhps\NormalizationMatrixAhpResource;
use App\Filament\Widgets\NormalizationAhpStatsWidget;
use App\Models\NormalizationMatrixAhp;
use App\Models\WeightAhpResult;
use App\Services\AhpCalculationService;
use Filament\Actions\ButtonAction;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\BubbleChartWidget;

class ListNormalizationMatrixAhps extends ListRecords
{
    protected static string $resource = NormalizationMatrixAhpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
            
            // ButtonAction::make('hitung')
            //     ->label('Hitung Normalisasi')
            //     ->icon('heroicon-o-calculator')
            //     ->color('success')
            //     ->requiresConfirmation()
            //     ->modalHeading('Hitung Normalisasi AHP')
            //     ->modalDescription('Proses ini akan menghitung ulang normalisasi dan bobot berdasarkan matriks perbandingan saat ini. Lanjutkan?')
            //     ->action(function () {
            //         $service = new AhpCalculationService();
            //         $result  = $service->calculate();

            //         if (isset($result['error'])) {
            //             Notification::make()
            //                 ->title('Gagal!')
            //                 ->body($result['error'])
            //                 ->danger()
            //                 ->send();
            //             return;
            //         }

            //         $status = $result['isConsistent']
            //             ? '✅ Konsisten (CR = ' . number_format($result['cr'], 4) . ')'
            //             : '❌ Tidak Konsisten (CR = ' . number_format($result['cr'], 4) . ')';

            //         Notification::make()
            //             ->title('Perhitungan Selesai!')
            //             ->body("λ_max: {$result['lambdaMax']} | CI: {$result['ci']} | CR: {$result['cr']} | {$status}")
            //             ->success()
            //             ->send();
            //     }),
        ];
    }

    // -----------------------------------------------
    // Widget ringkasan konsistensi di bawah tabel
    // -----------------------------------------------
    // protected function getFooterWidgets(): array
    // {
    //     return [];
    // }

    // -----------------------------------------------
    // Info konsistensi ditampilkan sebagai stats
    // -----------------------------------------------
    protected function getHeaderWidgets(): array
    {
        return [
            NormalizationAhpStatsWidget::class,
        ];
    }

    // Tampilkan info CR di atas tabel
    // public function getHeading(): string
    // {
    //     $latest = NormalizationMatrixAhp::first();
    //     if (!$latest) {
    //         return 'Normalisasi — Belum dihitung';
    //     }

    //     $wr = WeightAhpResult::first();
    //     if (!$wr) return 'Normalisasi';

    //     $status = $wr->is_consistent
    //         ? '✅ Konsisten'
    //         : '❌ Tidak Konsisten';

    //     return "Normalisasi | λ_max: {$wr->lambda_max} | CI: {$wr->ci} | CR: {$wr->cr} | {$status}";
    // }
}
