<?php

namespace App\Filament\Resources\AboutUs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AboutUsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('history')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('mission')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('vision')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('objectives')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
