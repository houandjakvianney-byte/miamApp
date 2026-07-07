<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// IMPORTANT : cette migration remplace la migration "create_users_table"
// générée par défaut par Laravel/Breeze. Supprime celle-ci après avoir
// installé Breeze, sinon les deux entreront en conflit.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mot_de_passe')->nullable(); // nullable pour les comptes Google
            $table->string('google_id')->nullable()->unique();
            $table->enum('role', ['client', 'admin', 'livreur'])->default('client');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tables système de Laravel (sessions, reset password) qui référencent
        // par défaut "users" — on les garde telles quelles, elles fonctionnent
        // indépendamment du nom de la table utilisateur.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('utilisateurs');
    }
};
