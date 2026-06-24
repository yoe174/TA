<?php

namespace App\Filament\Resources\HistoryRankingSmarts\Pages;

use App\Filament\Resources\HistoryRankingSmarts\HistoryRankingSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoryRankingSmart extends EditRecord
{
    protected static string $resource = HistoryRankingSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
