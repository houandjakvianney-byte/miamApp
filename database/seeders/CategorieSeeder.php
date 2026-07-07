<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Entrées', 'ordre_affichage' => 1],
            ['nom' => 'Plats principaux', 'ordre_affichage' => 2],
            ['nom' => 'Grillades', 'ordre_affichage' => 3],
            ['nom' => 'Boissons', 'ordre_affichage' => 4],
            ['nom' => 'Desserts', 'ordre_affichage' => 5],
        ];

        foreach ($categories as $categorie) {
            Categorie::firstOrCreate(['nom' => $categorie['nom']], $categorie);
        }
    }
}
