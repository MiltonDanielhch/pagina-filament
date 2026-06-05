{{--
    Ubicación: resources/views/statistics/index.blade.php
    Descripción: Página pública de estadísticas departamentales del Beni.
    Accesibilidad: lang="es", semantic HTML, contraste 4.5:1
    Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Estadísticas departamentales del Beni. Indicadores clave de población, economía, educación, salud e infraestructura del departamento del Beni, Bolivia.">
@endsection

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-official to-official-light py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Estadísticas Departamentales</h1>
            <p class="text-xl opacity-90 mb-6">Indicadores clave del desarrollo del Beni</p>
            @if($statistics)
                <p class="text-lg opacity-80">Datos actualizados al año {{ $statistics->year }}</p>
            @else
                <p class="text-lg opacity-80">No hay estadísticas disponibles</p>
            @endif
        </div>
    </div>
</section>

@if($statistics)
<!-- Key Indicators -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Indicadores Clave</h2>
            <p class="text-gray-600">Datos demográficos y geográficos del departamento</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800">Población</h3>
                </div>
                <p class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($statistics->population ?? 0, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">habitantes</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800">PIB</h3>
                </div>
                <p class="text-3xl font-bold text-green-600 mb-2">${{ number_format($statistics->gdp_billion_usd ?? 0, 2, ',', '.') }}B</p>
                <p class="text-sm text-gray-600">miles de millones USD</p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800">Área</h3>
                </div>
                <p class="text-3xl font-bold text-purple-600 mb-2">{{ number_format($statistics->area_km2 ?? 0, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">km²</p>
            </div>
            
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800">Municipios</h3>
                </div>
                <p class="text-3xl font-bold text-orange-600 mb-2">{{ $statistics->municipios ?? 0 }}</p>
                <p class="text-sm text-gray-600">municipios</p>
            </div>
        </div>
    </div>
</section>

<!-- Charts Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Visualizaciones</h2>
            <p class="text-gray-600">Gráficos interactivos de los indicadores departamentales</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Population Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Población Urbana vs Rural</h3>
                <canvas id="populationChart" height="300"></canvas>
            </div>
            
            <!-- GDP Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">PIB Histórico</h3>
                <canvas id="gdpChart" height="300"></canvas>
            </div>
            
            <!-- Education Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Indicadores Educativos</h3>
                <canvas id="educationChart" height="300"></canvas>
            </div>
            
            <!-- Health Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Indicadores de Salud</h3>
                <canvas id="healthChart" height="300"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Statistics -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Detalle de Indicadores</h2>
            <p class="text-gray-600">Información completa por categoría</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Demographics -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Demografía
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Población Total</span>
                        <span class="font-semibold">{{ number_format($statistics->population ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tasa de Crecimiento</span>
                        <span class="font-semibold">{{ number_format($statistics->population_growth_rate ?? 0, 2, ',', '.') }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Población Urbana</span>
                        <span class="font-semibold">{{ number_format($statistics->urban_population ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Población Rural</span>
                        <span class="font-semibold">{{ number_format($statistics->rural_population ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Economy -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Economía
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">PIB</span>
                        <span class="font-semibold">${{ number_format($statistics->gdp_billion_usd ?? 0, 2, ',', '.') }}B</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">PIB per cápita</span>
                        <span class="font-semibold">${{ number_format($statistics->gdp_per_capita_usd ?? 0, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Inflación</span>
                        <span class="font-semibold">{{ number_format($statistics->inflation_rate ?? 0, 2, ',', '.') }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Desempleo</span>
                        <span class="font-semibold">{{ number_format($statistics->unemployment_rate ?? 0, 2, ',', '.') }}%</span>
                    </div>
                </div>
            </div>
            
            <!-- Education -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    Educación
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Escuelas</span>
                        <span class="font-semibold">{{ number_format($statistics->schools ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Estudiantes</span>
                        <span class="font-semibold">{{ number_format($statistics->students ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Docentes</span>
                        <span class="font-semibold">{{ number_format($statistics->teachers ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Alfabetización</span>
                        <span class="font-semibold">{{ number_format($statistics->literacy_rate ?? 0, 2, ',', '.') }}%</span>
                    </div>
                </div>
            </div>
            
            <!-- Health -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Salud
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Hospitales</span>
                        <span class="font-semibold">{{ number_format($statistics->hospitals ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Centros de Salud</span>
                        <span class="font-semibold">{{ number_format($statistics->health_centers ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Médicos</span>
                        <span class="font-semibold">{{ number_format($statistics->doctors ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mortalidad Infantil</span>
                        <span class="font-semibold">{{ number_format($statistics->infant_mortality_rate ?? 0, 2, ',', '.') }} por 1000</span>
                    </div>
                </div>
            </div>
            
            <!-- Infrastructure -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Infraestructura
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Carreteras Pavimentadas</span>
                        <span class="font-semibold">{{ number_format($statistics->paved_roads_km ?? 0, 0, ',', '.') }} km</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Electrificación</span>
                        <span class="font-semibold">{{ number_format($statistics->electrification_coverage ?? 0, 2, ',', '.') }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Usuarios de Internet</span>
                        <span class="font-semibold">{{ number_format($statistics->internet_users ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Source -->
            <div class="border rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Fuente de Datos
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Fuente</span>
                        <span class="font-semibold">{{ $statistics->data_source }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Última Actualización</span>
                        <span class="font-semibold">{{ $statistics->updated_at ? $statistics->updated_at->format('d/m/Y H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- No Data Message -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <p class="text-gray-500 text-lg mb-4">No hay estadísticas disponibles actualmente.</p>
            <p class="text-gray-400">Las estadísticas departamentales serán publicadas próximamente.</p>
        </div>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    @if($statistics && $historicalData->count() > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const statistics = {{ json_encode($statistics) }};
        const historicalData = {{ json_encode($historicalData) }};
        
        // Population Chart (Urban vs Rural)
        const populationCtx = document.getElementById('populationChart').getContext('2d');
        new Chart(populationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Población Urbana', 'Población Rural'],
                datasets: [{
                    data: [statistics.urban_population || 0, statistics.rural_population || 0],
                    backgroundColor: ['#3b82f6', '#10b981'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
        
        // GDP Historical Chart
        const gdpCtx = document.getElementById('gdpChart').getContext('2d');
        const gdpLabels = historicalData.map(d => d.year).reverse();
        const gdpData = historicalData.map(d => d.gdp_billion_usd).reverse();
        
        new Chart(gdpCtx, {
            type: 'line',
            data: {
                labels: gdpLabels,
                datasets: [{
                    label: 'PIB (miles de millones USD)',
                    data: gdpData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
        
        // Education Chart
        const educationCtx = document.getElementById('educationChart').getContext('2d');
        new Chart(educationCtx, {
            type: 'bar',
            data: {
                labels: ['Escuelas', 'Estudiantes', 'Docentes'],
                datasets: [{
                    label: 'Cantidad',
                    data: [statistics.schools || 0, statistics.students || 0, statistics.teachers || 0],
                    backgroundColor: ['#8b5cf6', '#a855f7', '#c084fc'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
        
        // Health Chart
        const healthCtx = document.getElementById('healthChart').getContext('2d');
        new Chart(healthCtx, {
            type: 'bar',
            data: {
                labels: ['Hospitales', 'Centros de Salud', 'Médicos'],
                datasets: [{
                    label: 'Cantidad',
                    data: [statistics.hospitals || 0, statistics.health_centers || 0, statistics.doctors || 0],
                    backgroundColor: ['#ef4444', '#f97316', '#f59e0b'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    });
    @endif
</script>
@endsection
