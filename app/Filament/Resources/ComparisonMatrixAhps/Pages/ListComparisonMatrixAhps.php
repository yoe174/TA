<?php

namespace App\Filament\Resources\ComparisonMatrixAhps\Pages;

use App\Filament\Resources\ComparisonMatrixAhps\ComparisonMatrixAhpResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComparisonMatrixAhps extends ListRecords
{
    protected static string $resource = ComparisonMatrixAhpResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }
}
