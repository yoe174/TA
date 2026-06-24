<?php

namespace App\Filament\Resources\CriteriaSmarts\Pages;

use App\Filament\Resources\CriteriaSmarts\CriteriaSmartResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCriteriaSmarts extends ListRecords
{
    protected static string $resource = CriteriaSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Kriteria SMART'),
        ];
    }
}
