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
        Schema::create(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas'), function (Blueprint $table) {
            $table->text('global_id')->primary();
            $table->text('country')->nullable();
            $table->integer('wdpa_id')->nullable();
            $table->text('name')->nullable();
            $table->text('iucn_category')->nullable();
            $table->text('creation_date')->nullable();
            $table->decimal('perimeter')->nullable();
            $table->decimal('area')->nullable();
            $table->decimal('shape_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::COMMON_SCHEMA, 'protected_areas'));
    }
};
