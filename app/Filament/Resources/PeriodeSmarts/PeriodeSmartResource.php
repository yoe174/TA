<?php

namespace App\Filament\Resources\PeriodeSmarts;

use App\Filament\Resources\PeriodeSmarts\Pages\CreatePeriodeSmart;
use App\Filament\Resources\PeriodeSmarts\Pages\EditPeriodeSmart;
use App\Filament\Resources\PeriodeSmarts\Pages\ListPeriodeSmarts;
use App\Filament\Resources\PeriodeSmarts\Schemas\PeriodeSmartForm;
use App\Filament\Resources\PeriodeSmarts\Tables\PeriodeSmartsTable;
use App\Models\PeriodeSmart;
use BackedEnum;
// use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PeriodeSmartResource extends Resource
{
    protected static ?string $model = PeriodeSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar;

    protected static ?string $recordTitleAttribute = 'PeriodeSmart';

    protected static ?string $navigationLabel = 'Periode';

    protected static ?string $pluralModelLabel = 'Periode';

    protected static ?string $modelLabel = 'Periode';

    protected static ?int $navigationSort = 3;

    // protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function form(Schema $schema): Schema
    {
        return PeriodeSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeriodeSmartsTable::configure($table);
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
            'index' => ListPeriodeSmarts::route('/'),
            'create' => CreatePeriodeSmart::route('/create'),
            'edit' => EditPeriodeSmart::route('/{record}/edit'),
        ];
    }
}
