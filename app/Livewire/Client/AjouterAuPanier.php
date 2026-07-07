<?php

namespace App\Livewire\Client;

use App\Models\Plat;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AjouterAuPanier extends Component
{
    public Plat $plat;
    public bool $modalOuverte = false;

    #[Validate('required|integer|min:1|max:100')]
    public int $quantite = 1;

    public function ouvrirModal(): void
    {
        $this->modalOuverte = true;
        $this->quantite = 1;
    }

    public function ajouter(): void
    {
        $this->validate();

        $panier = session()->get('panier', []);

        if (isset($panier[$this->plat->id])) {
            $panier[$this->plat->id]['quantite'] += $this->quantite;
        } else {
            $panier[$this->plat->id] = [
                'nom' => $this->plat->nom,
                'prix' => (float) $this->plat->prix,
                'quantite' => $this->quantite,
            ];
        }

        session()->put('panier', $panier);

        $this->modalOuverte = false;
        $this->dispatch('panier-mis-a-jour');
    }

    public function render()
    {
        return view('livewire.client.ajouter-au-panier');
    }
}