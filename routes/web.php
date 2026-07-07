<?php

use App\Livewire\Client\MenuIndex;
use App\Livewire\Client\ProfilUtilisateur;
use App\Livewire\Client\Panier;
use App\Livewire\Client\SuiviCommande;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

// --- Espace client ---
Route::get('/', function () {
    return auth()->check() ? redirect()->route('client.menu') : view('landing');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/menu', MenuIndex::class)->name('client.menu');
    Route::get('/panier', Panier::class)->name('client.panier');
     Route::get('/profil', \App\Livewire\Client\ProfilUtilisateur::class)->name('client.profil');
    Route::get('/commandes/{commande}', SuiviCommande::class)->name('client.suivi-commande');
});
// OAuth Google
Route::get('auth/google', [SocialiteController::class, 'redirectGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialiteController::class, 'callbackGoogle'])->name('auth.google.callback');

// OAuth Facebook
Route::get('auth/facebook', [SocialiteController::class, 'redirectFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialiteController::class, 'callbackFacebook']   )->name('auth.facebook.callback');

// OAuth Apple
Route::get('auth/apple', [SocialiteController::class, 'redirectApple'])->name('auth.apple');
Route::get('auth/apple/callback', [SocialiteController::class, 'callbackApple'])->name('auth.apple.callback');
Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class)
    ->name('logout')
    ->middleware('auth');
// --- Auth (Breeze fournit déjà login/register/etc. via ce require) ---
require __DIR__.'/auth.php';

// Le dashboard admin est servi automatiquement par Filament sur /admin
// (défini par `php artisan filament:install --panels`), pas besoin
// de route manuelle ici.
