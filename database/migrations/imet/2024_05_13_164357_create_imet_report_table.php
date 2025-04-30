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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'report'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->text('key_species_comment')->nullable();
            $table->text('habitats_comment')->nullable();
            $table->text('climate_change_comment')->nullable();
            $table->text('ecosystem_services_comment')->nullable();
            $table->text('threats_comment')->nullable();
            $table->text('analysis')->nullable();
            $table->text('strengths_swot')->nullable();
            $table->text('weaknesses_swot')->nullable();
            $table->text('opportunities_swot')->nullable();
            $table->text('threats_swot')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('priorities')->nullable();
            $table->text('minimum_budget')->nullable();
            $table->text('additional_funding')->nullable();
            $table->string('UpdateDate', 30)->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'report'));
    }
};
