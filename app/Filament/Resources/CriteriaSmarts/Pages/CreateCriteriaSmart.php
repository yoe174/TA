<?php

namespace App\Filament\Resources\CriteriaSmarts\Pages;

use App\Filament\Resources\CriteriaSmarts\CriteriaSmartResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCriteriaSmart extends CreateRecord
{
    protected static string $resource = CriteriaSmartResource::class;

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
