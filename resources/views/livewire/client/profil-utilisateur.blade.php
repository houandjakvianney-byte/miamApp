<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-8">Mon Profil</h1>

                <form wire:submit="mettreAJour" class="space-y-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" id="nom" wire:model="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition">
                            Mettre à jour
                        </button>
                        <a href="{{ route('client.menu') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded transition">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
