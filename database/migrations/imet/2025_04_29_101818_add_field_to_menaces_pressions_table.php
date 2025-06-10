<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ImetCore\Helpers\Database;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_menaces_pressions'), function (Blueprint $table) {
            $table->string('Comments', 50)->nullable()->after('Probability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_menaces_pressions'), function (Blueprint $table) {
            $table->dropColumn('Comments');
        });
    }
};
