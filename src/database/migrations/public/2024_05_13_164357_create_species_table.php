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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'species'), function (Blueprint $table): void {
            $table->increments('id');
            $table->string('kingdom', 100)->nullable();
            $table->string('phylum', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('order', 100)->nullable();
            $table->string('family', 100)->nullable();
            $table->string('genus', 250)->nullable();
            $table->string('species', 250)->nullable();
            $table->string('common_name_fr', 500)->nullable();
            $table->string('common_name_en', 500)->nullable();
            $table->string('common_name_sp', 500)->nullable();
            $table->integer('iucn_redlist_id')->nullable();
            $table->string('iucn_redlist_category', 5)->nullable();
            $table->json('country_distribution')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date', 30)->nullable();

            $table->unique(['order', 'family', 'genus', 'species']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'species'));
    }
};
