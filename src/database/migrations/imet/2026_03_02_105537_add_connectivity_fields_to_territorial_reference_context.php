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
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context'), function (Blueprint $table): void {
            $table->string('DocumentedConnectivity', 50)->nullable();
            $table->string('EvidenceOfConnectivity', 50)->nullable();
            $table->text('EvidencesListConnectivity')->nullable();
            $table->string('ConnectivityIntegrationInManagementPlan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context'), function (Blueprint $table): void {
            $table->dropColumn('DocumentedConnectivity');
            $table->dropColumn('EvidenceOfConnectivity');
            $table->dropColumn('EvidencesListConnectivity');
            $table->dropColumn('ConnectivityIntegrationInManagementPlan');
        });
    }
};
