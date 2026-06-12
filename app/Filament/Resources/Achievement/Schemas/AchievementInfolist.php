<?php

namespace App\Filament\Resources\Achievement\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AchievementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image_url')
                    ->label('Imagen')
                    ->columnSpanFull(),
                TextEntry::make('title')
                    ->label('Título'),
                TextEntry::make('area')
                    ->label('Área'),
                TextEntry::make('achieved_at')
                    ->label('Fecha')
                    ->date('d/m/Y'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('user.name')
                    ->label('Registrado por'),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
