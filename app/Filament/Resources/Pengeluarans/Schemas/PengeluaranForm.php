<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_pengeluaran')
                    ->required(),
                DatePicker::make('tgl_pengeluaran')
                    ->required(),
                TextInput::make('biaya')
                    ->required()
                    ->numeric(),
                TextInput::make('bukti'),
                TextInput::make('keterangan'),
            ]);
    }
}
