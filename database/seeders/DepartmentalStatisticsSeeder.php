<?php

/**
 * Ubicación: `database/seeders/DepartmentalStatisticsSeeder.php`
 *
 * Descripción: Seeder para estadísticas departamentales del Beni.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace Database\Seeders;

use App\Models\DepartmentalStatistics;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentalStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. Skipping DepartmentalStatisticsSeeder.');
            return;
        }

        // Datos estimados para 2026 basados en proyecciones del INE
        $statistics2026 = [
            'year' => 2026,
            'population' => 485000,
            'population_growth_rate' => 1.8,
            'urban_population' => 285000,
            'rural_population' => 200000,
            'area_km2' => 213564,
            'municipalities' => 48,
            'provinces' => 8,
            'gdp_billion_usd' => 2.8,
            'gdp_per_capita_usd' => 5773,
            'inflation_rate' => 3.2,
            'unemployment_rate' => 4.5,
            'schools' => 850,
            'students' => 120000,
            'teachers' => 5500,
            'literacy_rate' => 92.5,
            'hospitals' => 15,
            'health_centers' => 180,
            'doctors' => 350,
            'infant_mortality_rate' => 18.5,
            'paved_roads_km' => 2500,
            'electrification_coverage' => 78,
            'internet_users' => 280000,
            'notes' => 'Datos estimados para 2026 basados en proyecciones del INE Bolivia.',
            'data_source' => 'INE Bolivia (proyección 2026)',
        ];

        DepartmentalStatistics::create(array_merge($statistics2026, ['user_id' => $user->id]));

        // Datos históricos para mostrar tendencias
        $historicalData = [
            [
                'year' => 2025,
                'population' => 476000,
                'population_growth_rate' => 1.9,
                'urban_population' => 275000,
                'rural_population' => 201000,
                'area_km2' => 213564,
                'municipalities' => 48,
                'provinces' => 8,
                'gdp_billion_usd' => 2.65,
                'gdp_per_capita_usd' => 5567,
                'inflation_rate' => 3.5,
                'unemployment_rate' => 4.8,
                'schools' => 835,
                'students' => 115000,
                'teachers' => 5300,
                'literacy_rate' => 92.0,
                'hospitals' => 14,
                'health_centers' => 175,
                'doctors' => 335,
                'infant_mortality_rate' => 19.0,
                'paved_roads_km' => 2350,
                'electrification_coverage' => 75,
                'internet_users' => 250000,
                'notes' => 'Datos estimados para 2025.',
                'data_source' => 'INE Bolivia',
            ],
            [
                'year' => 2024,
                'population' => 467000,
                'population_growth_rate' => 2.0,
                'urban_population' => 265000,
                'rural_population' => 202000,
                'area_km2' => 213564,
                'municipalities' => 48,
                'provinces' => 8,
                'gdp_billion_usd' => 2.5,
                'gdp_per_capita_usd' => 5355,
                'inflation_rate' => 4.0,
                'unemployment_rate' => 5.0,
                'schools' => 820,
                'students' => 110000,
                'teachers' => 5100,
                'literacy_rate' => 91.5,
                'hospitals' => 13,
                'health_centers' => 170,
                'doctors' => 320,
                'infant_mortality_rate' => 19.5,
                'paved_roads_km' => 2200,
                'electrification_coverage' => 72,
                'internet_users' => 220000,
                'notes' => 'Datos estimados para 2024.',
                'data_source' => 'INE Bolivia',
            ],
            [
                'year' => 2023,
                'population' => 458000,
                'population_growth_rate' => 2.1,
                'urban_population' => 255000,
                'rural_population' => 203000,
                'area_km2' => 213564,
                'municipalities' => 48,
                'provinces' => 8,
                'gdp_billion_usd' => 2.35,
                'gdp_per_capita_usd' => 5131,
                'inflation_rate' => 4.5,
                'unemployment_rate' => 5.2,
                'schools' => 805,
                'students' => 105000,
                'teachers' => 4900,
                'literacy_rate' => 91.0,
                'hospitals' => 12,
                'health_centers' => 165,
                'doctors' => 305,
                'infant_mortality_rate' => 20.0,
                'paved_roads_km' => 2050,
                'electrification_coverage' => 69,
                'internet_users' => 190000,
                'notes' => 'Datos estimados para 2023.',
                'data_source' => 'INE Bolivia',
            ],
        ];

        foreach ($historicalData as $data) {
            DepartmentalStatistics::create(array_merge($data, ['user_id' => $user->id]));
        }

        $this->command->info('Departmental statistics seeded successfully with 4 years of data (2023-2026).');
    }
}
