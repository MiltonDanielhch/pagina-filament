<?php

namespace App\Filament\Resources\Gallery\Pages;

use App\Filament\Resources\Gallery\GalleryResource;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
