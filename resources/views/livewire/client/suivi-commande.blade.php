<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-8">Suivi de commande</h1>

                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600"><strong>Commande #:</strong> {{ $commande->id }}</p>
                    <p class="text-gray-600"><strong>Date:</strong> {{ $commande->date_commande->format('d/m/Y H:i') }}</p>
                    <p class="text-gray-600"><strong>Statut:</strong> 
                        <span class="inline-block px-3 py-1 rounded-full text-white font-semibold
                            @if($commande->statut->value === 'en_attente') bg-yellow-500
                            @elseif($commande->statut->value === 'en_preparation') bg-blue-500
                            @elseif($commande->statut->value === 'en_livraison') bg-purple-500
                            @elseif($commande->statut->value === 'livree') bg-green-500
                            @elseif($commande->statut->value === 'annulee') bg-red-500
                            @endif">
                            {{ $commande->statut->name }}
                        </span>
                    </p>
                </div>

                <h2 class="text-2xl font-semibold mb-4">Articles</h2>
                <div class="overflow-x-auto mb-8">
                    <table class="w-full text-left">
                        <thead class="border-b-2 border-gray-300">
                            <tr>
                                <th class="pb-3">Plat</th>
                                <th class="pb-3">Quantité</th>
                                <th class="pb-3">Prix unitaire</th>
                                <th class="pb-3">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->lignes as $ligne)
                                <tr class="border-b border-gray-200">
                                    <td class="py-4">{{ $ligne->plat->nom }}</td>
                                    <td class="py-4">{{ $ligne->quantite }}</td>
                                    <td class="py-4">{{ number_format($ligne->prix_unitaire, 2) }} €</td>
                                    <td class="py-4 font-semibold">{{ number_format($ligne->quantite * $ligne->prix_unitaire, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-right mb-8">
                    <p class="text-2xl font-bold">Total: {{ number_format($commande->montant_total, 2) }} €</p>
                </div>

                <a href="{{ route('client.menu') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded transition">
                    Retour au menu
                </a>
            </div>
        </div>
    </div>
</div>
