<div class="min-h-screen bg-gray-50" wire:key="profil-client-root">
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        {{-- En-tête --}}
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Mon Profil</h1>
            <p class="text-gray-500 mt-2">Gérez vos informations et suivez vos commandes</p>
        </div>

        {{-- Message de succès --}}
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl text-sm font-medium border border-green-200 flex items-center gap-3 animate-pulse">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- Bloc 1 : Avatar et Infos de base --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-6">
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                {{-- Avatar --}}
                <div class="sm:col-span-1 flex flex-col items-center sm:items-start">
                    <div class="relative w-32 h-32 mb-4">
                        <div class="w-full h-full rounded-full overflow-hidden border-4 border-orange-500 shadow-lg flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600">
                            @if ($utilisateur && $utilisateur->avatar)
                                <img 
                                    src="{{ asset($utilisateur->avatar) }}" 
                                    alt="{{ $utilisateur->nom }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-white">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Indicateur de chargement --}}
                        <div wire:loading wire:target="photo" class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center">
                            <svg class="animate-spin h-8 w-8 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                        {{-- Bouton upload --}}
                        <label class="absolute bottom-0 right-0 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-full cursor-pointer shadow-lg transition hover:shadow-xl transform hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <circle cx="12" cy="13" r="3" stroke="currentColor" stroke-width="2"></circle>
                            </svg>
                            <input 
                                type="file" 
                                wire:model.live="photo"
                                wire:change="save"
                                accept="image/*"
                                class="hidden"
                            >
                        </label>
                    </div>

                    {{-- Erreur photo --}}
                    @error('photo') 
                        <span class="text-xs text-red-500 text-center font-medium">{{ $message }}</span> 
                    @enderror

                    <p class="text-xs text-gray-500 text-center mt-2">JPG, PNG. Max 5MB.</p>
                </div>

                {{-- Infos principales --}}
                <div class="sm:col-span-2 space-y-5">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nom complet</p>
                        <p class="text-xl font-bold text-gray-900">{{ $utilisateur->nom }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email</p>
                        <p class="text-lg text-gray-900">{{ $utilisateur->email }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Type de compte</p>
                            <span class="inline-block px-3 py-1.5 bg-orange-100 text-orange-700 text-sm font-semibold rounded-full">
                                {{ ucfirst(str_replace('_', ' ', $utilisateur->role->value)) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Membre depuis</p>
                            <p class="text-lg text-gray-900">{{ $utilisateur->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bloc 2 : Statistiques des commandes --}}
        @if ($commandes->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Total commandes</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $commandes->count() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Total dépensé</p>
                    <p class="text-2xl font-bold text-orange-600 mt-2">{{ number_format($commandes->sum('montant_total'), 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 font-semibold uppercase">En attente</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $commandes->where('statut.value', 'en_attente')->count() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Livrées</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">{{ $commandes->where('statut.value', 'livree')->count() }}</p>
                </div>
            </div>
        @endif

        {{-- Bloc 3 : Mes commandes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Mes commandes
            </h2>
            
            @if ($commandes->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-gray-400 text-lg font-medium">Aucune commande pour le moment</p>
                    <p class="text-gray-300 text-sm mt-1">Explorez notre menu et passez votre première commande</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($commandes as $commande)
                        <a 
                            href="{{ route('client.suivi-commande', $commande) }}" 
                            class="block p-4 sm:p-6 border border-gray-200 rounded-xl hover:border-orange-500 hover:shadow-md transition duration-200 group"
                            wire:key="commande-{{ $commande->id }}"
                        >
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                {{-- Infos commande --}}
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                                        <p class="font-bold text-gray-900 text-lg">#{{ str_pad($commande->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-bold text-white
                                            {{ match($commande->statut->value) {
                                                'en_attente' => 'bg-yellow-500',
                                                'en_preparation' => 'bg-blue-500',
                                                'en_livraison' => 'bg-purple-500',
                                                'livree' => 'bg-green-600',
                                                'annulee' => 'bg-red-600',
                                                default => 'bg-gray-400',
                                            } }}">
                                            {{ $commande->statut->label() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $commande->created_at->format('d/m/Y') }} à {{ $commande->created_at->format('H:i') }}</p>
                                </div>

                                {{-- Montant et flèche --}}
                                <div class="flex items-center justify-between sm:justify-end gap-4">
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500">Total</p>
                                        <p class="font-bold text-orange-600 text-lg">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 transition transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Bloc 4 : Actions complémentaires --}}
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center sm:justify-start">
            <a href="{{ route('client.menu') }}" class="px-6 py-3 bg-white border border-gray-200 text-gray-900 rounded-lg font-medium hover:border-orange-300 hover:bg-orange-50 transition text-center">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Continuer mes courses
            </a>
        </div>

    </div>
</div>