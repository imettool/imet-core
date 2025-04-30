<?php

use ImetCore\Helpers\Database;
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
        Schema::table('context_habitats', function (Blueprint $table) {
            $table->string('TerrestrialOrMarine', 50)->nullable()->after('EcosystemType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('context_habitats', function (Blueprint $table) {
            $table->dropColumn('TerrestrialOrMarine');
        });
    }
};
