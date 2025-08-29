<?php

namespace App\Filament\Resources\BarangKeluars\Schemas;

use App\Models\StokBarang;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Components\Utilities\Get;

class BarangKeluarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kode_barang')
                    ->label('Pilih Barang')
                    ->options(
                        StokBarang::pluck('jenis_barang', 'kode_barang')
                    )
                    ->searchable()
                    ->required()
                    ->reactive(),
                TextInput::make('id_user')
                    ->default(fn() => Auth::id())
                    ->hidden(),
                DatePicker::make('tgl_keluar')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(
                        fn(Get $get) =>
                        StokBarang::find($get('kode_barang'))?->jumlah_stok ?? 0
                    )
                    ->helperText(
                        fn(Get $get) =>
                        $get('kode_barang')
                            ? 'Stok tersedia: ' . (StokBarang::find($get('kode_barang'))->jumlah_stok ?? 0)
                            : 'Pilih barang terlebih dahulu'
                    ),
                TextInput::make('keterangan'),
            ]);
    }
}
