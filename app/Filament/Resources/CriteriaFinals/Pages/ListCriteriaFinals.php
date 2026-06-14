<?php

namespace App\Filament\Resources\CriteriaFinals\Pages;

use App\Filament\Resources\CriteriaFinals\CriteriaFinalResource;
use App\Filament\Widgets\NormalizationAhpStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCriteriaFinals extends ListRecords
{
    protected static string $resource = CriteriaFinalResource::class;

    // Widget CI/RI/CR tampil di atas sebagai referensi sebelum ekspor
    protected function getHeaderWidgets(): array
    {
        return [
            NormalizationAhpStatsWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
