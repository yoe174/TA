<?php

namespace App\Filament\Resources\CriteriaAHPS\Pages;

use App\Filament\Resources\CriteriaAHPS\CriteriaAHPResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCriteriaAHP extends EditRecord
{
    protected static string $resource = CriteriaAHPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
