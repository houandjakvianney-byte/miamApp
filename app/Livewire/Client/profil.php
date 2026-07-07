<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads; // Obligatoire pour les fichiers
use Illuminate\Support\Facades\Storage;

class Profil extends Component
{
    use WithFileUploads;

    public $utilisateur;
    public $commandes;
    public $photo; // Stocke le fichier uploadé temporairement

    public function mount()
    {
        $this->utilisateur = auth()->user();
        $this->commandes = $this->utilisateur->commandes()->latest()->get();
    }

    public function updatedPhoto()
    {
        // Validation automatique dès que l'utilisateur choisit une photo
        $this->validate([
            'photo' => 'image|max:2048', // Max 2MB
        ]);

        // Sauvegarde de l'image dans le dossier public/profils
        $chemin = $this->photo->store('profils', 'public');

        // Supprimer l'ancienne photo si elle existe pour ne pas encombrer le serveur
        if ($this->utilisateur->avatar) {
            Storage::disk('public')->delete($this->utilisateur->avatar);
        }

        // Mise à jour de l'utilisateur en base de données
        // (Assure-toi d'avoir un champ 'avatar' ou 'photo' dans ta table users)
        $this->utilisateur->update([
            'avatar' => $chemin
        ]);

        session()->flash('message', 'Photo de profil mise à jour !');
    }

    public function render()
    {
        return view('livewire.client.profil');
    }
}
?>