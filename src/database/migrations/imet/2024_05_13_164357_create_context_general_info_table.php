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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'context_general_info'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('NationalCategory')->nullable();
            $table->text('Institution')->nullable();
            $table->text('Ecotype')->nullable();
            $table->text('ReferenceText')->nullable();
            $table->text('ReferenceTextDocument')->nullable();
            $table->binary('ReferenceTextDocument_BYTEA')->nullable();
            $table->text('CompleteName')->nullable();
            $table->text('CompleteNameWDPA')->nullable();
            $table->text('UsedName')->nullable();
            $table->integer('WDPA')->nullable();
            $table->string('Type', 35)->nullable();
            $table->text('IUCNCategory1')->nullable();
            $table->text('IUCNCategory2')->nullable();
            $table->text('IUCNCategory3')->nullable();
            $table->char('Country', 3)->nullable();
            $table->integer('CreationYear')->nullable();
            $table->text('Biome')->nullable();
            $table->text('Ecoregions')->nullable();
            $table->text('ReferenceTextValues')->nullable();
            $table->string('MarineDesignation', 250)->nullable();

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
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'context_general_info'));
    }
};
