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
        Schema::create(Database::getTable(Database::OECM_SCHEMA, 'context_species_animal_presence'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->integer('SpeciesID')->nullable();
            $table->boolean('ExploitedSpecies')->nullable();
            $table->boolean('ProtectedSpecies')->nullable();
            $table->boolean('DisappearingSpecies')->nullable();
            $table->boolean('InvasiveSpecies')->nullable();
            $table->string('PopulationEstimation', 50)->nullable();
            $table->text('DescribeEstimation')->nullable();
            $table->text('Comments')->nullable();
            $table->string('species', 250)->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::OECM_SCHEMA, 'context_species_animal_presence'));
    }
};
