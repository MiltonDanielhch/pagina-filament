<?php

namespace App\Filament\Resources\Posts\Actions;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;

/**
 * Grupo de acciones para compartir en redes sociales.
 * Incluye opciones para Facebook, Twitter, WhatsApp y copiar texto.
 */
class SocialShareActionGroup
{
    public static function make(): ActionGroup
    {
        return ActionGroup::make()
            ->label('Compartir')
            ->icon('heroicon-m-share')
            ->color('info')
            ->button()
            ->outlined()
            ->actions([
                ShareOnFacebookAction::make(),
                ShareOnTwitterAction::make(),
                ShareOnWhatsAppAction::make(),
                Action::make('copyText')
                    ->label('Copiar texto')
                    ->icon('heroicon-m-document-duplicate')
                    ->color('gray')
                    ->action(function (Post $record) {
                        $service = app(\App\Services\SocialShareService::class);
                        $text = $service->getGenericText($record);

                        return <<<HTML
                        <script>
                            navigator.clipboard.writeText({$this->escapeForJs($text)}).then(() => {
                                // Notification will be shown by Filament
                            });
                        </script>
                        HTML;
                    })
                    ->after(function (Post $record) {
                        $record->updateQuietly([
                            'shared_to_social' => true,
                            'shared_at' => now(),
                        ]);
                    }),
            ]);
    }

    /**
     * Escapa texto para usarlo en JavaScript inline.
     */
    protected function escapeForJs(string $text): string
    {
        return json_encode($text);
    }
}
