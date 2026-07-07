<div>
    <button
        wire:click="ouvrirModal"
        class="bg-gray-900 hover:bg-orange-500 text-white text-sm font-medium px-3 py-1.5 rounded-lg transition"
    >
        Ajouter
    </button>

    @if ($modalOuverte)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold text-gray-900 mb-4">{{ $plat->nom }}</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                    <input
                        type="number"
                        wire:model.live="quantite"
                        min="1"
                        max="100"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500"
                    >
                    @error('quantite') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <p class="text-gray-600 mb-6">
                    Prix unitaire : <span class="font-bold text-orange-500">{{ number_format($plat->prix, 0, ',', ' ') }} FCFA</span>
                </p>

                <div class="flex gap-3">
                    <button
                        wire:click="$set('modalOuverte', false)"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold py-2 rounded-lg transition"
                    >
                        Annuler
                    </button>
                    <button
                        wire:click="ajouter"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg transition"
                    >
                        Ajouter 
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
