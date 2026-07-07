<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $table = 'plats';

    protected $fillable = [
        'categorie_id',
        'nom',
        'prix',
        'disponible',
        'image',
        'description',
    ];

   protected $casts = [
    'prix' => 'float',
    'disponible' => 'boolean',
];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class, 'plat_id');
    }

    public function scopeDisponibles($query)
    {
        return $query->where('disponible', true);
    }
}
