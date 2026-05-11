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
        Schema::table('presences', function (Blueprint $table) {
            $table->foreignId('apprenant_id')
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
        Schema::table('presence', function (Blueprint $table) {
            $table->dropForeign(['apprenant_id']);
            $table->dropColumn('apprenant_id');
        });
    }
};
