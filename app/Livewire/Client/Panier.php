<?php

namespace App\Livewire\Client;

use App\Enums\StatutCommande;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Plat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Panier extends Component
{
    public string $adresseLivraison = '';

    #[On('panier-mis-a-jour')]
    public function rafraichir(): void
    {
        // Le render() relit la session à chaque appel, rien de plus à faire ici.
    }

    public function incrementer(int $platId): void
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$platId])) {
            $panier[$platId]['quantite']++;
            session()->put('panier', $panier);
        }
    }

    public function decrementer(int $platId): void
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$platId])) {
            $panier[$platId]['quantite']--;

            if ($panier[$platId]['quantite'] <= 0) {
                unset($panier[$platId]);
            }

            session()->put('panier', $panier);
        }
    }

    public function retirer(int $platId): void
    {
        $panier = session()->get('panier', []);
        unset($panier[$platId]);
        session()->put('panier', $panier);
    }

    public function validerCommande()
    {
        $this->validate([
            'adresseLivraison' => 'required|string|min:5|max:255',
        ], [
            'adresseLivraison.required' => "L'adresse de livraison est obligatoire.",
            'adresseLivraison.min' => "L'adresse semble trop courte.",
        ]);

        $panier = session()->get('panier', []);

        if (empty($panier)) {
            $this->addError('panier', 'Votre panier est vide.');
            return;
        }

        $commande = Commande::create([
            'utilisateur_id' => auth()->id(),
            'statut' => StatutCommande::EnAttente,
            'montant_total' => 0,
            'adresse_livraison' => $this->adresseLivraison,
        ]);

        foreach ($panier as $platId => $item) {
            // On revérifie le prix en base pour ne jamais faire confiance à la session.
            $plat = Plat::find($platId);

            if (! $plat) {
                continue;
            }

            LigneCommande::create([
                'commande_id' => $commande->id,
                'plat_id' => $plat->id,
                'quantite' => $item['quantite'],
                'prix_unitaire' => $plat->prix,
            ]);
        }

        $commande->recalculerMontantTotal();

        session()->forget('panier');
        $this->dispatch('panier-mis-a-jour');

        return redirect()->route('client.suivi-commande', $commande);
    }

    public function render()
    {
        $panier = session()->get('panier', []);

        $total = collect($panier)->sum(fn ($item) => $item['prix'] * $item['quantite']);

        return view('livewire.client.panier', [
            'panier' => $panier,
            'total' => $total,
        ]);
    }
}
