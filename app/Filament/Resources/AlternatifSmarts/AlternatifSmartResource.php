<?php

namespace App\Filament\Resources\AlternatifSmarts;

use App\Filament\Resources\AlternatifSmarts\Pages\CreateAlternatifSmart;
use App\Filament\Resources\AlternatifSmarts\Pages\EditAlternatifSmart;
use App\Filament\Resources\AlternatifSmarts\Pages\ListAlternatifSmarts;
use App\Filament\Resources\AlternatifSmarts\Schemas\AlternatifSmartForm;
use App\Filament\Resources\AlternatifSmarts\Tables\AlternatifSmartsTable;
use App\Filament\Widgets\AlternatifStatsWidget;
use App\Models\AlternatifSmart;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AlternatifSmartResource extends Resource
{
    protected static ?string $model = AlternatifSmart::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'AlternatifSmart';

    protected static ?string $navigationLabel = 'Data Alternatif';

    protected static ?string $pluralModelLabel = 'Alternatif';

    protected static ?string $modelLabel = 'Alternatif';

    protected static ?int $navigationSort = 2;

    // protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function getNavigationBadge(): ?string
    {
        return (string) AlternatifSmart::where('status', 'aktif')->count();
    }

    public static function getNavigationBadgeColor(): ?string
{
    return 'success'; // hijau
}

    public static function form(Schema $schema): Schema
    {
        return AlternatifSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlternatifSmartsTable::configure($table);
    }

    public static function getWidgets(): array
    {
        return [
            AlternatifStatsWidget::class,
        ];
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
            'index' => ListAlternatifSmarts::route('/'),
            'create' => CreateAlternatifSmart::route('/create'),
            'edit' => EditAlternatifSmart::route('/{record}/edit'),
        ];
    }
}
