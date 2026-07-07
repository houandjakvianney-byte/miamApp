<x-filament-widgets::widget>
    <x-filament::section>
        <div class="w-full space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">📍 Commandes en cours</h2>
                <span class="text-sm text-gray-600">
                    {{ count($this->getCommandes()) }} active(s)
                </span>
            </div>

            <div id="map" style="height: 500px; border-radius: 8px;" class="w-full"></div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

<script>
    let map = null;
    let markers = {};

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });

    function initMap() {
        if (map) return;

        const defaultLat = 6.1256;
        const defaultLng = 1.2324;

        map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Ajouter les marqueurs
        const commandes = @json($this->getCommandes());
        const statuts = @json($this->getStatuts());

        commandes.forEach(function(commande) {
            addMarker(
                commande.id,
                commande.latitude,
                commande.longitude,
                commande.adresse_livraison,
                statuts[commande.statut],
                commande.telephone,
                commande.user.name
            );
        });

        // Fit bounds
        if (Object.keys(markers).length > 0) {
            const group = new L.featureGroup(Object.values(markers));
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    function addMarker(id, lat, lng, adresse, statut, telephone, clientName) {
        const colors = {
            'En attente': 'FFAA00',
            'Confirmée': '3B82F6',
            'En préparation': '8B5CF6',
            'Prête': '10B981',
            'En livraison': 'F59E0B',
            'Livrée': '06B6D4',
            'Annulée': 'EF4444',
            'Refusée': 'DC2626',
        };

        const color = colors[statut] || 'FFAA00';

        const marker = L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-${color}.png`,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            })
        }).bindPopup(`
            <div style="font-size: 12px;">
                <strong>#${id}</strong><br>
                <strong>${clientName}</strong><br>
                <em>${statut}</em><br>
                📍 ${adresse}<br>
                📞 ${telephone}
            </div>
        `).addTo(map);

        markers[id] = marker;
    }
</script>