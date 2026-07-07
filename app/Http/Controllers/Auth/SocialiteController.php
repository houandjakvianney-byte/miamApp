<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    public function redirectGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();
        
        $user = User::firstOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'nom' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        auth()->login($user);

        return redirect()->route('client.menu');
    }

    public function redirectFacebook(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(): RedirectResponse
    {
        $facebookUser = Socialite::driver('facebook')->user();
        
        $user = User::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            [
                'nom' => $facebookUser->getName(),
                'avatar' => $facebookUser->getAvatar(),
            ]
        );

        auth()->login($user);

        return redirect()->route('client.menu');
    }

    public function redirectApple(): RedirectResponse
    {
        return Socialite::driver('apple')->redirect();
    }

    public function callbackApple(): RedirectResponse
    {
        $appleUser = Socialite::driver('apple')->user();
        
        $user = User::firstOrCreate(
            ['email' => $appleUser->getEmail()],
            [
                'nom' => $appleUser->getName() ?? 'Utilisateur Apple',
            ]
        );

        auth()->login($user);

        return redirect()->route('client.menu');
    }
}
