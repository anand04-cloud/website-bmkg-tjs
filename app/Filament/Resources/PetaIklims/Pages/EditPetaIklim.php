<?php

namespace App\Filament\Resources\PetaIklims\Pages;

use App\Filament\Resources\PetaIklims\PetaIklimResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPetaIklim extends EditRecord
{
    protected static string $resource = PetaIklimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
