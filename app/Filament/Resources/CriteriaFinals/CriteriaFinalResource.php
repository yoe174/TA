<?php

namespace App\Filament\Resources\CriteriaFinals;

use App\Filament\Resources\CriteriaFinals\Pages\CreateCriteriaFinal;
use App\Filament\Resources\CriteriaFinals\Pages\EditCriteriaFinal;
use App\Filament\Resources\CriteriaFinals\Pages\ListCriteriaFinals;
use App\Filament\Resources\CriteriaFinals\Schemas\CriteriaFinalForm;
use App\Filament\Resources\CriteriaFinals\Tables\CriteriaFinalsTable;
use App\Filament\Widgets\NormalizationAhpStatsWidget;
use App\Models\CriteriaAHP;
use App\Models\CriteriaFinal;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CriteriaFinalResource extends Resource
{
    protected static ?string $model = CriteriaFinal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Kriteria & Bobot AHP';

    protected static ?string $recordTitleAttribute = 'CriteriaFinal';

    protected static ?string $navigationLabel = 'Kriteria Final';

    protected static ?string $pluralModelLabel = 'Kriteria Final';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return CriteriaFinalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CriteriaFinalsTable::configure($table);

        return CriteriaAHPTable::configure($table);
    }

    // Tampilkan stats CI/RI/CR di atas tabel sebagai referensi
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
            'index' => ListCriteriaFinals::route('/'),
            // 'create' => CreateCriteriaFinal::route('/create'),
            // 'edit' => EditCriteriaFinal::route('/{record}/edit'),
        ];
    }
}
