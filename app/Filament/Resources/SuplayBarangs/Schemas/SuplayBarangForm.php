<?php

namespace App\Filament\Resources\SuplayBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SuplayBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required(),
                TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                TextInput::make('kode_barang')
                    ->required(),
                DatePicker::make('tgl_pengiriman')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('keterangan'),
            ]);
    }
}
