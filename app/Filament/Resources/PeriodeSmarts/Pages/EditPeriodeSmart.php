<?php

namespace App\Filament\Resources\PeriodeSmarts\Pages;

use App\Filament\Resources\PeriodeSmarts\PeriodeSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPeriodeSmart extends EditRecord
{
    protected static string $resource = PeriodeSmartResource::class;

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
