<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProfilUtilisateur extends Component
{
    use WithFileUploads;

    public $utilisateur;
    public $commandes;
    public $photo;

    public function mount()
    {
        $this->utilisateur = auth()->user();
        $this->commandes = $this->utilisateur->commandes()->latest()->get();
    }

    public function save()
    {
        // Simple validation
        if (!$this->photo) {
            return;
        }

        try {
            // Store file
            $filename = 'avatar_' . auth()->id() . '_' . time() . '.' . $this->photo->extension();
            $this->photo->storeAs('avatars', $filename, 'public');

            // Update user
            auth()->user()->update(['avatar' => $filename]);

            // Refresh
            $this->utilisateur = auth()->user();
            $this->photo = null;

            session()->flash('message', 'Photo mise à jour !');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.client.profil-utilisateur');
    }
}