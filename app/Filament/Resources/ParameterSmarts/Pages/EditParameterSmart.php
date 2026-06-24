<?php

namespace App\Filament\Resources\ParameterSmarts\Pages;

use App\Filament\Resources\ParameterSmarts\ParameterSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditParameterSmart extends EditRecord
{
    protected static string $resource = ParameterSmartResource::class;

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
