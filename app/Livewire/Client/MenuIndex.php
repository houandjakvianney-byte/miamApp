<?php

namespace App\Livewire\Client;

use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class MenuIndex extends Component
{
    public ?int $categorieActiveId = null;

    public function mount(): void
    {
        $this->categorieActiveId = Categorie::ordonnees()->first()?->id;
    }

    public function selectionnerCategorie(int $categorieId): void
    {
        $this->categorieActiveId = $categorieId;
    }

    #[On('panier-mis-a-jour')]
    public function rafraichir(): void
    {
        // Force le re-render quand le panier change (badge du header, etc.)
    }

    public function render()
    {
        $categories = Categorie::ordonnees()->with(['plats' => fn ($q) => $q->disponibles()])->get();

        return view('livewire.client.menu-index', [
            'categories' => $categories,
        ]);
    }
}
