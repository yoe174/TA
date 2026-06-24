<?php

namespace App\Filament\Resources\AlternatifSmarts\Pages;

use App\Filament\Resources\AlternatifSmarts\AlternatifSmartResource;
use App\Filament\Widgets\AlternatifStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlternatifSmarts extends ListRecords
{
    protected static string $resource = AlternatifSmartResource::class;

    protected function getHeaderWidgets(): array
{
    return [
        AlternatifStatsWidget::class,
    ];
}
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Alternatif'),
        ];
    }
}
