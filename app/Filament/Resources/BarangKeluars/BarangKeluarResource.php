<?php

namespace App\Filament\Resources\BarangKeluars;

use App\Filament\Resources\BarangKeluars\Pages\CreateBarangKeluar;
use App\Filament\Resources\BarangKeluars\Pages\EditBarangKeluar;
use App\Filament\Resources\BarangKeluars\Pages\ListBarangKeluars;
use App\Filament\Resources\BarangKeluars\Pages\ViewBarangKeluar;
use App\Filament\Resources\BarangKeluars\Schemas\BarangKeluarForm;
use App\Filament\Resources\BarangKeluars\Schemas\BarangKeluarInfolist;
use App\Filament\Resources\BarangKeluars\Tables\BarangKeluarsTable;
use App\Models\BarangKeluar;
use BackedEnum;
use unitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangKeluarResource extends Resource
{
    protected static ?string $model = BarangKeluar::class;

    protected static string | UnitEnum | null $navigationGroup = 'Data Barang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'BarangKeluar';

    public static function form(Schema $schema): Schema
    {
        return BarangKeluarForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BarangKeluarInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarangKeluarsTable::configure($table);
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
            'index' => ListBarangKeluars::route('/'),
            'create' => CreateBarangKeluar::route('/create'),
            'view' => ViewBarangKeluar::route('/{record}'),
            'edit' => EditBarangKeluar::route('/{record}/edit'),
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
