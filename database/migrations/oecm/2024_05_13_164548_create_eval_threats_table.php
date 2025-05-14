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
        Schema::create(Database::getTable(Database::OECM_SCHEMA, 'eval_threats'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Value')->nullable();
            $table->decimal('Impact')->nullable();
            $table->decimal('Extension')->nullable();
            $table->decimal('Duration')->nullable();
            $table->decimal('Trend')->nullable();
            $table->decimal('Probability')->nullable();
            $table->string('group_key', 50)->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::OECM_SCHEMA, 'eval_threats'));
    }
};
