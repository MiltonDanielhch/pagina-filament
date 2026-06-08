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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
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
            'about_title' => SiteSetting::get('about_title', ''),
            'about_description' => SiteSetting::get('about_description', ''),
            'about_mission' => SiteSetting::get('about_mission', ''),
            'about_vision' => SiteSetting::get('about_vision', ''),
            'about_image' => SiteSetting::get('about_image', ''),
        ];

        // Convert FileUpload string paths to arrays for Filament (Livewire v3 requires arrays)
        $settings['site_logo'] = $this->normalizeImageValue($settings['site_logo']);
        $settings['site_favicon'] = $this->normalizeImageValue($settings['site_favicon']);
        $settings['about_image'] = $this->normalizeImageValue($settings['about_image']);

        $this->data = $settings;

        // Debug: log loaded data
        \Log::info('Settings loaded', $settings);
    }

    protected function normalizeImageValue(mixed $value): array
    {
        if (empty($value) || $value === '[]' || $value === null) {
            return [];
        }
        // If it's already an array, return as is
        if (is_array($value)) {
            // Filter out "[]" strings
            $filtered = array_filter($value, fn($v) => $v !== '[]' && !empty($v));
            return array_values($filtered);
        }
        // If it's a string, wrap in array
        return [$value];
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
                                FileUpload::make('site_logo')
                                    ->label('Logo del sitio')
                                    ->image()
                                    ->disk('public')
                                    ->directory('site-logos')
                                    ->imagePreviewHeight(100)
                                    ->columnSpan('full'),
                                FileUpload::make('site_favicon')
                                    ->label('Favicon del sitio')
                                    ->image()
                                    ->disk('public')
                                    ->directory('site-favicons')
                                    ->imagePreviewHeight(80)
                                    ->columnSpan('full'),
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
                        \Filament\Schemas\Components\Tabs\Tab::make('Sobre Nosotros')
                            ->schema([
                                TextInput::make('about_title')
                                    ->label('Título'),
                                RichEditor::make('about_description')
                                    ->label('Descripción')
                                    ->columnSpanFull(),
                                RichEditor::make('about_mission')
                                    ->label('Misión')
                                    ->columnSpanFull(),
                                RichEditor::make('about_vision')
                                    ->label('Visión')
                                    ->columnSpanFull(),
                                FileUpload::make('about_image')
                                    ->label('Imagen')
                                    ->image()
                                    ->disk('public')
                                    ->directory('about-images')
                                    ->imagePreviewHeight(200)
                                    ->columnSpanFull(),
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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar configuración')
                ->action(function () {
                    $this->save();
                }),
        ];
    }

    public function save(): void
    {
        // Use $this->data directly since statePath('data') is set
        $data = $this->data;

        foreach ($data as $key => $value) {
            // Skip empty arrays
            if (is_array($value) && count($value) === 0) {
                continue;
            }
            // Handle FileUpload arrays
            if (is_array($value) && count($value) > 0) {
                $firstValue = reset($value);
                // Skip "[]" marker strings (used when image is removed)
                if ($firstValue === '[]' || $firstValue === null) {
                    continue;
                }
                // Handle TemporaryUploadedFile objects - store and get path
                if ($firstValue instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                    $path = $firstValue->store('/', [
                        'disk' => 'public',
                    ]);
                    SiteSetting::set($key, $path);
                    continue;
                } elseif (is_string($firstValue)) {
                    SiteSetting::set($key, $firstValue);
                    continue;
                }
                // If firstValue is something else (unknown type), skip this field
                continue;
            }
            // Handle null values
            if ($value === null) {
                continue;
            }
            SiteSetting::set($key, $value);
        }

        // Reload settings after save
        $this->loadSettings();

        Notification::make()
            ->title('Configuración guardada')
            ->success()
            ->send();
    }
}
