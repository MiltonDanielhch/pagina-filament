<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\Actions\ShareOnFacebookAction;
use App\Filament\Resources\Posts\Actions\ShareOnTwitterAction;
use App\Filament\Resources\Posts\Actions\ShareOnWhatsAppAction;
use App\Filament\Resources\Posts\Actions\CopyShareTextAction;
use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ShareOnFacebookAction::make(),
            ShareOnTwitterAction::make(),
            ShareOnWhatsAppAction::make(),
            CopyShareTextAction::make(),
        ];
    }
}
