<?php

namespace App\Filament\Resources\CriteriaAHPS\Pages;

use App\Filament\Resources\CriteriaAHPS\CriteriaAHPResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCriteriaAHPS extends ListRecords
{
    protected static string $resource = CriteriaAHPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Kriteria'),
        ];
    }
}
