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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas'), function (Blueprint $table) {
            $table->text('global_id')->primary();
            $table->text('country')->nullable();
            $table->integer('wdpa_id')->nullable();
            $table->text('name')->nullable();
            $table->text('iucn_category')->nullable();
            $table->text('creation_date')->nullable();
            $table->decimal('perimeter')->nullable();
            $table->decimal('area')->nullable();
            $table->decimal('shape_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas'));
    }
};
