<?php

namespace App\Models;

use App\Enums\StatutCommande;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'utilisateur_id',
        'statut',
        'montant_total',
        'adresse_livraison',
    ];

    protected $casts = [
        'statut' => StatutCommande::class,
        'montant_total' => 'decimal:2',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class, 'commande_id');
    }

    // Recalcule le montant total à partir des lignes de commande.
    public function recalculerMontantTotal(): void
    {
        $this->montant_total = $this->lignes()
            ->get()
            ->sum(fn (LigneCommande $ligne) => $ligne->quantite * $ligne->prix_unitaire);

        $this->save();
    }
}
