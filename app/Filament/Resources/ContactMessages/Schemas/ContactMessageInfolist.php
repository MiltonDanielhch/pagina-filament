<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre')
                    ->icon('heroicon-o-user'),
                TextEntry::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->copyable(),
                TextEntry::make('subject')
                    ->label('Asunto')
                    ->icon('heroicon-o-chat-bubble-left-right'),
                TextEntry::make('message')
                    ->label('Contenido')
                    ->columnSpanFull()
                    ->markdown(),
                IconEntry::make('is_read')
                    ->label('Leído')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextEntry::make('created_at')
                    ->label('Recibido')
                    ->dateTime('d/m/Y H:i')
                    ->icon('heroicon-o-calendar')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->icon('heroicon-o-clock')
                    ->placeholder('-'),
            ]);
    }
}
