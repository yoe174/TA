<?php

namespace App\Filament\Resources\AlternatifSmarts\Pages;

use App\Filament\Resources\AlternatifSmarts\AlternatifSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlternatifSmart extends EditRecord
{
    protected static string $resource = AlternatifSmartResource::class;

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
