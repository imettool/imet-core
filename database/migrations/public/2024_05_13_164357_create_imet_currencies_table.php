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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'currencies'), function (Blueprint $table) {
            $table->text('iso')->primary();
            $table->text('name_fr')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_sp')->nullable();
            $table->text('name_pt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'currencies'));
    }
};
