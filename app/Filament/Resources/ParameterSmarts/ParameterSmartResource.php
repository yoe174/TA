<?php

namespace App\Filament\Resources\ParameterSmarts;

use App\Filament\Resources\ParameterSmarts\Pages\CreateParameterSmart;
use App\Filament\Resources\ParameterSmarts\Pages\EditParameterSmart;
use App\Filament\Resources\ParameterSmarts\Pages\ListParameterSmarts;
use App\Filament\Resources\ParameterSmarts\Schemas\ParameterSmartForm;
use App\Filament\Resources\ParameterSmarts\Tables\ParameterSmartsTable;
use App\Models\ParameterSmart;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ParameterSmartResource extends Resource
{
    protected static ?string $model = ParameterSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static ?string $recordTitleAttribute = 'ParameterSmart';

    protected static ?string $navigationLabel = 'Parameter SMART';

    protected static ?string $pluralModelLabel = 'Parameter SMART';

    protected static ?string $modelLabel = 'Parameter SMART';

    protected static ?int $navigationSort = 8;

    protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function form(Schema $schema): Schema
    {
        return ParameterSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParameterSmartsTable::configure($table);
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
            'index' => ListParameterSmarts::route('/'),
            'create' => CreateParameterSmart::route('/create'),
            'edit' => EditParameterSmart::route('/{record}/edit'),
        ];
    }
}
