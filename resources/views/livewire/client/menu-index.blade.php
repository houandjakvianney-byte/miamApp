<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-8">Menu</h1>
                
                @forelse($categories as $categorie)
                    <div class="mb-12">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">{{ $categorie->nom }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($categorie->plats as $plat)
                                @if($plat->disponible)
                                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition border border-gray-200">
                                        @if($plat->image)
                                            <img src="{{ Storage::url($plat->image) }}" alt="{{ $plat->nom }}" class="w-full h-48 object-cover rounded-t-lg">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                                <span class="text-gray-400">Pas d'image</span>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold mb-2">{{ $plat->nom }}</h3>
                                            <p class="text-gray-600 text-sm mb-4">{{ $plat->description }}</p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-2xl font-bold text-blue-600">{{ number_format($plat->prix, 2) }} €</span>
                                                <button wire:click="ajouterAuPanier({{ $plat->id }})" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                                                    Ajouter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="text-gray-500">Aucun plat disponible</p>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-12">Aucune catégorie disponible</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
