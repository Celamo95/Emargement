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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('statut');
            $table->boolean('valide_formateur')->default(false);
            $table->boolean('valide_apprenant')->default(false);
            $table->dateTime('validation_formateur');
            $table->dateTime('validation_apprenant')
                ->nullable();
            $table->foreignId('cours_id')
                ->nullable()
                ->constrained('cours')
                ->nullondelete();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullondelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
