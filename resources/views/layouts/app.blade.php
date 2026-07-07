<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Miam') }}</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#f97316">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">

   <header class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-md bg-white/90">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        <a href="{{ route('client.menu') }}" class="font-bold text-xl text-gray-900 flex items-center gap-2">
    <img src="/logo-miam.svg" alt="MIAM" class="w-8 h-8">
    <span>M<span class="text-orange-500">iam</span></span>
</a>
        
        <nav class="flex items-center gap-6 sm:gap-8">
            <a href="{{ route('client.menu') }}" class="text-sm font-medium text-gray-600 hover:text-orange-500 transition-colors">Menu</a>
            
            <a href="{{ route('client.panier') }}" class="text-sm font-medium text-gray-600 hover:text-orange-500 transition-colors flex items-center gap-1.5">
                Panier
                <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-0.5 rounded-full">2</span>
            </a>
            
            @auth
                <div class="relative ml-2">
                    <livewire:client.profil-dropdown />
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-xl transition shadow-sm shadow-orange-500/10">
                    Connexion
                </a>
            @endauth
        </nav>
    </div>
</header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
    <
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>

</body>
</html>