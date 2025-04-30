<?php

use ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('context_species_animal_presence', function (Blueprint $table) {
            $table->string('CommonName', 255)->nullable()->after('SpeciesID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('context_species_animal_presence', function (Blueprint $table) {
            $table->dropColumn('CommonName');
        });
    }
};
