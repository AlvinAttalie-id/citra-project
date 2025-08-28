<?php

namespace App\Filament\Resources\SuplayBarangs\Schemas;

use App\Models\StokBarang;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SuplayBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_user')
                    ->label('Pilih Suplayer')
                    ->options(
                        User::where('role', 'suplayer')
                            ->pluck('name', 'id_user')
                            ->toArray()
                    )
                    ->searchable()
                    ->required(),

                Select::make('kode_barang')
                    ->label('Pilih Barang')
                    ->options(
                        StokBarang::pluck('jenis_barang', 'kode_barang')
                    )
                    ->searchable()
                    ->required(),

                DatePicker::make('tgl_pengiriman')
                    ->required(),

                TextInput::make('jumlah')
                    ->numeric()
                    ->required(),

                TextInput::make('keterangan'),
            ]);
    }
}
