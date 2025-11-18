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
        Schema::table('eval_importance_c12', function (Blueprint $table) {
            $table->boolean('IncludeInStatistics')->nullable()->after('SignificativeClassification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eval_importance_c12', function (Blueprint $table) {
            $table->dropColumn('IncludeInStatistics');
        });
    }
};
