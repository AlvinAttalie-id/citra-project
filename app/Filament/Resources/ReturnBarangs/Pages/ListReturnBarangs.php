<?php

namespace App\Filament\Resources\ReturnBarangs\Pages;

use App\Filament\Resources\ReturnBarangs\ReturnBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReturnBarangs extends ListRecords
{
    protected static string $resource = ReturnBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
