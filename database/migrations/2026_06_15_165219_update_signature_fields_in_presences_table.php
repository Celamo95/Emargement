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
            // Renomme signature en signature_formateur
            $table->renameColumn('signature', 'signature_formateur');

            // Ajoute signature_apprenant
            $table->text('signature_apprenant')->nullable()->after('signature_formateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->renameColumn('signature_formateur', 'signature');
            $table->dropColumn('signature_apprenant');
        });
    }
};
