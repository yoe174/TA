<?php

namespace App\Filament\Resources\PeriodeSmarts\Pages;

use App\Filament\Resources\PeriodeSmarts\PeriodeSmartResource;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreatePeriodeSmart extends CreateRecord
{
    protected static string $resource = PeriodeSmartResource::class;

    // Auto isi created_by dengan user yang login
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Use the authenticated user id safely to satisfy static analysis
        $data['created_by'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
