<?php

namespace App\Filament\Resources\Official\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Schemas\Schema;

class OfficialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryImageEntry::make('image')
                    ->label('Fotografía')
                    ->collection('officials')
                    ->square(),
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('position')
                    ->label('Cargo'),
                TextEntry::make('area')
                    ->label('Área'),
                TextEntry::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope'),
                TextEntry::make('phone')
                    ->label('Teléfono')
                    ->icon('heroicon-o-phone'),
                TextEntry::make('bio')
                    ->label('Biografía'),
                IconEntry::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                TextEntry::make('user.name')
                    ->label('Registrado por'),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
