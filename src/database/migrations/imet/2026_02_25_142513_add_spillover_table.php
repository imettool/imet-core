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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'context_spillover'), function (Blueprint $table): void {

            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->string('SupportingEvidence', 50)->nullable();
            $table->string('SupportingKeyObservations', 50)->nullable();
            $table->string('SupportingOtherObservation', 50)->nullable();
            $table->string('SupportingPerceivedSpeciesChange', 50)->nullable();
            $table->string('SupportingPerceivedSizeChange', 50)->nullable();
            $table->text('SupportingComments')->nullable();

            $table->string('ProvisioningEvidence', 50)->nullable();
            $table->string('ProvisioningKeyObservations', 50)->nullable();
            $table->string('ProvisioningOtherObservation', 50)->nullable();
            $table->string('ProvisioningPerceivedCatchChange', 50)->nullable();
            $table->string('ProvisioningPerceivedSpillover', 50)->nullable();
            $table->text('ProvisioningComments')->nullable();
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
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'context_spillover'));
    }
};
