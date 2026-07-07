<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->enum('statut', ['en_attente', 'en_preparation', 'en_livraison', 'livree', 'annulee'])->default('en_attente');
            $table->decimal('montant_total', 10, 2)->default(0);
            $table->text('adresse_livraison')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('date_commande')->useCurrent();
            $table->timestamp('date_livraison')->nullable();
            $table->timestamps();
            $table->index('utilisateur_id');
            $table->index('statut');
            $table->index('date_commande');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};