<?php

namespace App\Filament\Resources\Posts\Actions;

use App\Models\Post;
use App\Services\SocialShareService;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Log;

/**
 * Acción para copiar texto de noticia listo para compartir.
 * Usa modal con el texto formateado para que el usuario copie manualmente.
 */
class CopyShareTextAction
{
    public static function make(): Action
    {
        return Action::make('copyShareText')
            ->label('Copiar texto para redes')
            ->icon('heroicon-m-document-duplicate')
            ->color('gray')
            ->form([
                \Filament\Forms\Components\Textarea::make('share_text')
                    ->label('Texto para compartir')
                    ->readonly()
                    ->rows(6)
                    ->formatStateUsing(function (Post $record) {
                        $service = app(SocialShareService::class);
                        return $service->getGenericText($record);
                    }),
            ])
            ->action(function (Post $record) {
                $record->updateQuietly([
                    'shared_to_social' => true,
                    'shared_at' => now(),
                ]);

                Log::info('Post text copied for social sharing', [
                    'post_id' => $record->id,
                    'title' => $record->title,
                ]);
            });
    }
}
