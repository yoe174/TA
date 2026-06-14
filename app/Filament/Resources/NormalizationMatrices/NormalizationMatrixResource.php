<?php

namespace App\Filament\Resources\NormalizationMatrices;

use App\Filament\Resources\NormalizationMatrices\Pages\CreateNormalizationMatrix;
use App\Filament\Resources\NormalizationMatrices\Pages\EditNormalizationMatrix;
use App\Filament\Resources\NormalizationMatrices\Pages\ListNormalizationMatrices;
use App\Filament\Resources\NormalizationMatrices\Schemas\NormalizationMatrixForm;
use App\Filament\Resources\NormalizationMatrices\Tables\NormalizationMatricesTable;
use App\Models\NormalizationMatrix;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NormalizationMatrixResource extends Resource
{
    protected static ?string $model = NormalizationMatrix::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'NormalizationMatrix';

    public static function form(Schema $schema): Schema
    {
        return NormalizationMatrixForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NormalizationMatricesTable::configure($table);
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
            'index' => ListNormalizationMatrices::route('/'),
            'create' => CreateNormalizationMatrix::route('/create'),
            'edit' => EditNormalizationMatrix::route('/{record}/edit'),
        ];
    }
}
