<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Compte admin de test
        User::firstOrCreate(
            ['email' => 'admin@foodapp.test'],
            [
                'nom' => 'Administrateur',
                'mot_de_passe' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Compte client de test
        User::firstOrCreate(
            ['email' => 'client@foodapp.test'],
            [
                'nom' => 'Client Test',
                'mot_de_passe' => bcrypt('password'),
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            CategorieSeeder::class,
            PlatSeeder::class,
        ]);
    }
}
