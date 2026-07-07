<div wire:key="carousel-root"> 
    <div class="max-w-5xl mx-auto px-4 py-6">
        
        @php
            $imagesCarousel = [
                'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=1200&h=400&q=80', // Salade
                'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=1200&h=400&q=80', // Pizza
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?auto=format&fit=crop&w=1200&h=400&q=80', // Pancakes
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=1200&h=400&q=80', // Grillades
                'https://images.unsplash.com/photo-1484723091739-30a097e8f929?auto=format&fit=crop&w=1200&h=400&q=80'  // Toast
            ];
        @endphp

        <div 
            x-data="{ activeSlide: 0, totalSlides: 5, autoplayInterval: null }" 
            x-init="autoplayInterval = setInterval(() => { activeSlide = activeSlide === totalSlides - 1 ? 0 : activeSlide + 1 }, 5000)"
            @mouseenter="clearInterval(autoplayInterval)" 
            @mouseleave="autoplayInterval = setInterval(() => { activeSlide = activeSlide === totalSlides - 1 ? 0 : activeSlide + 1 }, 5000)"
            class="mb-8 relative"
            wire:key="carousel-container"
        >
            <div class="relative h-64 sm:h-80 lg:h-96 rounded-2xl overflow-hidden shadow-lg bg-gray-100">
                <div class="relative w-full h-full">
                    @for ($i = 1; $i <= 5; $i++)
                        <div
                            x-show="activeSlide === {{ $i - 1 }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:leave="transition ease-in duration-500"
                            class="absolute inset-0"
                            @if($i > 1) style="display: none;" @endif
                        >
                            <img 
                                src="{{ $imagesCarousel[$i - 1] }}" 
                                alt="Slide {{ $i }}"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
                        </div>
                    @endfor
                </div>

                <button @click="activeSlide = activeSlide === 0 ? totalSlides - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-gray-900 rounded-full p-2 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="activeSlide = activeSlide === totalSlides - 1 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-gray-900 rounded-full p-2 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

            <div class="flex justify-center gap-2 mt-4">
                @for ($i = 0; $i < 5; $i++)
                    <button
                        @click="activeSlide = {{ $i }}"
                        :class="activeSlide === {{ $i }} ? 'bg-orange-500 scale-125' : 'bg-gray-300 hover:bg-gray-400'"
                        class="w-2 h-2 rounded-full transition-all duration-300"
                    ></button>
                @endfor
            </div>
        </div>

        {{-- Onglets de catégories --}}
        <div class="flex gap-2 overflow-x-auto pb-3 mb-6 border-b border-gray-200">
            @foreach ($categories as $categorie)
                <button
                    wire:click="selectionnerCategorie({{ $categorie->id }})"
                    class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition
                        {{ $categorieActiveId === $categorie->id ? 'bg-orange-500 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-orange-300' }}"
                >
                    {{ $categorie->nom }}
                </button>
            @endforeach
        </div>

        {{-- Grille des plats --}}
        @php $categorieActive = $categories->firstWhere('id', $categorieActiveId); @endphp
        @if ($categorieActive)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($categorieActive->plats as $plat)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                        <div class="h-36 bg-gray-100 flex items-center justify-center text-gray-300">
                            @if ($plat->image)
                                <img src="{{ asset('storage/' . $plat->image) }}" alt="{{ $plat->nom }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm">Pas d'image</span>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $plat->nom }}</h3>
                            @if ($plat->description)
                                <p class="text-sm text-gray-500 mt-1 flex-1">{{ $plat->description }}</p>
                            @endif
                            <div class="flex items-center justify-between mt-3">
                                <span class="font-bold text-orange-500">{{ number_format($plat->prix, 0, ',', ' ') }} FCFA</span>
                                <livewire:client.ajouter-au-panier :plat="$plat" :key="'ajout-'.$plat->id" />
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 col-span-full text-center py-10">Aucun plat disponible.</p>
                @endforelse
            </div>
        @endif
    </div>
</div>