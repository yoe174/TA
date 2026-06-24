<?php

namespace App\Filament\Resources\PenilaianSmarts;

use App\Filament\Resources\PenilaianSmarts\Pages\CreatePenilaianSmart;
use App\Filament\Resources\PenilaianSmarts\Pages\EditPenilaianSmart;
use App\Filament\Resources\PenilaianSmarts\Pages\IsiNilaiPenilaian;
use App\Filament\Resources\PenilaianSmarts\Pages\ListPenilaianSmarts;
use App\Filament\Resources\PenilaianSmarts\Schemas\PenilaianSmartForm;
use App\Filament\Resources\PenilaianSmarts\Tables\PenilaianSmartsTable;
use App\Models\PenilaianSmart;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenilaianSmartResource extends Resource
{
    protected static ?string $model = PenilaianSmart::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PencilSquare;

    protected static ?string $recordTitleAttribute = 'PenilaianSmart';

    protected static ?string $navigationLabel = 'Penilaian';

    protected static ?string $pluralModelLabel = 'Penilaian';

    protected static ?string $modelLabel = 'Penilaian';

    protected static ?int $navigationSort = 9;

    protected static string|UnitEnum|null $navigationGroup = 'Perangkingan SMART';

    public static function form(Schema $schema): Schema
    {
        return PenilaianSmartForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenilaianSmartsTable::configure($table);
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
            'index' => ListPenilaianSmarts::route('/'),
            'create' => CreatePenilaianSmart::route('/create'),
            // 'edit' => EditPenilaianSmart::route('/{record}/edit'),
            'isi-nilai' => IsiNilaiPenilaian::route('/isi-nilai/{alternatifId}'),
        ];
    }
}
