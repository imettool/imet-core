<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ImetCore\Helpers\Database;

return new class extends Migration
{
    protected $connection = Database::IMET_CONNECTION;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menaces_pressions', function (Blueprint $table) {
            $table->string('Comments', 50)->nullable()->after('Probability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menaces_pressions', function (Blueprint $table) {
            $table->dropColumn('Comments');
        });
    }
};
