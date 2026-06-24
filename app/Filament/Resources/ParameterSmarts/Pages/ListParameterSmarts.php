<?php

namespace App\Filament\Resources\ParameterSmarts\Pages;

use App\Filament\Resources\ParameterSmarts\ParameterSmartResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListParameterSmarts extends ListRecords
{
    protected static string $resource = ParameterSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Parameter'),
        ];
    }
}
