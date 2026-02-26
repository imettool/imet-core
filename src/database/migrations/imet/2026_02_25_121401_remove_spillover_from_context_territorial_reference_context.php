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
            $table->dropColumn('SpillOverKm2');
            $table->dropColumn('SpillOverKm');
            $table->dropColumn('SpillOverEvalPredatory0_500');
            $table->dropColumn('SpillOverEvalPredatory500_1000');
            $table->dropColumn('SpillOverEvalPredatory200_3000');
            $table->dropColumn('SpillOverEvalComposition0_500');
            $table->dropColumn('SpillOverEvalComposition500_1000');
            $table->dropColumn('SpillOverEvalComposition200_3000');
            $table->dropColumn('SpillOverEvalDistance0_500');
            $table->dropColumn('SpillOverEvalDistance500_1000');
            $table->dropColumn('SpillOverEvalDistance200_3000');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context'), function (Blueprint $table): void {
            $table->decimal('SpillOverKm2')->nullable();
            $table->decimal('SpillOverKm')->nullable();
            $table->decimal('SpillOverEvalPredatory0_500')->nullable();
            $table->decimal('SpillOverEvalPredatory500_1000')->nullable();
            $table->decimal('SpillOverEvalPredatory200_3000')->nullable();
            $table->decimal('SpillOverEvalComposition0_500')->nullable();
            $table->decimal('SpillOverEvalComposition500_1000')->nullable();
            $table->decimal('SpillOverEvalComposition200_3000')->nullable();
            $table->decimal('SpillOverEvalDistance0_500')->nullable();
            $table->decimal('SpillOverEvalDistance500_1000')->nullable();
            $table->decimal('SpillOverEvalDistance200_3000')->nullable();
        });
    }
};
