<?php

namespace App\Filament\Resources\BarangKeluars\Schemas;

use App\Models\StokBarang;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

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
                    ->required(),
                TextInput::make('id_user')
                    ->default(fn() => Auth::id())
                    ->hidden(),
                DatePicker::make('tgl_keluar')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('keterangan'),
            ]);
    }
}
