<?php

namespace App\Filament\Resources\HasilUtilitasSmarts;

use App\Filament\Resources\HasilUtilitasSmarts\Pages\CreateHasilUtilitasSmart;
use App\Filament\Resources\HasilUtilitasSmarts\Pages\EditHasilUtilitasSmart;
use App\Filament\Resources\HasilUtilitasSmarts\Pages\ListHasilUtilitasSmarts;
use App\Filament\Resources\HasilUtilitasSmarts\Schemas\HasilUtilitasSmartForm;
use App\Filament\Resources\HasilUtilitasSmarts\Tables\HasilUtilitasSmartsTable;
use App\Models\HasilUtilitasSmart;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HasilUtilitasSmartResource extends Resource
{
    protected static ?string $model = HasilUtilitasSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Beaker;

    protected static ?string $recordTitleAttribute = 'HasilUtilitasSmart';

    protected static ?string $navigationLabel = 'Hasil Utilitas';

    protected static ?string $pluralModelLabel = 'Hasil Utilitas';

    protected static ?string $modelLabel = 'Hasil Utilitas';

    protected static ?int $navigationSort = 10;

    protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function form(Schema $schema): Schema
    {
        return HasilUtilitasSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HasilUtilitasSmartsTable::configure($table);
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
            'index' => ListHasilUtilitasSmarts::route('/'),
            // 'create' => CreateHasilUtilitasSmart::route('/create'),
            // 'edit' => EditHasilUtilitasSmart::route('/{record}/edit'),
        ];
    }
}
