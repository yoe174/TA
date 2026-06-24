<?php

namespace App\Filament\Resources\CriteriaSmarts\Pages;

use App\Filament\Resources\CriteriaSmarts\CriteriaSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCriteriaSmart extends EditRecord
{
    protected static string $resource = CriteriaSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
