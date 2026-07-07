<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\On; // 🔴 Cet import est indispensable pour écouter l'événement

class ProfilDropdown extends Component
{
    public bool $ouvert = false;

    public function toggle(): void
    {
        $this->ouvert = !$this->ouvert;
    }

    public function fermer(): void
    {
        $this->ouvert = false;
    }

    // 🔴 On dit à Livewire d'exécuter cette fonction dès que le profil émet 'avatar-mis-a-jour'
    #[On('avatar-mis-a-jour')]
    public function rafraichirNavbar(): void
    {
        // On peut laisser la fonction vide. 
        // Son simple déclenchement va forcer Livewire à refaire le render() 
        // et récupérer le nouvel avatar tout frais d'auth()->user() !
    }

    public function render()
    {
        return view('livewire.client.profil-dropdown', [
            'utilisateur' => auth()->user(),
        ]);
    }
}