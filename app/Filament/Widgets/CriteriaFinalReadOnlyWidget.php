<?php

namespace App\Filament\Widgets;

use App\Models\CriteriaFinal;
// use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class CriteriaFinalReadOnlyWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Kriteria & Bobot';

    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => CriteriaFinal::query())
            ->columns([
                Columns\TextColumn::make('kode')->label('Kode'),
                Columns\TextColumn::make('nama_kriteria')->label('Nama Kriteria'),
                Columns\BadgeColumn::make('jenis')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'benefit',
                        'danger'  => 'cost',
                    ]),
                Columns\TextColumn::make('bobot')
                    ->label('Bobot')
                    ->formatStateUsing(fn($state) => number_format($state, 4)),
            ])
            ->paginated(false);
    }
}
