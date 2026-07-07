<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('nom');
            $table->decimal('prix', 8, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
            $table->index('categorie_id');
            $table->index('disponible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plats');
    }
};