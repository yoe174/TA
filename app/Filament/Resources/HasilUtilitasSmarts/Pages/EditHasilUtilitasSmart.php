<?php

namespace App\Filament\Resources\HasilUtilitasSmarts\Pages;

use App\Filament\Resources\HasilUtilitasSmarts\HasilUtilitasSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilUtilitasSmart extends EditRecord
{
    protected static string $resource = HasilUtilitasSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
