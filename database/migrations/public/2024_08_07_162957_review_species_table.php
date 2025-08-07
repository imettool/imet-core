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
        Schema::table(Database::getTable(Database::COMMON_SCHEMA, 'species'), function (Blueprint $table) {

            $table->dropColumn([
                'common_name_fr',
                'common_name_en',
                'common_name_sp',
                'country_distribution'
            ]);

            $table->string('vernacular_names_eng', 500)->nullable();
            $table->string('vernacular_names_spa', 500)->nullable();
            $table->string('vernacular_names_por', 500)->nullable();
            $table->string('vernacular_names_fra', 500)->nullable();
            $table->string('vernacular_names_rus', 500)->nullable();
            $table->string('vernacular_names_deu', 500)->nullable();
            $table->string('vernacular_names_ita', 500)->nullable();
            $table->string('vernacular_names_jpn', 500)->nullable();
            $table->string('vernacular_names_zho', 500)->nullable();
            $table->string('vernacular_names_kor', 500)->nullable();
            $table->string('authorship', 250)->nullable();
            $table->string('col_id', 25)->nullable();
            $table->string('environment', 250)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Database::getTable(Database::COMMON_SCHEMA, 'species'), function (Blueprint $table) {

            $table->dropColumn([
                'vernacular_names_eng',
                'vernacular_names_spa',
                'vernacular_names_por',
                'vernacular_names_fra',
                'vernacular_names_rus',
                'vernacular_names_deu',
                'vernacular_names_ita',
                'vernacular_names_jpn',
                'vernacular_names_zho',
                'vernacular_names_kor',
                'authorship',
                'col_id',
                'environment'
            ]);

            $table->string('common_name_fr', 500)->nullable();
            $table->string('common_name_en', 500)->nullable();
            $table->string('common_name_sp', 500)->nullable();
            $table->json('country_distribution')->nullable();

        });
    }
};
