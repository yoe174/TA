<?php

namespace App\Filament\Resources\NormalizationMatrixAhps\Pages;

use App\Filament\Resources\NormalizationMatrixAhps\NormalizationMatrixAhpResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNormalizationMatrixAhp extends EditRecord
{
    protected static string $resource = NormalizationMatrixAhpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
