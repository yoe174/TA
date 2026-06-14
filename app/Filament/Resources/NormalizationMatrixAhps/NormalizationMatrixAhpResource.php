<?php

namespace App\Filament\Resources\NormalizationMatrixAhps;

use App\Filament\Resources\NormalizationMatrixAhps\Pages\CreateNormalizationMatrixAhp;
use App\Filament\Resources\NormalizationMatrixAhps\Pages\EditNormalizationMatrixAhp;
use App\Filament\Resources\NormalizationMatrixAhps\Pages\ListNormalizationMatrixAhps;
use App\Filament\Resources\NormalizationMatrixAhps\Schemas\NormalizationMatrixAhpForm;
use App\Filament\Resources\NormalizationMatrixAhps\Tables\NormalizationMatrixAhpsTable;
use App\Filament\Widgets\NormalizationAhpStatsWidget;
use App\Models\NormalizationMatrixAhp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NormalizationMatrixAhpResource extends Resource
{
    protected static ?string $model = NormalizationMatrixAhp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calculator;

    protected static string|UnitEnum|null $navigationGroup = 'Kriteria & Bobot AHP';

    protected static ?string $recordTitleAttribute = 'NormalizationMatrixAhp';

    protected static ?string $navigationLabel = 'Normalisasi Bobot';

    protected static ?string $pluralModelLabel = 'Normalisasi Bobot';

    protected static ?string $modelLabel = 'Normalisasi Bobot';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return NormalizationMatrixAhpForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NormalizationMatrixAhpsTable::configure($table);
    }

    public static function getWidgets(): array
    {
        return [
            NormalizationAhpStatsWidget::class,
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
            'index' => ListNormalizationMatrixAhps::route('/'),
            // 'create' => CreateNormalizationMatrixAhp::route('/create'),
            // 'edit' => EditNormalizationMatrixAhp::route('/{record}/edit'),
        ];
    }
}
