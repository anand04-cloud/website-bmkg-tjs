<?php

namespace App\Filament\Resources\PetaIklims\Pages;

use App\Filament\Resources\PetaIklims\PetaIklimResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetaIklims extends ListRecords
{
    protected static string $resource = PetaIklimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
