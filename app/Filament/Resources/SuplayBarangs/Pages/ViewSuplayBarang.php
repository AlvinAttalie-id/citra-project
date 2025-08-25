<?php

namespace App\Filament\Resources\SuplayBarangs\Pages;

use App\Filament\Resources\SuplayBarangs\SuplayBarangResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSuplayBarang extends ViewRecord
{
    protected static string $resource = SuplayBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
