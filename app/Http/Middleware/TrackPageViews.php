<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    protected array $sectionMap = [
        '/' => 'Inicio',
        'institucional' => 'Gestión',
        'gobernador' => 'Gestión',
        'vice-gobernador' => 'Gestión',
        'resultados' => 'Gestión',
        'estadisticas' => 'Gestión',
        'tramites' => 'Trámites',
        'departamento' => 'Sectores Estratégicos',
        'transparencia' => 'Transparencia',
        'mapa-proyectos' => 'Transparencia',
        'datos-abiertos' => 'Transparencia',
        'convocatorias' => 'Transparencia',
        'blog' => 'Prensa',
        'noticias' => 'Prensa',
        'galeria' => 'Prensa',
        'eventos' => 'Prensa',
        'agenda' => 'Prensa',
        'contacto' => 'Contacto',
        'servicios' => 'Servicios',
        'turismo' => 'Turismo',
        'quejas-reclamos' => 'Quejas',
        'atencion-ciudadano' => 'Atención al Ciudadano',
        'sistemas-externos' => 'Servicios',
        'buscar' => 'Búsqueda',
        'sobre-nosotros' => 'La Gobernación',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->method() !== 'GET') {
            return $response;
        }

        if ($this->isBot($request)) {
            return $response;
        }

        $path = $request->path();

        if (str_starts_with($path, 'admin') || str_starts_with($path, 'api') || str_starts_with($path, 'livewire')) {
            return $response;
        }

        $sessionKey = 'viewed_path_' . md5($path);

        if (Session::has($sessionKey)) {
            return $response;
        }

        Session::put($sessionKey, true);

        $section = $this->resolveSection($path);

        PageView::create([
            'section' => $section,
            'path' => $path,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return $response;
    }

    protected function resolveSection(string $path): string
    {
        if ($path === '/') {
            return 'Inicio';
        }

        $firstSegment = explode('/', $path)[0];

        return $this->sectionMap[$firstSegment] ?? 'Otras páginas';
    }

    protected function isBot(Request $request): bool
    {
        $userAgent = $request->userAgent() ?? '';

        $bots = [
            'bot', 'spider', 'crawl', 'slurp', 'search', 'monitor',
            'facebookexternalhit', 'twitterbot', 'linkedinbot',
            'whatsapp', 'telegrambot', 'discordbot',
        ];

        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }

        return false;
    }
}
