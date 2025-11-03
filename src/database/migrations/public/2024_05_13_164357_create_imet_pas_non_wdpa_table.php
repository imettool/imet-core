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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas_non_wdpa'), function (Blueprint $table): void {
            $table->integer('id')->primary();
            $table->text('name')->nullable();
            $table->text('designation')->nullable();
            $table->text('designation_type')->nullable();
            $table->text('status')->nullable();
            $table->text('country')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date')->nullable();
            $table->integer('pa_def')->nullable();
            $table->text('origin_name')->nullable();
            $table->text('designation_eng')->nullable();
            $table->integer('marine')->nullable();
            $table->decimal('rep_m_area')->nullable();
            $table->decimal('rep_area')->nullable();
            $table->integer('status_year')->nullable();
            $table->text('ownership_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas_non_wdpa'));
    }
};
