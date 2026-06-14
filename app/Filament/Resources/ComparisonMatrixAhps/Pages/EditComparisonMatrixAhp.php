<?php

namespace App\Filament\Resources\ComparisonMatrixAhps\Pages;

use App\Filament\Resources\ComparisonMatrixAhps\ComparisonMatrixAhpResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\ComparisonMatrixAhp;

class EditComparisonMatrixAhp extends EditRecord
{
    protected static string $resource = ComparisonMatrixAhpResource::class;

    // Update reciprocal otomatis saat edit
    protected function afterSave(): void
    {
        $record = $this->record;

        if ($record->criteria_id_from === $record->criteria_id_to) return;

        if (!$record->value || $record->value == 0) return;

        ComparisonMatrixAhp::updateOrCreate(
            [
                'criteria_id_from' => $record->criteria_id_to,
                'criteria_id_to'   => $record->criteria_id_from,
            ],
            [
                'value' => round(1 / $record->value, 4),
            ]
        );

        
    }

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
