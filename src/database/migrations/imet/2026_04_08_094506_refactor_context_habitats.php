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
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_habitats'), function (Blueprint $table): void {
            $table->renameColumn('Value', 'EcosystemDescription');
            $table->string('EstimatedStatus', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_habitats'), function (Blueprint $table): void {
            $table->renameColumn('EcosystemDescription', 'Value');
            $table->dropColumn('EstimatedStatus');
        });
    }
};
