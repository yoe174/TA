<?php

namespace App\Filament\Resources\HasilAkhirSmarts\Pages;

use App\Filament\Resources\HasilAkhirSmarts\HasilAkhirSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilAkhirSmart extends EditRecord
{
    protected static string $resource = HasilAkhirSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
