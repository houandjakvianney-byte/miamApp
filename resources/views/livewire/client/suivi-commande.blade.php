<div
    class="max-w-md mx-auto px-4 py-10 text-center"
    @if ($enCours) wire:poll.5s="rafraichirStatut" @endif
>
    <h1 class="text-lg font-semibold text-gray-500 mb-2">Commande #{{ $commande->id }}</h1>

    @php
        $etapes = ['en_attente' => 'En préparation', 'en_preparation' => 'En préparation', 'en_livraison' => 'En livraison', 'livree' => 'Livrée'];
        $statutActuel = $commande->statut->value;
    @endphp

    <div class="my-8">
        <span class="inline-block px-4 py-2 rounded-full text-white font-semibold
            {{ match($statutActuel) {
                'en_attente' => 'bg-yellow-500',
                'en_preparation' => 'bg-blue-500',
                'en_livraison' => 'bg-orange-500',
                'livree' => 'bg-green-600',
                'annulee' => 'bg-red-600',
                default => 'bg-gray-400',
            } }}">
            {{ $commande->statut->label() }}
        </span>
    </div>

    <p class="text-gray-500 text-sm mb-1">Adresse de livraison</p>
    <p class="font-medium text-gray-900 mb-6">{{ $commande->adresse_livraison }}</p>

    <p class="text-gray-500 text-sm mb-1">Montant total</p>
    <p class="font-bold text-xl text-gray-900">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</p>

    @if ($enCours)
        <p class="text-xs text-gray-400 mt-8">Cette page se met à jour automatiquement.</p>
    @endif
</div>
