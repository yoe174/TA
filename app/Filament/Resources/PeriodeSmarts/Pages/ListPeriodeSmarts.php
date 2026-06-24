<?php

namespace App\Filament\Resources\PeriodeSmarts\Pages;

use App\Filament\Resources\PeriodeSmarts\PeriodeSmartResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeriodeSmarts extends ListRecords
{
    protected static string $resource = PeriodeSmartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Periode')
        ];
    }
}
