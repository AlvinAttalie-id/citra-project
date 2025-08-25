<?php

namespace App\Filament\Resources\BarangKeluars\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangKeluarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required(),
                TextInput::make('kode_barang')
                    ->required(),
                TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                DatePicker::make('tgl_keluar')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('keterangan'),
            ]);
    }
}
