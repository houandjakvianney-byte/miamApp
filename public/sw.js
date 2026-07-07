// Service worker minimal : met en cache les pages déjà visitées pour un accès
// rapide et un mode "hors-ligne dégradé". À enrichir plus tard si besoin
// (notifications push, synchronisation en arrière-plan, etc.).

const CACHE_NAME = 'Miam-cache-v1';
const URLS_A_METTRE_EN_CACHE = [
    '/',
    '/manifest.json',
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(URLS_A_METTRE_EN_CACHE))
    );
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((noms) => Promise.all(
            noms.filter((nom) => nom !== CACHE_NAME).map((nom) => caches.delete(nom))
        ))
    );
    self.clients.claim();
});

self.addEventListener('fetch', (event) => {
    // 1. IGNORER les requêtes POST (Crucial pour Livewire)
    if (event.request.method !== 'GET') {
        return; // Laisse passer la requête normalement sans y toucher
    }

    // 2. Stratégie de cache pour le reste (Exemple : Network First ou Cache First)
    event.respondWith(
        fetch(event.request)
            .then((response) => {
                // Si la réponse est valide, on peut tenter de la mettre en cache
                if (response && response.status === 200 && response.type === 'basic') {
                    const responseToCache = response.clone();
                    caches.open('Miam-cache-v1').then((cache) => {
                        cache.put(event.request, responseToCache);
                    });
                }
                return response;
            })
            .catch(() => {
                // En cas de panne réseau, cherche dans le cache
                return caches.match(event.request);
            })
    );
});