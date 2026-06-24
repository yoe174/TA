<?php

namespace App\Filament\Widgets;


use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns as Columns;
use App\Models\HistoryRankingSmart;

class HistoryRankingReadOnlyWidget extends TableWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Riwayat Perangkingan';

    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(HistoryRankingSmart::query()->latest())
            ->columns([
                Columns\TextColumn::make('periodeSmart.label')
                    ->label('Periode')
                    ->getStateUsing(fn ($record) => $record->periodeSmart?->nama_bulan . ' ' . $record->periodeSmart?->tahun),

                Columns\TextColumn::make('alternatifTerbaik.nama')
                    ->label('Peringkat 1'),

                Columns\TextColumn::make('nilai_terbaik')
                    ->label('Nilai Total')
                    ->formatStateUsing(fn ($state) => number_format($state, 6)),

                Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'valid',
                        'danger'  => 'tidak_valid',
                    ]),
            ])
            ->paginated(5);
    }
}
