<?php

namespace App\Filament\Resources\HasilAkhirSmarts;

// use App\Filament\Resources\HasilAkhirSmarts\Pages\CreateHasilAkhirSmart;
// use App\Filament\Resources\HasilAkhirSmarts\Pages\EditHasilAkhirSmart;
use App\Filament\Resources\HasilAkhirSmarts\Pages\ListHasilAkhirSmarts;
use App\Filament\Resources\HasilAkhirSmarts\Pages\ViewHasilAkhirSmart;
use App\Filament\Resources\HasilAkhirSmarts\Schemas\HasilAkhirSmartForm;
use App\Filament\Resources\HasilAkhirSmarts\Schemas\HasilAkhirSmartInfolist;
use App\Filament\Resources\HasilAkhirSmarts\Tables\HasilAkhirSmartsTable;
use App\Models\HasilAkhirSmart;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HasilAkhirSmartResource extends Resource
{
    protected static ?string $model = HasilAkhirSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Trophy;

    protected static ?string $recordTitleAttribute = 'HasilAkhirSmart';

    protected static ?string $navigationLabel = 'Hasil Akhir';

    protected static ?string $pluralModelLabel = 'Hasil Akhir';

    protected static ?string $modelLabel = 'Hasil Akhir';

    protected static ?int $navigationSort = 18;

    protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function form(Schema $schema): Schema
    {
        return HasilAkhirSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HasilAkhirSmartsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HasilAkhirSmartInfolist::configure($schema);
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
            'index' => ListHasilAkhirSmarts::route('/'),
            'view' => ViewHasilAkhirSmart::route('/{record}'),
            // 'create' => CreateHasilAkhirSmart::route('/create'),
            // 'edit' => EditHasilAkhirSmart::route('/{record}/edit'),
        ];
    }
}
