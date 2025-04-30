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
        Schema::table('context_governance', function (Blueprint $table) {
            $table->renameColumn('Type', 'GovernanceModel');
            $table->renameColumn('Comments', 'AdditionalInfo');
            $table->string('SubGovernanceModel', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('context_governance', function (Blueprint $table) {
            $table->dropColumn('SubGovernanceModel');
            $table->renameColumn('GovernanceModel', 'Type');
            $table->renameColumn('AdditionalInfo', 'Comments');
        });
    }
};
