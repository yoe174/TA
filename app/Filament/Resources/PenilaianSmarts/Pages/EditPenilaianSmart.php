<?php

namespace App\Filament\Resources\PenilaianSmarts\Pages;

use App\Filament\Resources\PenilaianSmarts\PenilaianSmartResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianSmart extends EditRecord
{
    protected static string $resource = PenilaianSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
