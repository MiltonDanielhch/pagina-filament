<?php

/**
 * Ubicación: `app/Providers/Filament/AdminPanelProvider.php`
 *
 * Descripción: Configuración del panel Filament: navegación, plugins,
 *              widgets, middleware y grupos de navegación.
 *
 * Vinculación: Se carga automáticamente via Filament
 * Roadmap: 03-ADMIN.md — Bloque 3.1
 */

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\Menu\NavigationMenuItem;
use App\Filament\Widgets\WelcomeWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\RecentPostsWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\PageViewsStatsWidget;
use App\Filament\Widgets\PageViewsBySectionWidget;
use App\Filament\Pages\Settings\SiteSettings;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\IncreaseExecutionTimeForUploads;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Gobernación del Beni')
            ->colors([
                'primary' => Color::Teal,
            ])
            ->plugin(FilamentShieldPlugin::make())
            ->navigationGroups([
                NavigationGroup::make('La Gobernación')
                    ->label('La Gobernación')
                    ->collapsible(),
                NavigationGroup::make('Servicios al Ciudadano')
                    ->label('Servicios al Ciudadano')
                    ->collapsible(),
                NavigationGroup::make('Transparencia')
                    ->label('Transparencia')
                    ->collapsible(),
                NavigationGroup::make('Comunicación')
                    ->label('Comunicación')
                    ->collapsible(),
                NavigationGroup::make('Contacto')
                    ->label('Contacto')
                    ->collapsible(),
                NavigationGroup::make('Turismo')
                    ->label('Turismo')
                    ->collapsible(),
                NavigationGroup::make('Gestión')
                    ->label('Gestión')
                    ->collapsible(),
                NavigationGroup::make('Seguridad')
                    ->label('Seguridad')
                    ->collapsible(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->resources([
                UserResource::class,
                RoleResource::class,
            ])
            ->pages([
                Dashboard::class,
                SiteSettings::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                WelcomeWidget::class,
                FilamentInfoWidget::class,
                StatsOverviewWidget::class,
                RecentPostsWidget::class,
                QuickActionsWidget::class,
                PageViewsStatsWidget::class,
                PageViewsBySectionWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                IncreaseExecutionTimeForUploads::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
