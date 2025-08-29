<?php

namespace App\Filament\Resources\BarangRusaks\Schemas;

use App\Models\StokBarang;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class BarangRusakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kode_barang')
                    ->label('Pilih Barang')
                    ->options(StokBarang::pluck('jenis_barang', 'kode_barang'))
                    ->searchable()
                    ->required()
                    ->reactive(),

                TextInput::make('jumlah_rusak')
                    ->label('Jumlah Rusak')
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

                DatePicker::make('tanggal')
                    ->required(),

                TextInput::make('keterangan'),
            ]);
    }
}
