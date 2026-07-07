<?php

namespace App\Livewire\Client;

use App\Models\Commande;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class SuiviCommande extends Component
{
    public Commande $commande;

    // Polling toutes les 5s tant que la commande n'est pas livrée/annulée.
    // Suffisant pour un lancement ; à remplacer par Reverb/Pusher plus tard
    // si l'hébergement le permet (process persistant requis).
    public function getListeners(): array
    {
        return [];
    }

    public function mount(Commande $commande): void
    {
        abort_unless($commande->utilisateur_id === auth()->id(), 403);
        $this->commande = $commande;
    }

    public function rafraichirStatut(): void
    {
        $this->commande->refresh();
    }

    public function render()
    {
        $enCours = ! in_array($this->commande->statut->value, ['livree', 'annulee'], true);

        return view('livewire.client.suivi-commande', [
            'enCours' => $enCours,
        ]);
    }
}
