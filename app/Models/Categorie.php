<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nom',
        'ordre_affichage',
    ];

    protected $casts = [
        'ordre_affichage' => 'integer',
    ];

    public function plats()
    {
        return $this->hasMany(Plat::class, 'categorie_id');
    }

    public function scopeOrdonnees($query)
    {
        return $query->orderBy('ordre_affichage');
    }
}
