<div class="relative">
    <button wire:click="toggle" class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-orange-500 hover:ring-2 hover:ring-orange-300 transition overflow-hidden">
        @if (auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Photo" class="w-10 h-10 rounded-full object-cover">
        @else
            <span class="text-white font-bold text-sm bg-orange-500 w-10 h-10 rounded-full flex items-center justify-center">{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}</span>
        @endif
    </button>

    @if ($ouvert)
    <div class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 z-50">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-3">
               @if ($utilisateur && $utilisateur->avatar)
    <img src="{{ asset($utilisateur->avatar) }}" class="w-8 h-8 rounded-full object-cover">
@else
    <img src="{{ asset('images/default-avatar.png') }}" class="w-8 h-8 rounded-full object-cover">
@endif
                <div>
                    <p class="font-semibold text-gray-900">{{ auth()->user()->nom }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="px-3 py-2 space-y-1">
            <a href="{{ route('client.profil') }}" wire:click="fermer()" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-gray-700 font-medium text-sm">
                Mon profil
            </a>
        </div>

        <div class="px-3 py-2 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" wire:click="fermer()" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-50 text-red-600 font-medium text-sm">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
    @endif
</div>