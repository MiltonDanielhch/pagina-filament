<?php

/**
 * Ubicación: `database/seeders/DatabaseSeeder.php`
 *
 * Descripción: Seeder principal que ejecuta todos los seeders en orden.
 *              Después de migrate:fresh, ejecuta: php artisan db:seed
 *
 * Orden:
 * 1. SetupRolesAndPermissionsSeeder - Shield + roles + admin user
 * 2. Datos de contenido (slides, categorías, páginas, posts, eventos, etc.)
 *
 * Ejecutar: php artisan db:seed
 * Después de: php artisan migrate:fresh
 * Roadmap: 04-DATOS.md — Bloque 4.3
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles, permisos y usuario admin
        $this->call(SetupRolesAndPermissionsSeeder::class);

        // 2. Datos institucionales base (RM 067/2025)
        $this->call([
            SecretariatSeeder::class,       // 1°: secretarías (sin dependencias)
            MarcoNormativoSeeder::class,    // 2°: normativa nacional y departamental
            OfficialSeeder::class,          // autoridades (existentes, después de secretarías)
            ProcedureSeeder::class,         // trámites (depende de secretarías)
            AnnouncementSeeder::class,      // convocatorias (depende de secretarías)
            OfficeSeeder::class,            // oficinas de atención
            OpenDatasetSeeder::class,       // datos abiertos
        ]);

        // 3. Datos de contenido
        $this->call([
            SlideSeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            PostSeeder::class,
            ExternalSystemSeeder::class,
            EventSeeder::class,
            SiteSettingSeeder::class,
            MenuSeeder::class,
            AchievementSeeder::class,
            GallerySeeder::class,
            AgendaSeeder::class,
            InfrastructureProjectSeeder::class,
            DepartmentalStatisticsSeeder::class,
            PostTemplateSeeder::class,
        ]);
    }
}