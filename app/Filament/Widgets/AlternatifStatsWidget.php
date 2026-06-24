<?php

namespace App\Filament\Widgets;

use App\Models\AlternatifSmart;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AlternatifStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $total    = AlternatifSmart::count();
        $aktif    = AlternatifSmart::where('status', 'aktif')->count();
        $nonaktif = AlternatifSmart::where('status', 'nonaktif')->count();

        return [
            Stat::make('Total Alternatif', $total)
                ->description('Jumlah seluruh alternatif')
                ->icon('heroicon-o-user-group')
                ->color('gray'),

            Stat::make('Alternatif Aktif', $aktif)
                ->description('Bisa diproses dalam penilaian')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Alternatif Nonaktif', $nonaktif)
                ->description('Tidak diproses dalam penilaian')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
