<?php

namespace App\Filament\Resources\HistoryRankingSmarts\Pages;

use App\Filament\Resources\HistoryRankingSmarts\HistoryRankingSmartResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoryRankingSmarts extends ListRecords
{
    protected static string $resource = HistoryRankingSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
