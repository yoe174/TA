<?php

namespace App\Filament\Resources\ComparisonMatrixAhps\Pages;

use App\Filament\Resources\ComparisonMatrixAhps\ComparisonMatrixAhpResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\ComparisonMatrixAhp;

class CreateComparisonMatrixAhp extends CreateRecord
{
    protected static string $resource = ComparisonMatrixAhpResource::class;

    // Setelah simpan, otomatis buat reciprocal
    protected function afterCreate(): void
    {
        $record = $this->record;

        // Jangan buat reciprocal kalau diagonal (from == to)
        if ($record->criteria_id_from === $record->criteria_id_to) return;

        // Cek apakah reciprocal sudah ada
        $exists = ComparisonMatrixAhp::where('criteria_id_from', $record->criteria_id_to)
            ->where('criteria_id_to', $record->criteria_id_from)
            ->exists();

        if (!$exists) {
            ComparisonMatrixAhp::create([
                'criteria_id_from' => $record->criteria_id_to,
                'criteria_id_to'   => $record->criteria_id_from,
                'value'            => round(1 / $record->value, 4),
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
