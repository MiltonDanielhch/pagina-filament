<?php

namespace App\Filament\Resources\Posts\Actions;

use App\Models\Post;
use App\Services\SocialShareService;
use Filament\Actions\Action;

/**
 * Acción para compartir en WhatsApp.
 * Abre wa.me en una nueva pestaña.
 */
class ShareOnWhatsAppAction
{
    public static function make(): Action
    {
        return Action::make('shareOnWhatsApp')
            ->label('Compartir en WhatsApp')
            ->icon('heroicon-m-device-phone-mobile')
            ->color('success')
            ->url(fn (Post $record): string => app(SocialShareService::class)->getWhatsAppShareUrl($record))
            ->openUrlInNewTab();
    }
}
