<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cours', function (Blueprint $table) {
            // Supprime l'ancienne colonne matiere (string)
            $table->dropColumn('matiere');

            // Ajoute la nouvelle FK vers matieres
            $table->foreignId('matiere_id')
                ->nullable()
                ->constrained('matieres')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->dropForeign(['matiere_id']);
            $table->dropColumn('matiere_id');
            $table->string('matiere')->nullable();
        });
    }
};
