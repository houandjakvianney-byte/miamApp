<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commande_lignes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('plat_id')->constrained('plats')->onDelete('cascade');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 8, 2);
            $table->timestamps();
            $table->index('commande_id');
            $table->index('plat_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commande_lignes');
    }
};