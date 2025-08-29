<?php

namespace App\Filament\Resources\ReturnBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\BarangKeluar;

class ReturnBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_keluar')
                    ->label('Barang Keluar')
                    ->options(
                        BarangKeluar::with('stokBarang')
                            ->where('status', 'process')
                            ->get()
                            ->pluck('stokBarang.jenis_barang', 'id_keluar')
                    )
                    ->reactive()
                    ->required(),
                DatePicker::make('tanggal_r')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(fn(Get $get) => BarangKeluar::find($get('id_keluar'))?->jumlah ?? 0)
                    ->helperText(fn(Get $get) => $get('id_keluar')
                        ? 'Maksimal return: ' . (BarangKeluar::find($get('id_keluar'))->jumlah ?? 0)
                        : 'Pilih barang keluar terlebih dahulu'),
                TextInput::make('alasan'),

            ]);
    }
}
