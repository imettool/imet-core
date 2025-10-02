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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'countries'), function (Blueprint $table) {
            $table->text('iso2')->nullable();
            $table->text('iso3')->primary();
            $table->integer('iso')->nullable();
            $table->text('name_fr')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_sp')->nullable();
            $table->text('name_pt')->nullable();
            $table->string('region_id', 2)->nullable();

            $table->foreign(['region_id'], 'fk_region_id')
                ->references(['id'])
                ->on(Database::getTable(Database::COMMON_SCHEMA, 'regions'))
                ->onUpdate('no action')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'countries'));
    }
};
