<?php

namespace App\Filament\Resources\ComparisonMatrixAhps;

use App\Filament\Resources\ComparisonMatrixAhps\Pages\CreateComparisonMatrixAhp;
use App\Filament\Resources\ComparisonMatrixAhps\Pages\EditComparisonMatrixAhp;
use App\Filament\Resources\ComparisonMatrixAhps\Pages\ListComparisonMatrixAhps;
use App\Filament\Resources\ComparisonMatrixAhps\Schemas\ComparisonMatrixAhpForm;
use App\Filament\Resources\ComparisonMatrixAhps\Tables\ComparisonMatrixAhpsTable;
use App\Models\ComparisonMatrixAhp;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ComparisonMatrixAhpResource extends Resource
{
    protected static ?string $model = ComparisonMatrixAhp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PencilSquare;

    protected static string|UnitEnum|null $navigationGroup = 'Kriteria & Bobot AHP';

    protected static ?string $recordTitleAttribute = 'comparisonMatrixAhp';

    protected static ?string $navigationLabel = 'Penilaian Matrix';

    protected static ?string $pluralModelLabel = 'Penilaian Matrix Perbandingan';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ComparisonMatrixAhpForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComparisonMatrixAhpsTable::configure($table);
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
            'index' => ListComparisonMatrixAhps::route('/'),
            'create' => CreateComparisonMatrixAhp::route('/create'),
            'edit' => EditComparisonMatrixAhp::route('/{record}/edit'),
        ];
    }
}
