<?php

namespace App\Services;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

/**
 * Generador de textos para compartir noticias en redes sociales.
 *
 * Genera mensajes optimizados para cada red social con hashtags
 * y enlaces adaptados. Diseñado para uso semi-automático (revisión humana).
 */
class SocialShareService
{
    /**
     * Genera el texto completo para Facebook.
     */
    public function getFacebookText(Post $post): string
    {
        $title = $post->meta_title ?? $post->title;
        $excerpt = $post->excerpt ?? $this->truncate($post->body, 150);
        $url = $this->getPostUrl($post);
        $hashtags = $this->getHashtags($post);

        return "{$title}\n\n{$excerpt}\n\n{$url}\n\n{$hashtags}";
    }

    /**
     * Genera el texto para Twitter/X (máximo 280 caracteres).
     */
    public function getTwitterText(Post $post): string
    {
        $title = $post->meta_title ?? $post->title;
        $url = $this->getPostUrl($post);
        $hashtags = $this->getHashtags($post, 2); // Menos hashtags en Twitter

        // Twitter permite 280 chars
        $text = "{$title}\n\n{$url} {$hashtags}";

        if (strlen($text) > 280) {
            $title = $this->truncate($title, 200);
            $text = "{$title}\n\n{$url} {$hashtags}";
        }

        return $text;
    }

    /**
     * Genera el texto para WhatsApp.
     */
    public function getWhatsAppText(Post $post): string
    {
        $title = $post->meta_title ?? $post->title;
        $url = $this->getPostUrl($post);

        return "{$title}\n\n{$url}";
    }

    /**
     * Genera texto genérico copiable para cualquier red.
     */
    public function getGenericText(Post $post): string
    {
        $title = $post->meta_title ?? $post->title;
        $excerpt = $post->excerpt ?? $this->truncate($post->body, 200);
        $url = $this->getPostUrl($post);
        $hashtags = $this->getHashtags($post);

        return "{$title}\n\n{$excerpt}\n\n{$url}\n\n{$hashtags}";
    }

    /**
     * Obtiene la URL completa de la noticia.
     */
    public function getPostUrl(Post $post): string
    {
        $baseUrl = config('app.url');
        return "{$baseUrl}/noticias/{$post->slug}";
    }

    /**
     * Obtiene el URL de compartir en Facebook.
     */
    public function getFacebookShareUrl(Post $post): string
    {
        $url = urlencode($this->getPostUrl($post));
        return "https://www.facebook.com/sharer/sharer.php?u={$url}";
    }

    /**
     * Obtiene el URL de compartir en Twitter/X.
     */
    public function getTwitterShareUrl(Post $post): string
    {
        $text = urlencode($this->getTwitterText($post));
        return "https://twitter.com/intent/tweet?text={$text}";
    }

    /**
     * Obtiene el URL de compartir en WhatsApp.
     */
    public function getWhatsAppShareUrl(Post $post): string
    {
        $text = urlencode($this->getWhatsAppText($post));
        return "https://wa.me/?text={$text}";
    }

    /**
     * Trunca texto limpindolo de HTML.
     */
    protected function truncate(string $text, int $length): string
    {
        // Limpiar HTML tags
        $text = strip_tags($text);

        // Reemplazar espacios múltiples con uno solo
        $text = preg_replace('/\s+/', ' ', $text);

        // Truncar si es necesario
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length - 3) . '...';
        }

        return $text;
    }

    /**
     * Genera hashtags basados en la categoría y título.
     */
    protected function getHashtags(Post $post, int $max = 3): string
    {
        $hashtags = [];

        // Hashtag de la categoría
        if ($post->category) {
            $categoryHashtag = $this->slugToHashtag($post->category->name);
            $hashtags[] = "#{$categoryHashtag}";
        }

        // Hashtag del Beni
        $hashtags[] = '#Beni';

        // Hashtag de la fuente
        $siteName = SiteSetting::get('site_name', 'GobernacionBeni');
        $siteHashtag = $this->slugToHashtag(str_replace(['Gobernación', 'Autónoma', 'Departamental', 'del'], '', $siteName));
        $hashtags[] = "#{$siteHashtag}";

        // Limitar a máximo $max hashtags
        return implode(' ', array_slice($hashtags, 0, $max));
    }

    /**
     * Convierte texto a formato hashtag (sin espacios, capitalizado).
     */
    protected function slugToHashtag(string $text): string
    {
        // Quitar acentos y caracteres especiales
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('/[^a-zA-Z0-9]/', '', $text);

        // Limitar a 20 caracteres
        return substr($text, 0, 20);
    }
}
