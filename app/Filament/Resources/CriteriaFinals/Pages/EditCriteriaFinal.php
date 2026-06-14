<?php

namespace App\Filament\Resources\CriteriaFinals\Pages;

use App\Filament\Resources\CriteriaFinals\CriteriaFinalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCriteriaFinal extends EditRecord
{
    protected static string $resource = CriteriaFinalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
