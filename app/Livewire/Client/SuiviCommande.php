<?php

namespace App\Livewire\Client;

use App\Models\Commande;
use Livewire\Component;

class SuiviCommande extends Component
{
    public Commande $commande;

    public function render()
    {
        return view('livewire.client.suivi-commande', [
            'commande' => $this->commande->load('lignes.plat', 'utilisateur'),
        ]);
    }
}
