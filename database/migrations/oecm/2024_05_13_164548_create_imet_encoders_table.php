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
        Schema::create(Database::getTable(Database::OECM_SCHEMA, 'encoders'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('organisation')->nullable();
            $table->string('function')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->foreign(['FormID'], 'FormID_fk')
                ->references(['FormID'])
                ->on(Database::getTable(Database::OECM_SCHEMA, 'forms'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::OECM_SCHEMA, 'encoders'));
    }
};
