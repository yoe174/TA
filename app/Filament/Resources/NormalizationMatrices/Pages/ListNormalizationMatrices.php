<?php

namespace App\Filament\Resources\NormalizationMatrices\Pages;

use App\Filament\Resources\NormalizationMatrices\NormalizationMatrixResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNormalizationMatrices extends ListRecords
{
    protected static string $resource = NormalizationMatrixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
