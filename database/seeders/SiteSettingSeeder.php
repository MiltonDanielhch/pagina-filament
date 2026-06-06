<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Gobernación Autónoma Departamental del Beni',
            'site_tagline' => 'Trabajando por el progreso de nuestra gente',
            'contact_email' => 'despacho@beni.gob.bo',
            'contact_phone' => '(591) 346-21651',
            'contact_address' => 'Plaza José Ballivian N° 1, Trinidad, Beni - Bolivia',
            'contact_schedule' => 'Lunes a Viernes: 8:00 - 16:00',
            'social_facebook' => 'https://www.facebook.com/profile.php?id=61589790584981&rdid=B8ljagCl47BWWMeA&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1CTSBMKLaG%2F#',
            'social_twitter' => 'https://twitter.com/GAD_Beni',
            'social_instagram' => 'https://instagram.com/gobernacionbeni',
            'social_youtube' => 'https://youtube.com/@GobernacionBeni',
            'about_title' => 'Gobierno del Beni - Trabajando por el progreso de nuestra gente',
            'about_description' => 'Portal oficial de la Gobernación Autónoma Departamental del Beni, Bolivia. Información sobre servicios gubernamentales, noticias, eventos, trámites y proyectos de desarrollo para el bienestar de los benianos.',
            'about_mission' => 'Garantizar el bienestar integral de la población beniana mediante la gestión eficiente de recursos, el impulso al desarrollo sostenible y la prestación de servicios públicos de calidad, promoviendo la equidad social y el fortalecimiento institucional.',
            'about_vision' => 'Ser una institución pública líder, transparente y eficiente que impulse el desarrollo integral del departamento del Beni, mejorando la calidad de vida de sus habitantes y consolidando su posición como motor de progreso en la región amazónica boliviana.',
            'footer_text' => '© 2026 Gobernación Autónoma Departamental del Beni. Todos los derechos reservados.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
