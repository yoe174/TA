<?php

namespace App\Filament\Resources\HistoryRankingSmarts;

// use App\Filament\Resources\HistoryRankingSmarts\Pages\CreateHistoryRankingSmart;
// use App\Filament\Resources\HistoryRankingSmarts\Pages\EditHistoryRankingSmart;
use App\Filament\Resources\HistoryRankingSmarts\Pages\ListHistoryRankingSmarts;
use App\Filament\Resources\HistoryRankingSmarts\Pages\ViewHistoryRankingSmart;
use App\Filament\Resources\HistoryRankingSmarts\Schemas\HistoryRankingSmartForm;
use App\Filament\Resources\HistoryRankingSmarts\Schemas\HistoryRankingSmartInfolist;
use App\Filament\Resources\HistoryRankingSmarts\Tables\HistoryRankingSmartsTable;
use App\Models\HistoryRankingSmart;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HistoryRankingSmartResource extends Resource
{
    protected static ?string $model = HistoryRankingSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArchiveBox;

    protected static ?string $recordTitleAttribute = 'HistoryRankingSmart';

    protected static ?string $navigationLabel = 'History Ranking';

    protected static ?string $pluralModelLabel = 'History Ranking';

    protected static ?string $modelLabel = 'History Ranking';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return HistoryRankingSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoryRankingSmartsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
{
    return HistoryRankingSmartInfolist::configure($schema);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHistoryRankingSmarts::route('/'),
            'view' => ViewHistoryRankingSmart::route('/{record}'),
        ];
    }
}
