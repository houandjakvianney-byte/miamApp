<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Routing\Controller;

class SocialiteController extends Controller
{
    // ==================== GOOGLE ====================
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentification Google échouée');
        }

        $appUser = User::where('google_id', $user->getId())->first();

        if (!$appUser) {
            $appUser = User::create([
                'nom' => $user->getName(),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'role' => 'client',
            ]);
        }

        Auth::login($appUser);

        return redirect()->route('client.menu');
    }

    // ==================== FACEBOOK ====================
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentification Facebook échouée');
        }

        $appUser = User::where('email', $user->getEmail())->first();

        if (!$appUser) {
            $appUser = User::create([
                'nom' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => 'client',
            ]);
        }

        Auth::login($appUser);

        return redirect()->route('client.menu');
    }

    // ==================== APPLE ====================
    public function redirectApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function callbackApple()
    {
        try {
            $user = Socialite::driver('apple')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentification Apple échouée');
        }

        $appUser = User::where('email', $user->getEmail())->first();

        if (!$appUser) {
            $appUser = User::create([
                'nom' => $user->getName() ?? 'Utilisateur Apple',
                'email' => $user->getEmail(),
                'role' => 'client',
            ]);
        }

        Auth::login($appUser);

        return redirect()->route('client.menu');
    }
}