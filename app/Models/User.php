<?php

namespace App\Models;

use App\Enums\RoleUtilisateur;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // La table reste "utilisateurs" pour coller au schéma métier,
    // tout en gardant la classe "User" pour rester 100% compatible
    // avec Breeze, Socialite et Filament.
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'google_id',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => RoleUtilisateur::class,
        'mot_de_passe' => 'hashed',
        
    ];
    protected $appends = ['name'];

public function getNameAttribute(): string
{
    return $this->nom;
}

    // Laravel utilise "password" par convention pour l'auth : on le fait
    // pointer vers notre colonne "mot_de_passe".
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'utilisateur_id');
    }

    public function estAdmin(): bool
{
    return $this->role?->value === 'admin' || $this->role === RoleUtilisateur::Admin;
}

    public function estLivreur(): bool
    {
        return $this->role === RoleUtilisateur::Livreur;
    }

    // Restreint l'accès au panel Filament aux admins uniquement.
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->estAdmin();
    }
}
