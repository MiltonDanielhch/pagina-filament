/**
 * Ubicación: public/sw.js
 * Descripción: Service Worker para Progressive Web App del Gobierno del Beni.
 * Funcionalidad: Cache offline, actualización de contenido, notificaciones push.
 * Roadmap: 12-FUTURO.md — App móvil (PWA)
 */

const CACHE_NAME = 'beni-gov-v1';
const OFFLINE_CACHE = 'beni-gov-offline-v1';

// Archivos estáticos para cachear inmediatamente
const STATIC_ASSETS = [
    '/',
    '/blog',
    '/agenda',
    '/estadisticas',
    '/galeria',
    '/tramites',
    '/contacto',
    '/css/app.css',
    '/js/app.js',
    '/images/logo.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-512x512.png',
];

// Estrategia de cache: Cache First para assets estáticos
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return Promise.all(
                STATIC_ASSETS.map(url => {
                    return cache.add(url).catch(error => {
                        console.log('Failed to cache:', url, error);
                    });
                })
            );
        })
    );
    self.skipWaiting();
});

// Estrategia de cache: Network First para contenido dinámico
self.addEventListener('fetch', (event) => {
    // Ignorar peticiones no HTTP (chrome-extension, etc.)
    if (!event.request.url.startsWith('http')) {
        return;
    }
    const url = new URL(event.request.url);

    // Ignorar peticiones de Livewire (no cachear ni interceptar)
    if (url.pathname.includes('/livewire-')) {
        return;
    }

    // Para assets estáticos, usar Cache First
    if (url.pathname.match(/\.(css|js|png|jpg|jpeg|svg|ico|woff|woff2|ttf)$/)) {
        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                if (cachedResponse) {
                    return cachedResponse;
                }
                return fetch(event.request).then((networkResponse) => {
                    return caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, networkResponse.clone());
                        return networkResponse;
                    });
                });
            })
        );
        return;
    }

    // Para páginas HTML, usar Network First con fallback offline
    event.respondWith(
        fetch(event.request)
            .then((networkResponse) => {
                // Cachear respuestas exitosas
                if (networkResponse && networkResponse.status === 200) {
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                }
                return networkResponse;
            })
            .catch(() => {
                // Si falla la red, buscar en cache
                return caches.match(event.request).then((cachedResponse) => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    // Fallback a página offline
                    return caches.match('/offline.html');
                });
            })
    );
});

// Limpiar caches antiguos
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME && cacheName !== OFFLINE_CACHE) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Manejar notificaciones push
self.addEventListener('push', (event) => {
    const options = {
        body: event.data ? event.data.text() : 'Nueva notificación del Gobierno del Beni',
        icon: '/images/icons/icon-192x192.png',
        badge: '/images/icons/icon-96x96.png',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        },
        actions: [
            {
                action: 'explore',
                title: 'Ver',
                icon: '/images/icons/icon-96x96.png'
            },
            {
                action: 'close',
                title: 'Cerrar',
                icon: '/images/icons/icon-96x96.png'
            }
        ]
    };

    event.waitUntil(
        self.registration.showNotification('Gobierno del Beni', options)
    );
});

// Manejar clic en notificación
self.addEventListener('notificationclick', (event) => {
    event.notification.close();

    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    } else if (event.action === 'close') {
        event.waitUntil(
            clients.matchAll().then((clientList) => {
                clientList.forEach((client) => {
                    if (client.url === '/' && 'focus' in client) {
                        return client.focus();
                    }
                });
            })
        );
    }
});

// Sincronización en segundo plano
self.addEventListener('sync', (event) => {
    if (event.tag === 'sync-posts') {
        event.waitUntil(syncPosts());
    }
});

async function syncPosts() {
    // Lógica para sincronizar posts cuando hay conexión
    try {
        const response = await fetch('/api/sync-posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        if (response.ok) {
            console.log('Posts sincronizados exitosamente');
        }
    } catch (error) {
        console.error('Error sincronizando posts:', error);
    }
}
