<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiamApp') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                            🍽️ MiamApp
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('client.menu') }}" class="text-gray-700 hover:text-blue-600">Menu</a>
                            <a href="{{ route('client.panier') }}" class="text-gray-700 hover:text-blue-600">Panier</a>
                            <a href="{{ route('client.profil') }}" class="text-gray-700 hover:text-blue-600">Profil</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-12">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <p>&copy; {{ date('Y') }} MiamApp. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
