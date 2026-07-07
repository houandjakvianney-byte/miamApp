<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $destination = auth()->user()->estAdmin() ? '/admin' : route('client.menu', absolute: false);
        $this->redirectIntended(default: $destination, navigate: true);
    }
}; ?>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-orange-900 to-gray-950 flex flex-col items-center justify-center px-4 py-12 relative overflow-hidden">

    <!-- Pattern de points (identique à la landing) -->
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

    <!-- Blob décoratif en fond -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-blob"></div>

    <!-- Ligne de décoration haute -->
    <div class="absolute top-20 left-0 right-0 h-px bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-30"></div>

    <!-- Bulles qui montent avec le logo, derrière le formulaire -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="bubble bubble-1"><img src="/logo-miam.svg" alt="" class="w-full h-full object-contain"></div>
        <div class="bubble bubble-2"><img src="/logo-miam.svg" alt="" class="w-full h-full object-contain"></div>
        <div class="bubble bubble-3"><img src="/logo-miam.svg" alt="" class="w-full h-full object-contain"></div>
        <div class="bubble bubble-4"><img src="/logo-miam.svg" alt="" class="w-full h-full object-contain"></div>
        <div class="bubble bubble-5"><img src="/logo-miam.svg" alt="" class="w-full h-full object-contain"></div>
    </div>

    <!-- Logo au-dessus du formulaire -->
    <div class="flex justify-center mb-6 relative z-10">
        <div class="absolute inset-0 bg-orange-500 rounded-full filter blur-2xl opacity-30 w-20 h-20 mx-auto"></div>
        <img src="/logo-miam.svg" alt="MIAM" class="w-16 h-16 drop-shadow-2xl relative">
    </div>

    <!-- Carte du formulaire -->
    <div class="relative z-10 w-full max-w-md">
        <div class="bg-gray-900/70 backdrop-blur-xl border border-orange-500/20 rounded-2xl shadow-2xl px-6 py-8 sm:px-10 sm:py-10">

            <h1 class="text-2xl sm:text-3xl font-black text-black text-center mb-1 tracking-wide">
                Content de te <span class="text-orange-500">revoir</span>
            </h1>
            <p class="text-orange-400 text-sm text-center mb-8">
                Connecte-toi pour retrouver tes plats préférés
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit="login" class="space-y-5">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-black-300 mb-1.5">{{ __('Email') }}</label>
                    <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                        class="block w-full rounded-lg bg-gray-800/80 border border-gray-700 text-white placeholder-gray-500 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-black-300 mb-1.5">{{ __('Password') }}</label>
                    <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full rounded-lg bg-gray-800/80 border border-gray-700 text-white placeholder-gray-500 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="inline-flex items-center cursor-pointer">
                        <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                            class="rounded border-gray-600 bg-gray-800 text-orange-500 focus:ring-orange-500 focus:ring-offset-gray-900" />
                        <span class="ms-2 text-sm text-orange-400">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-orange-400 hover:text-orange-300 transition" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Bouton -->
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 active:scale-95 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] shadow-xl">
                    {{ __('Log in') }}
                </button>
            </form>

            <!-- Lien inscription -->
            <p class="text-center text-sm text-black-400 mt-6">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-black-400 hover:text-orange-300 font-semibold transition" wire:navigate>
                    {{ __('S\'inscrire') }}
                </a>
            </p>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }

        /* Bulles montantes */
        .bubble {
            position: absolute;
            bottom: -150px;
            border-radius: 9999px;
            background: rgba(249, 115, 22, 0.12);
            border: 1px solid rgba(249, 115, 22, 0.25);
            padding: 12px;
            animation: rise linear infinite;
            opacity: 0;
        }
        .bubble-1 { left: 8%;  width: 70px;  height: 70px;  animation-duration: 16s; animation-delay: 0s; }
        .bubble-2 { left: 25%; width: 45px;  height: 45px;  animation-duration: 12s; animation-delay: 3s; }
        .bubble-3 { left: 50%; width: 90px;  height: 90px;  animation-duration: 20s; animation-delay: 1s; }
        .bubble-4 { left: 72%; width: 55px;  height: 55px;  animation-duration: 14s; animation-delay: 5s; }
        .bubble-5 { left: 88%; width: 65px;  height: 65px;  animation-duration: 18s; animation-delay: 7s; }

        @keyframes rise {
            0%   { transform: translateY(0) rotate(0deg);   opacity: 0; }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-120vh) rotate(25deg); opacity: 0; }
        }
    </style>
</div>