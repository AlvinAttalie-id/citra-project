<?php

namespace App\Filament\Resources\SuplayBarangs\Pages;

use App\Filament\Resources\SuplayBarangs\SuplayBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuplayBarangs extends ListRecords
{
    protected static string $resource = SuplayBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
