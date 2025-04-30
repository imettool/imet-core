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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas_non_wdpa'), function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('name')->nullable();
            $table->text('designation')->nullable();
            $table->text('designation_type')->nullable();
            $table->text('status')->nullable();
            $table->text('country')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date')->nullable();
            $table->integer('pa_def')->nullable();
            $table->text('origin_name')->nullable();
            $table->text('designation_eng')->nullable();
            $table->integer('marine')->nullable();
            $table->decimal('rep_m_area')->nullable();
            $table->decimal('rep_area')->nullable();
            $table->integer('status_year')->nullable();
            $table->text('ownership_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas_non_wdpa'));
    }
};
