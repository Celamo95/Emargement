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
        Schema::create('justificatifs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fichier')->nullable();
            $table->string('etat')->default('en_attente');
            $table->dateTime('validation_administration')->nullable();
            $table->foreignId('presence_id')
                ->nullable()
                ->constrained('presences')
                ->nullondelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificatifs');
    }
};
