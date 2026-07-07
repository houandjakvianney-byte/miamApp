<?php

namespace App\Livewire\Client;

use App\Models\Categorie;
use App\Models\Plat;
use Livewire\Component;
use Livewire\Attributes\Computed;

class MenuIndex extends Component
{
    public function render()
    {
        return view('livewire.client.menu-index', [
            'categories' => Categorie::ordonnees()->with('plats')->get(),
        ]);
    }
}
