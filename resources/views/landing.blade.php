<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIAM - Commandez vos plats préférés</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900">
    <!-- Background avec gradient riche -->
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-orange-900 to-gray-950 flex flex-col overflow-hidden relative">
        
        <!-- Pattern de points (style restaurant) -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" x="40" y="40" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="2" fill="#f97316"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)"/>
            </svg>
        </div>

        <!-- Éléments décoratifs animés - BLANC au lieu d'orange -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-blob"></div>
        

        <!-- Ligne de décoration haute -->
        <div class="absolute top-20 left-0 right-0 h-px bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-30"></div>

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 py-8 sm:py-12 relative z-10">
            
            <!-- Logo et titre -->
            <div class="text-center mb-8 sm:mb-12 lg:mb-16 w-full max-w-lg">
                <!-- Logo avec glow -->
                <div class="flex justify-center mb-4 sm:mb-6 relative">
                    <div class="absolute inset-0 bg-orange-500 rounded-full filter blur-2xl opacity-30 w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32 mx-auto"></div>
                    <img src="/logo-miam.svg" alt="MIAM" class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 drop-shadow-2xl animate-bounce relative">
                </div>

                <!-- Titre principal - NOIR au lieu de blanc -->
                <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black text-gray-900 mb-3 sm:mb-5 leading-tight drop-shadow-2xl tracking-wider" style="text-shadow: 0 0 30px rgba(249, 115, 22, 0.5), 0 4px 20px rgba(0, 0, 0, 0.8);">
                    M<span class="text-orange-500" style="text-shadow: 0 0 20px rgba(249, 115, 22, 0.8);">iam</span>
                </h1>

                <!-- Sous-titre - NOIR au lieu de orange-100 -->
                <p class="text-xl sm:text-2xl lg:text-3xl text-gray-900 font-semibold mb-3 sm:mb-4 drop-shadow-lg">
                    Savourez l'excellence culinaire
                </p>
                
                <!-- Description - GRIS FONCÉ -->
                <p class="text-sm sm:text-base lg:text-lg text-gray-800 px-2 drop-shadow-md max-w-lg mx-auto leading-relaxed">
                    Commandez vos plats préférés en quelques clics et recevez-les rapidement à votre porte
                </p>
            </div>

         <!-- OAuth Buttons -->
            <!-- OAuth Buttons -->
            <div class="space-y-3 mb-8 sm:mb-12 lg:mb-16 w-full max-w-sm">
                <!-- Google -->
                <a 
                    href="{{ route('auth.google') }}" 
                    class="flex items-center justify-center gap-3 bg-white hover:bg-gray-100 text-gray-900 font-semibold py-3 px-6 rounded-lg transition w-full shadow-md"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </a>

                <!-- Facebook -->
                <a 
                    href="{{ route('auth.facebook') }}" 
                    class="flex items-center justify-center gap-3 bg-white hover:bg-gray-100 text-gray-900 font-semibold py-3 px-6 rounded-lg transition w-full shadow-md"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>

                <!-- Apple -->
                <a 
                    href="{{ route('auth.apple') }}" 
                    class="flex items-center justify-center gap-3 bg-white hover:bg-gray-100 text-gray-900 font-semibold py-3 px-6 rounded-lg transition w-full shadow-md"
                >
                    <svg class="w-5 h-5" fill="#000000" viewBox="0 0 24 24">
                        <path d="M17.05 13.5c-.91 2.18-3.47 4.35-6.33 4.35-4.26 0-7.44-3.27-7.44-7.64 0-4.36 3.18-7.63 7.44-7.63 2.86 0 5.42 2.17 6.33 4.34h1.91c-.87-2.98-4.35-7.34-8.24-7.34-5.06 0-8.64 3.81-8.64 10.63 0 6.81 3.58 10.63 8.64 10.63 3.89 0 7.37-4.36 8.24-7.34h-1.91z"/>
                    </svg>
                    Apple
                </a>
            </div>

            <!-- Divider -->
            <div class="w-full max-w-sm mb-8 flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-700"></div>
                <span class="text-gray-400 text-sm">ou</span>
                <div class="flex-1 h-px bg-gray-700"></div>
            </div>

            <!-- Boutons d'action -->
           <!-- Boutons d'action -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full max-w-sm px-0">
                <a 
                    href="{{ route('login') }}" 
                    class="flex-1 bg-white hover:bg-gray-100 text-gray-900 font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl transition-all duration-200 shadow-lg text-center text-sm sm:text-base"
                >
                    Se connecter
                </a>
                <a 
                    href="{{ route('register') }}" 
                    class="flex-1 bg-orange-500 hover:bg-orange-600 active:scale-95 text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl transition-all duration-200 transform hover:scale-105 shadow-xl text-center text-sm sm:text-base"
                >
                    S'inscrire
                </a>
            </div>

        <!-- Footer léger -->
        <div class="text-center py-4 sm:py-6 text-gray-400 text-xs sm:text-sm relative z-10 px-4 border-t border-orange-500 border-opacity-10">
            <p>Savourez chaque moment avec <span class="text-orange-400 font-bold">MIAM</span></p>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>