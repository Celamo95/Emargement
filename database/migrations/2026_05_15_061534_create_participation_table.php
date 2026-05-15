<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')
                ->constrained('formations')
                ->cascadeOnDelete();
            $table->foreignId('cours_id')
                ->constrained('cours')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participation');
    }
};