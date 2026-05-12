<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Event;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Autor'),
                TextEntry::make('title')
                    ->label('Título'),
                TextEntry::make('slug')
                    ->label('Slug'),
                TextEntry::make('location')
                    ->label('Lugar'),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
                TextEntry::make('starts_at')
                    ->label('Fecha de inicio')
                    ->dateTime(),
                TextEntry::make('ends_at')
                    ->label('Fecha de fin')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),
                TextEntry::make('is_featured')
                    ->label('Destacado')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Sí' : 'No'),
            ]);
    }
}