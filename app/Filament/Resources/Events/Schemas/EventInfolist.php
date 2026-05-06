<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Text;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Text::make('title'),
                Text::make('slug'),
                Text::make('location'),
                Text::make('description'),
                Text::make('starts_at'),
                Text::make('ends_at'),
                Text::make('status'),
                Text::make('is_featured'),
            ]);
    }
}