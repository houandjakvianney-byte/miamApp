<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Plat;
use Illuminate\Database\Seeder;

class PlatSeeder extends Seeder
{
    public function run(): void
    {
        $plats = [
            'Entrées' => [
                ['nom' => 'Salade composée', 'prix' => 1500],
                ['nom' => 'Beignets de crevettes', 'prix' => 2000],
            ],
            'Plats principaux' => [
                ['nom' => 'Riz gras au poisson', 'prix' => 2500],
                ['nom' => 'Poulet braisé sauce arachide', 'prix' => 3000],
                ['nom' => 'Pâte + sauce gombo', 'prix' => 2000],
            ],
            'Grillades' => [
                ['nom' => 'Brochettes de bœuf', 'prix' => 3500],
                ['nom' => 'Poisson braisé', 'prix' => 4000],
            ],
            'Boissons' => [
                ['nom' => 'Jus de bissap', 'prix' => 500],
                ['nom' => 'Eau minérale', 'prix' => 300],
            ],
            'Desserts' => [
                ['nom' => 'Beignets sucrés', 'prix' => 800],
            ],
        ];

        foreach ($plats as $nomCategorie => $listePlats) {
            $categorie = Categorie::where('nom', $nomCategorie)->first();

            if (! $categorie) {
                continue;
            }

            foreach ($listePlats as $plat) {
                Plat::firstOrCreate(
                    ['nom' => $plat['nom'], 'categorie_id' => $categorie->id],
                    [
                        'prix' => $plat['prix'],
                        'disponible' => true,
                    ]
                );
            }
        }
    }
}
