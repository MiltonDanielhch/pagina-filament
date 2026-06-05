<?php

namespace App\Filament\Resources\Posts\Actions;

use App\Models\Post;
use App\Services\SocialShareService;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Log;

/**
 * Acción para compartir en Facebook.
 * Abre el sharer de Facebook en una nueva pestaña.
 */
class ShareOnFacebookAction
{
    public static function make(): Action
    {
        return Action::make('shareOnFacebook')
            ->label('Compartir en Facebook')
            ->icon('heroicon-m-globe-alt')
            ->color('primary')
            ->url(fn (Post $record): string => app(SocialShareService::class)->getFacebookShareUrl($record))
            ->openUrlInNewTab();
    }
}
