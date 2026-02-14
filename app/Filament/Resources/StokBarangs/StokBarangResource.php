<?php

namespace App\Filament\Resources\StokBarangs;

use App\Filament\Resources\StokBarangs\Pages\CreateStokBarang;
use App\Filament\Resources\StokBarangs\Pages\EditStokBarang;
use App\Filament\Resources\StokBarangs\Pages\ListStokBarangs;
use App\Filament\Resources\StokBarangs\Pages\ViewStokBarang;
use App\Filament\Resources\StokBarangs\Schemas\StokBarangForm;
use App\Filament\Resources\StokBarangs\Schemas\StokBarangInfolist;
use App\Filament\Resources\StokBarangs\Tables\StokBarangsTable;
use App\Models\StokBarang;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokBarangResource extends Resource
{
    protected static ?string $model = StokBarang::class;

    protected static string | UnitEnum | null $navigationGroup = 'Data Barang';

    protected static ?string $navigationLabel = 'Data Barang';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'StokBarang';

    public static function form(Schema $schema): Schema
    {
        return StokBarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StokBarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokBarangsTable::configure($table);
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
            'index' => ListStokBarangs::route('/'),
            'create' => CreateStokBarang::route('/create'),
            'view' => ViewStokBarang::route('/{record}'),
            'edit' => EditStokBarang::route('/{record}/edit'),
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
