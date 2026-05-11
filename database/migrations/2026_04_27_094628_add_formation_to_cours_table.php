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
            $table->foreignId('formation_id')
                ->nullable() // null car si on supprime une formation qui est relier dans cours il n'y aura pas d'erreur
                ->constrained('formations') // point to formation table
                ->nullondelete(); //si on supprime une formation la colonne deviendra null dans la table cours
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->dropForeign(['formation_id']);
            $table->dropColumn('formation_id');
        });
    }
};
