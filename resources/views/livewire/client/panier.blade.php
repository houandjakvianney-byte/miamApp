<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-8">Panier</h1>

                @if(empty($panier))
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg mb-4">Votre panier est vide</p>
                        <a href="{{ route('client.menu') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded transition">
                            Retour au menu
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3">Plat</th>
                                    <th class="pb-3">Prix</th>
                                    <th class="pb-3">Quantité</th>
                                    <th class="pb-3">Sous-total</th>
                                    <th class="pb-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $montantTotal = 0; @endphp
                                @foreach($panier as $platId => $item)
                                    @php $sousTotal = $item['prix'] * $item['quantite']; $montantTotal += $sousTotal; @endphp
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-4">{{ $item['nom'] }}</td>
                                        <td class="py-4">{{ number_format($item['prix'], 2) }} €</td>
                                        <td class="py-4">
                                            <div class="flex items-center gap-2">
                                                <button wire:click="diminuerQuantite({{ $platId }})" class="bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded transition">-</button>
                                                <span class="px-4">{{ $item['quantite'] }}</span>
                                                <button wire:click="monterQuantite({{ $platId }})" class="bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded transition">+</button>
                                            </div>
                                        </td>
                                        <td class="py-4 font-semibold">{{ number_format($sousTotal, 2) }} €</td>
                                        <td class="py-4">
                                            <button wire:click="retirerPlat({{ $platId }})" class="text-red-600 hover:text-red-800 transition">
                                                Retirer
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 text-right">
                        <div class="text-2xl font-bold mb-6">Total: {{ number_format($montantTotal, 2) }} €</div>
                        <button wire:click="validerCommande" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded transition text-lg font-semibold">
                            Valider la commande
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
