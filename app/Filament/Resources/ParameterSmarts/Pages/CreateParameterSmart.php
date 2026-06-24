<?php

namespace App\Filament\Resources\ParameterSmarts\Pages;

use App\Filament\Resources\ParameterSmarts\ParameterSmartResource;
use Filament\Resources\Pages\CreateRecord;

class CreateParameterSmart extends CreateRecord
{
    protected static string $resource = ParameterSmartResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
