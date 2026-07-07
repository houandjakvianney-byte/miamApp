<?php

namespace App\Enums;

enum StatutCommande: string
{
    case EnAttente = 'en_attente';
    case EnPreparation = 'en_preparation';
    case EnLivraison = 'en_livraison';
    case Livree = 'livree';
    case Annulee = 'annulee';

    public function label(): string
    {
        return match ($this) {
            self::EnAttente => 'En attente',
            self::EnPreparation => 'En préparation',
            self::EnLivraison => 'En livraison',
            self::Livree => 'Livrée',
            self::Annulee => 'Annulée',
        };
    }

    public function couleur(): string
    {
        return match ($this) {
            self::EnAttente => 'warning',
            self::EnPreparation => 'info',
            self::EnLivraison => 'primary',
            self::Livree => 'success',
            self::Annulee => 'danger',
        };
    }
}
