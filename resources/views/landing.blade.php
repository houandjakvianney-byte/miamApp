<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section with Carousel -->
        <div class="mb-16">
            <div x-data="Carousel()" @init="init()" @destroy="destroy()" class="carousel-container rounded-lg overflow-hidden shadow-2xl" style="max-height: 500px;">
                <!-- Carousel Items -->
                <div class="carousel-inner" style="height: 500px;">
                    <div x-ref="item" class="carousel-item bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white">
                        <div class="text-center">
                            <h1 class="text-5xl font-bold mb-4">🍽️ Bienvenue chez MiamApp</h1>
                            <p class="text-xl mb-8">Découvrez nos délicieux plats préparés avec amour</p>
                            <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                                Commencer
                            </a>
                        </div>
                    </div>

                    <div x-ref="item" class="carousel-item bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white" style="display: none;">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">🚚 Livraison Rapide</h2>
                            <p class="text-xl mb-8">Recevez vos commandes en moins de 30 minutes</p>
                            <p class="text-lg opacity-90">À domicile ou à emporter</p>
                        </div>
                    </div>

                    <div x-ref="item" class="carousel-item bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center text-white" style="display: none;">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">👨‍🍳 Cuisine de Qualité</h2>
                            <p class="text-xl mb-8">Préparés par nos meilleurs chefs</p>
                            <p class="text-lg opacity-90">Fraîcheur garantie à chaque commande</p>
                        </div>
                    </div>

                    <div x-ref="item" class="carousel-item bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white" style="display: none;">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">💰 Tarifs Avantageux</h2>
                            <p class="text-xl mb-8">Les meilleur prix de la région</p>
                            <p class="text-lg opacity-90">Réductions et promotions régulières</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button @click="prev()" class="carousel-control prev" aria-label="Slide précédent">
                    ❮
                </button>
                <button @click="next()" class="carousel-control next" aria-label="Slide suivant">
                    ❯
                </button>

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <template x-for="(item, index) in items" :key="index">
                        <button 
                            @click="goToSlide(index)" 
                            :class="index === currentIndex ? 'carousel-indicator active' : 'carousel-indicator'"
                            :aria-label="`Aller à la diapo ${index + 1}`"
                        ></button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="card">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-bold mb-2">Sécurisé</h3>
                    <p class="text-gray-600">Vos données sont protégées avec les dernières normes de sécurité</p>
                </div>
            </div>

            <div class="card">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="text-xl font-bold mb-2">Mobile Friendly</h3>
                    <p class="text-gray-600">Commandez depuis n'importe quel appareil, n'importe quand</p>
                </div>
            </div>

            <div class="card">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">⭐</div>
                    <h3 class="text-xl font-bold mb-2">Top Qualité</h3>
                    <p class="text-gray-600">Avis excellents de nos clients satisfaits</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-blue-600 text-white rounded-lg shadow-lg p-12 text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Prêt à commander?</h2>
            <p class="text-xl mb-8">Créez votre compte et commencez à profiter de nos délicieux plats</p>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('client.menu') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition inline-block">
                        Aller au Menu
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition inline-block">
                        S'inscrire
                    </a>
                    <a href="{{ route('login') }}" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 transition inline-block border-2 border-white">
                        Se connecter
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout>
