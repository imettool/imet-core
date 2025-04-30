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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'context_areas'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->decimal('AdministrativeArea')->nullable();
            $table->decimal('GISArea')->nullable();
            $table->decimal('BoundaryLength')->nullable();
            $table->decimal('TerrestrialArea')->nullable();
            $table->decimal('MarineArea')->nullable();
            $table->decimal('PercentageNationalNetwork')->nullable();
            $table->decimal('PercentageEcoregion')->nullable();
            $table->decimal('PercentageTransnationalNetwork')->nullable();
            $table->decimal('PercentageLandscapeNetwork')->nullable();
            $table->string('Index', 25)->nullable();
            $table->text('Observations')->nullable();
            $table->decimal('WDPAArea')->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'context_areas'));
    }
};
