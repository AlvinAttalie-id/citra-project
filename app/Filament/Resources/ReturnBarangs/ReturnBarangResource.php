<?php

namespace App\Filament\Resources\ReturnBarangs;

use App\Filament\Resources\ReturnBarangs\Pages\CreateReturnBarang;
use App\Filament\Resources\ReturnBarangs\Pages\EditReturnBarang;
use App\Filament\Resources\ReturnBarangs\Pages\ListReturnBarangs;
use App\Filament\Resources\ReturnBarangs\Pages\ViewReturnBarang;
use App\Filament\Resources\ReturnBarangs\Schemas\ReturnBarangForm;
use App\Filament\Resources\ReturnBarangs\Schemas\ReturnBarangInfolist;
use App\Filament\Resources\ReturnBarangs\Tables\ReturnBarangsTable;
use App\Models\ReturnBarang;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturnBarangResource extends Resource
{
    protected static ?string $model = ReturnBarang::class;

    protected static string | UnitEnum | null $navigationGroup = 'Data Barang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $recordTitleAttribute = 'ReturnBarang';

    public static function form(Schema $schema): Schema
    {
        return ReturnBarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReturnBarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReturnBarangsTable::configure($table);
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
            'index' => ListReturnBarangs::route('/'),
            'create' => CreateReturnBarang::route('/create'),
            'view' => ViewReturnBarang::route('/{record}'),
            'edit' => EditReturnBarang::route('/{record}/edit'),
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
