<div class="max-w-2xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-gray-900 mb-6">Votre panier</h1>

    @if (empty($panier))
        <p class="text-gray-400 text-center py-10">Votre panier est vide pour le moment.</p>
    @else
        <div class="space-y-3 mb-6">
            @foreach ($panier as $platId => $item)
                <div class="flex items-center justify-between bg-white border border-gray-100 rounded-xl p-4">
                    <div>
                        <p class="font-medium text-gray-900">{{ $item['nom'] }}</p>
                        <p class="text-sm text-gray-500">{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button wire:click="decrementer({{ $platId }})" class="w-7 h-7 rounded-full bg-gray-100 text-gray-700 font-bold">-</button>
                        <span class="w-6 text-center">{{ $item['quantite'] }}</span>
                        <button wire:click="incrementer({{ $platId }})" class="w-7 h-7 rounded-full bg-gray-100 text-gray-700 font-bold">+</button>
                        <button wire:click="retirer({{ $platId }})" class="text-red-500 text-sm ml-2">Retirer</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-between mb-6 text-lg font-bold text-gray-900">
            <span>Total</span>
            <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
        </div>

        <form wire:submit="validerCommande" class="space-y-3">
           <div>
    <div class="flex items-center justify-between mb-2">
        <label class="block text-sm font-medium text-gray-700">Adresse de livraison</label>
        <button
            type="button"
            @click="$dispatch('demander-localisation')"
            class="text-xs text-orange-500 hover:text-orange-600 font-medium"
        >
            📍 Utiliser ma localisation
        </button>
    </div>
    <input
        type="text"
        wire:model="adresseLivraison"
        placeholder="Ex : Quartier, rue, point de repère..."
        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-orange-500 focus:ring-orange-500"
    >
    @error('adresseLivraison') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    @error('panier') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('demander-localisation', () => {
            if (!navigator.geolocation) {
                alert('Géolocalisation non supportée par votre navigateur');
                return;
            }
            
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    Livewire.dispatch('localisation-recue', {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    });
                },
                (error) => {
                    alert('Impossible d\'accéder à votre localisation: ' + error.message);
                }
            );
        });
    });
</script>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">
                Valider la commande
            </button>
        </form>
    @endif
</div>
