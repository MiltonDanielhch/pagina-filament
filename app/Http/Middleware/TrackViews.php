<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para rastrear visitas a posts y eventos.
 *
 * Incrementa el contador view_count sin duplicar visitas de la misma sesión.
 * Solo cuenta visitas de usuarios reales (ignora bots conocida).
 */
class TrackViews
{
    /**
     * Rutas de posts y eventos que deben trackearse.
     */
    protected array $trackedPatterns = [
        'noticias/*',
        'blog/*',
        'eventos/*',
        'events/*',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Solo trackear métodos GET
        if ($request->method() !== 'GET') {
            return $response;
        }

        // Ignorar requests de bots conocidos
        if ($this->isBot($request)) {
            return $response;
        }

        // Rastrear post
        $post = $this->getPost($request);
        if ($post) {
            $this->trackPostView($post, $request);
        }

        // Rastrear evento
        $event = $this->getEvent($request);
        if ($event) {
            $this->trackEventView($event, $request);
        }

        return $response;
    }

    /**
     * Obtiene el post desde la ruta.
     */
    protected function getPost(Request $request): ?Post
    {
        // Rutas: /noticias/{slug}, /blog/{slug}
        $path = $request->path();

        if (preg_match('#^(noticias|blog)/([^/]+)$#', $path, $matches)) {
            return Post::where('slug', $matches[2])->first();
        }

        return null;
    }

    /**
     * Obtiene el evento desde la ruta.
     */
    protected function getEvent(Request $request): ?Event
    {
        // Rutas: /eventos/{slug}, /events/{slug}
        $path = $request->path();

        if (preg_match('#^(eventos|events)/([^/]+)$#', $path, $matches)) {
            return Event::where('slug', $matches[2])->first();
        }

        return null;
    }

    /**
     * Incrementa el contador de vistas del post.
     */
    protected function trackPostView(Post $post, Request $request): void
    {
        $sessionKey = 'viewed_post_' . $post->id;

        // No contar dos veces la misma sesión
        if (Session::has($sessionKey)) {
            return;
        }

        Session::put($sessionKey, true);

        // Incrementar sin disparar eventos
        $post->updateQuietly([
            'view_count' => $post->view_count + 1,
        ]);
    }

    /**
     * Incrementa el contador de vistas del evento.
     */
    protected function trackEventView(Event $event, Request $request): void
    {
        $sessionKey = 'viewed_event_' . $event->id;

        // No contar dos veces la misma sesión
        if (Session::has($sessionKey)) {
            return;
        }

        Session::put($sessionKey, true);

        // Incrementar sin disparar eventos
        $event->updateQuietly([
            'view_count' => $event->view_count + 1,
        ]);
    }

    /**
     * Detecta si es un bot conocido.
     */
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
