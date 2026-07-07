<?php

namespace App\Enums;

enum RoleUtilisateur: string
{
    case Client = 'client';
    case Admin = 'admin';
    case Livreur = 'livreur';

    public function label(): string
    {
        return match ($this) {
            self::Client => 'Client',
            self::Admin => 'Administrateur',
            self::Livreur => 'Livreur',
        };
    }
}
