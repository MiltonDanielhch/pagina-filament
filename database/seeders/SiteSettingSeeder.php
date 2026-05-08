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
            'site_description' => 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni, Bolivia',
            'site_keywords' => 'Beni, Gobernación, Bolivia, Trinidad, Gobierno, Servicios',
            'contact_email' => 'despacho@beni.gob.bo',
            'contact_phone' => '(591) 346-21651',
            'contact_address' => 'Plaza José Ballivian N° 1, Trinidad, Beni - Bolivia',
            'social_facebook' => 'https://facebook.com/GobernacionDelBeni',
            'social_twitter' => 'https://twitter.com/GAD_Beni',
            'social_instagram' => 'https://instagram.com/gobernacionbeni',
            'social_youtube' => 'https://youtube.com/@GobernacionBeni',
            'governor_name' => 'Gobernador del Beni',
            'governor_email' => 'gobernador@beni.gob.bo',
            'office_hours' => 'Lun - Vie: 8:00 - 16:00',
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
