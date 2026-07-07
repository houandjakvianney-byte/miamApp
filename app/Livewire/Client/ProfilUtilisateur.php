<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ProfilUtilisateur extends Component
{
    #[Validate('required|string|max:255')]
    public string $nom = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    public function mount()
    {
        $user = Auth::user();
        $this->nom = $user->nom;
        $this->email = $user->email;
    }

    public function mettreAJour()
    {
        $this->validate();
        
        Auth::user()->update([
            'nom' => $this->nom,
            'email' => $this->email,
        ]);

        $this->dispatch('notify', ['message' => 'Profil mis à jour avec succès !']);
    }

    public function render()
    {
        return view('livewire.client.profil-utilisateur');
    }
}
