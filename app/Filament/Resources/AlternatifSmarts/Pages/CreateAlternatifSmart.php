<?php

namespace App\Filament\Resources\AlternatifSmarts\Pages;

use App\Filament\Resources\AlternatifSmarts\AlternatifSmartResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAlternatifSmart extends CreateRecord
{
    protected static string $resource = AlternatifSmartResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto isi created_by dengan user yang login
        $data['created_by'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

