<?php

namespace App\Filament\Resources\SuplayBarangs;

use App\Filament\Resources\SuplayBarangs\Pages\CreateSuplayBarang;
use App\Filament\Resources\SuplayBarangs\Pages\EditSuplayBarang;
use App\Filament\Resources\SuplayBarangs\Pages\ListSuplayBarangs;
use App\Filament\Resources\SuplayBarangs\Pages\ViewSuplayBarang;
use App\Filament\Resources\SuplayBarangs\Schemas\SuplayBarangForm;
use App\Filament\Resources\SuplayBarangs\Schemas\SuplayBarangInfolist;
use App\Filament\Resources\SuplayBarangs\Tables\SuplayBarangsTable;
use App\Models\SuplayBarang;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuplayBarangResource extends Resource
{
    protected static ?string $model = SuplayBarang::class;

    protected static string | UnitEnum | null $navigationGroup = 'Data Barang';

    protected static ?string $navigationLabel = 'Suplay Barang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'SuplayBarang';

    public static function form(Schema $schema): Schema
    {
        return SuplayBarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SuplayBarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuplayBarangsTable::configure($table);
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
            'index' => ListSuplayBarangs::route('/'),
            'create' => CreateSuplayBarang::route('/create'),
            'view' => ViewSuplayBarang::route('/{record}'),
            'edit' => EditSuplayBarang::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
