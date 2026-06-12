@extends('layouts.main')

@section('seo')
    <meta name="description" content="Mapa interactivo de proyectos de infraestructura del departamento del Beni. Explora los proyectos en curso en todo el departamento.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Mapa de Proyectos - Gobernación del Beni">
    <meta property="og:description" content="Explora los proyectos de infraestructura en todo el departamento del Beni.">
@endsection

@section('content')
<section class="py-16 bg-cream min-h-screen" aria-label="Mapa interactivo de proyectos">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-600 mb-3">
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
                Proyectos en el mapa
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
            </p>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mx-auto mt-2">Mapa Interactivo</h1>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto text-sm">Explora los proyectos de infraestructura en todo el departamento del Beni.</p>
        </div>
        <div class="max-w-6xl mx-auto">
            <div id="beni-map" class="rounded-2xl overflow-hidden shadow-2xl pointer-events-none hover:pointer-events-auto relative" style="height: 600px; z-index: 1;"></div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('beni-map')) {
            // Crear mapa
            const map = L.map('beni-map', {
                scrollWheelZoom: true,
                trackResize: true
            }).setView([-14.5, -64.9], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 18
            }).addTo(map);

            // Cargar municipios del Beni (si existe el archivo)
            fetch('/data/beni-municipios.geojson')
                .then(response => response.json())
                .then(data => {
                    L.geoJSON(data, {
                        pointToLayer: function(feature, latlng) {
                            return L.circleMarker(latlng, {
                                radius: 8,
                                fillColor: '#0f766e',
                                color: '#fff',
                                weight: 2,
                                opacity: 1,
                                fillOpacity: 0.8
                            });
                        },
                        onEachFeature: function(feature, layer) {
                            layer.bindPopup(`
                                <div class="p-2">
                                    <h3 class="font-bold text-lg">${feature.properties.name}</h3>
                                    <p class="text-sm text-gray-600">Provincia: ${feature.properties.province}</p>
                                </div>
                            `);
                        }
                    }).addTo(map);
                })
                .catch(error => console.log('Archivo de municipios no disponible'));

            // Cargar proyectos de infraestructura (si existe la API)
            fetch('/api/infrastructure-projects')
                .then(response => response.json())
                .then(data => {
                    data.forEach(project => {
                        if (project.latitude && project.longitude) {
                            const marker = L.marker([project.latitude, project.longitude], {
                                icon: L.divIcon({
                                    className: 'custom-marker',
                                    html: `<div style="background-color: #0f766e; width: 24px; height: 24px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                                    iconSize: [24, 24],
                                    iconAnchor: [12, 12]
                                })
                            }).addTo(map);

                            marker.bindPopup(`
                                <div class="p-2">
                                    <h3 class="font-bold text-lg">${project.title}</h3>
                                    <p class="text-sm text-gray-600">${project.description || ''}</p>
                                    <p class="text-sm"><strong>Categoría:</strong> ${project.category || '—'}</p>
                                    <p class="text-sm"><strong>Municipio:</strong> ${project.municipality || '—'}</p>
                                    <p class="text-sm"><strong>Estado:</strong> ${project.status || '—'}</p>
                                    ${project.budget ? `<p class="text-sm"><strong>Presupuesto:</strong> Bs. ${parseFloat(project.budget).toLocaleString()}</p>` : ''}
                                </div>
                            `);
                        }
                    });
                })
                .catch(error => console.log('API de proyectos no disponible'));
        }
    });
</script>
@endsection
