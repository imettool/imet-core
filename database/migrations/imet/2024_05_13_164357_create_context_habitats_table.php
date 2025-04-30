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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'context_habitats'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('EcosystemType')->nullable();
            $table->text('Value')->nullable();
            $table->decimal('Area')->nullable();
            $table->string('Trend', 30)->nullable();
            $table->string('Reliability', 30)->nullable();
            $table->text('Sectors')->nullable();
            $table->text('Comments')->nullable();
            $table->decimal('DesiredConservationStatus')->nullable();

            $table->foreign(['FormID'], 'FormID_fk')
                ->references(['FormID'])
                ->on(Database::getTable(Database::IMET_SCHEMA, 'forms'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'context_habitats'));
    }
};
