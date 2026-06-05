<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GalleryItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('gallery.title')
                    ->label('Gallery'),
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('caption')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('type'),
                ImageEntry::make('image_path')
                    ->placeholder('-'),
                TextEntry::make('video_url')
                    ->placeholder('-'),
                TextEntry::make('youtube_id')
                    ->placeholder('-'),
                TextEntry::make('sort_order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
