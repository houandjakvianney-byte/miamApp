<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Resources\Pages\ListRecords;

class ListCommandes extends ListRecords
{
    protected static string $resource = CommandeResource::class;

    // Pas d'action "créer" en en-tête : voir CommandeResource::canCreate()
    protected function getHeaderActions(): array
    {
        return [];
    }
}
