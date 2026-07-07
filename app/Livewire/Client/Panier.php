<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Panier extends Component
{
    public array $panier = [];

    public function mount()
    {
        // Charger le panier depuis la session
        $this->panier = session()->get('panier', []);
    }

    public function retirerPlat($platId)
    {
        unset($this->panier[$platId]);
        session()->put('panier', $this->panier);
        $this->dispatch('panier-updated');
    }

    public function monterQuantite($platId)
    {
        if (isset($this->panier[$platId])) {
            $this->panier[$platId]['quantite']++;
            session()->put('panier', $this->panier);
            $this->dispatch('panier-updated');
        }
    }

    public function diminuerQuantite($platId)
    {
        if (isset($this->panier[$platId]) && $this->panier[$platId]['quantite'] > 1) {
            $this->panier[$platId]['quantite']--;
            session()->put('panier', $this->panier);
            $this->dispatch('panier-updated');
        }
    }

    public function validerCommande()
    {
        if (empty($this->panier)) {
            $this->addError('panier', 'Votre panier est vide');
            return;
        }

        // Créer la commande
        $montantTotal = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $this->panier));
        
        $commande = Auth::user()->commandes()->create([
            'statut' => 'en_attente',
            'montant_total' => $montantTotal,
        ]);

        // Ajouter les lignes de commande
        foreach ($this->panier as $platId => $item) {
            $commande->lignes()->create([
                'plat_id' => $platId,
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        session()->forget('panier');
        $this->panier = [];
        
        $this->redirect(route('client.suivi-commande', $commande), navigate: true);
    }

    public function render()
    {
        return view('livewire.client.panier');
    }
}
