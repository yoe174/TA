<?php

namespace App\Filament\Resources\CriteriaSmarts;

use App\Filament\Resources\CriteriaSmarts\Pages\CreateCriteriaSmart;
use App\Filament\Resources\CriteriaSmarts\Pages\EditCriteriaSmart;
use App\Filament\Resources\CriteriaSmarts\Pages\ListCriteriaSmarts;
use App\Filament\Resources\CriteriaSmarts\Schemas\CriteriaSmartForm;
use App\Filament\Resources\CriteriaSmarts\Tables\CriteriaSmartsTable;
use App\Models\CriteriaSmart;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CriteriaSmartResource extends Resource
{
    protected static ?string $model = CriteriaSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCheck;

    protected static ?string $recordTitleAttribute = 'CriteriaSmart';

    protected static ?string $navigationLabel = 'Kriteria SMART';

    protected static ?string $pluralModelLabel = 'Kriteria SMART';

    protected static ?string $modelLabel = 'Kriteria SMART';

    protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    protected static ?int $navigationSort = 7;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return CriteriaSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CriteriaSmartsTable::configure($table);
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
            'index' => ListCriteriaSmarts::route('/'),
            'create' => CreateCriteriaSmart::route('/create'),
            'edit' => EditCriteriaSmart::route('/{record}/edit'),
        ];
    }
}
