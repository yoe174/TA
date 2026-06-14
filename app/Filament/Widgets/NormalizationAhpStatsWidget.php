<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\WeightAhpResult;

class NormalizationAhpStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // return [
        //     //
        // ];
        $wr = WeightAhpResult::first();

        if (!$wr) {
            return [
                Stat::make('CI', '-')->description('Belum dihitung')->color('gray'),
                Stat::make('RI', '-')->description('Belum dihitung')->color('gray'),
                Stat::make('CR', '-')->description('Belum dihitung')->color('gray'),
                Stat::make('Status', '-')->description('Belum dihitung')->color('gray'),
            ];
        }

        $isConsistent = $wr->is_consistent;

        return [
            Stat::make('CI', number_format($wr->ci, 4))
                ->description('Consistency Index')
                ->color('info'),

            Stat::make('RI', number_format($wr->ri, 4))
                ->description('Random Index')
                ->color('info'),

            Stat::make('CR', number_format($wr->cr, 4))
                ->description('Consistency Ratio')
                ->color($isConsistent ? 'success' : 'danger'),

            Stat::make('Status', $isConsistent ? 'Konsisten' : 'Tidak Konsisten')
                ->description($isConsistent ? 'CR ≤ 0.1' : 'CR > 0.1, ulangi penilaian')
                ->color($isConsistent ? 'success' : 'danger'),
        ];
    }
}
