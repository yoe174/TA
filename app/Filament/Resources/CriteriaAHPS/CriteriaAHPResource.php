<?php

namespace App\Filament\Resources\CriteriaAHPS;

use App\Filament\Resources\CriteriaAHPS\Pages\CreateCriteriaAHP;
use App\Filament\Resources\CriteriaAHPS\Pages\EditCriteriaAHP;
use App\Filament\Resources\CriteriaAHPS\Pages\ListCriteriaAHPS;
use App\Filament\Resources\CriteriaAHPS\Schemas\CriteriaAHPForm;
use App\Filament\Resources\CriteriaAHPS\Tables\CriteriaAHPSTable;
use App\Models\CriteriaAHP;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CriteriaAHPResource extends Resource
{
    protected static ?string $model = CriteriaAHP::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static string|UnitEnum|null $navigationGroup = 'Kriteria & Bobot AHP';

    protected static ?string $recordTitleAttribute = 'CriteriaAHP';

    protected static ?string $navigationLabel = 'Kriteria';

    protected static ?string $pluralModelLabel = 'Kriteria';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CriteriaAHPForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CriteriaAHPSTable::configure($table);
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
            'index' => ListCriteriaAHPS::route('/'),
            'create' => CreateCriteriaAHP::route('/create'),
            'edit' => EditCriteriaAHP::route('/{record}/edit'),
        ];
    }
}
