<?php

namespace App\Filament\Resources\NormalizationMatrices\Pages;

use App\Filament\Resources\NormalizationMatrices\NormalizationMatrixResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNormalizationMatrix extends EditRecord
{
    protected static string $resource = NormalizationMatrixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
