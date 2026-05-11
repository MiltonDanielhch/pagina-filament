<?php

/**
 * Ubicación: `app/Filament/Pages/Settings/SiteSettings.php`
 *
 * Descripción: Página Filament para configuración del sitio: general, contacto,
 *              redes sociales y analytics
 *
 * Uso: Accesible desde el panel de Filament en Gestión > Configuración del sitio
 * Roadmap: 05-BACKEND.md — Bloque 3.4
 */

namespace App\Filament\Pages\Settings;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use UnitEnum;
use App\Models\SiteSetting;

class SiteSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static ?string $title = 'Configuración del sitio';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected string $view = 'filament.pages.settings.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->loadSettings();
        $this->form->fill();
    }

    protected function loadSettings(): void
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'Gobernación del Beni'),
            'site_tagline' => SiteSetting::get('site_tagline', ''),
            'site_logo' => SiteSetting::get('site_logo', ''),
            'site_favicon' => SiteSetting::get('site_favicon', ''),
            'contact_address' => SiteSetting::get('contact_address', ''),
            'contact_phone' => SiteSetting::get('contact_phone', ''),
            'contact_email' => SiteSetting::get('contact_email', ''),
            'contact_schedule' => SiteSetting::get('contact_schedule', ''),
            'social_facebook' => SiteSetting::get('social_facebook', ''),
            'social_twitter' => SiteSetting::get('social_twitter', ''),
            'social_youtube' => SiteSetting::get('social_youtube', ''),
            'social_instagram' => SiteSetting::get('social_instagram', ''),
            'analytics_id' => SiteSetting::get('analytics_id', ''),
        ];

        $this->data = $settings;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('Configuración')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('General')
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Nombre del sitio')
                                    ->required(),
                                TextInput::make('site_tagline')
                                    ->label('Tagline'),
                                TextInput::make('site_logo')
                                    ->label('Logo (URL)'),
                                TextInput::make('site_favicon')
                                    ->label('Favicon (URL)'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Contacto')
                            ->schema([
                                Textarea::make('contact_address')
                                    ->label('Dirección'),
                                TextInput::make('contact_phone')
                                    ->label('Teléfono'),
                                TextInput::make('contact_email')
                                    ->label('Correo electrónico')
                                    ->email(),
                                Textarea::make('contact_schedule')
                                    ->label('Horario de atención'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Redes sociales')
                            ->schema([
                                TextInput::make('social_facebook')
                                    ->label('Facebook')
                                    ->url(),
                                TextInput::make('social_twitter')
                                    ->label('Twitter/X')
                                    ->url(),
                                TextInput::make('social_youtube')
                                    ->label('YouTube')
                                    ->url(),
                                TextInput::make('social_instagram')
                                    ->label('Instagram')
                                    ->url(),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Avanzado')
                            ->schema([
                                TextInput::make('analytics_id')
                                    ->label('Google Analytics ID')
                                    ->placeholder('G-XXXXXXXXXX'),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar configuración')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value);
        }

        Notification::make()
            ->title('Configuración guardada')
            ->success()
            ->send();
    }
}