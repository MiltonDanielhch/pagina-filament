<?php

namespace App\Filament\Resources\Posts\Actions;

use App\Models\Post;
use App\Services\SocialShareService;
use Filament\Actions\Action;

/**
 * Acción para compartir en Twitter/X.
 * Abre el intent de Twitter en una nueva pestaña.
 */
class ShareOnTwitterAction
{
    public static function make(): Action
    {
        return Action::make('shareOnTwitter')
            ->label('Compartir en X/Twitter')
            ->icon('heroicon-m-bolt-slash')
            ->color('dark')
            ->url(fn (Post $record): string => app(SocialShareService::class)->getTwitterShareUrl($record))
            ->openUrlInNewTab();
    }
}
