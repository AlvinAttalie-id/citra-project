<?php

namespace App\Filament\Resources\ReturnBarangs\Pages;

use App\Filament\Resources\ReturnBarangs\ReturnBarangResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReturnBarang extends EditRecord
{
    protected static string $resource = ReturnBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
