<?php
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->decimal('FunctionalKm2')->nullable();
            $table->decimal('FunctionalPopulation')->nullable();
            $table->text('EcologicalAspects')->nullable();
            $table->decimal('BenefitKm2')->nullable();
            $table->decimal('FunctionalAreaPopulation')->nullable();
            $table->text('BenefitSocioEconomicAspects')->nullable();
            $table->text('SpillOverEffect')->nullable();
            $table->boolean('NoTakeArea')->nullable();
            $table->boolean('FunctionalHasNoTakeArea')->nullable();
            $table->decimal('FunctionalKm')->nullable();
            $table->decimal('BenefitKm')->nullable();
            $table->decimal('BenefitPopulation')->nullable();
            $table->decimal('SpillOverKm2')->nullable();
            $table->decimal('SpillOverKm')->nullable();
            $table->decimal('SpillOverEvalPredatory0_500')->nullable();
            $table->decimal('SpillOverEvalPredatory500_1000')->nullable();
            $table->decimal('SpillOverEvalPredatory200_3000')->nullable();
            $table->decimal('SpillOverEvalComposition0_500')->nullable();
            $table->decimal('SpillOverEvalComposition500_1000')->nullable();
            $table->decimal('SpillOverEvalComposition200_3000')->nullable();
            $table->decimal('SpillOverEvalDistance0_500')->nullable();
            $table->decimal('SpillOverEvalDistance500_1000')->nullable();
            $table->decimal('SpillOverEvalDistance200_3000')->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context'));
    }
};
