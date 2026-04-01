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
        $connectivity_table = Database::getTable(Database::IMET_SCHEMA, 'context_connectivity');
        $territorial_reference_context_table = Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context');

        // 1. Create 'context_connectivity'
        Schema::create($connectivity_table, function (Blueprint $table): void {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();

            $table->string('DocumentedConnectivity', 50)->nullable();
            $table->string('EvidenceOfConnectivity', 50)->nullable();
            $table->text('EvidencesListConnectivity')->nullable();
            $table->string('ConnectivityIntegrationInManagementPlan', 50)->nullable();

            $table->foreign(['FormID'], 'FormID_fk')
                ->references(['FormID'])
                ->on(Database::getTable(Database::IMET_SCHEMA, 'forms'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // 2. Copy column values from 'context_territorial_reference_context' to 'context_connectivity'
        DB::table($connectivity_table)
            ->insertUsing(
                ['id', 'FormID', 'UpdateBy', 'UpdateDate', 'DocumentedConnectivity', 'EvidenceOfConnectivity', 'EvidencesListConnectivity', 'ConnectivityIntegrationInManagementPlan'],
                DB::table($territorial_reference_context_table)
                ->select('id', 'FormID', 'UpdateBy', 'UpdateDate', 'DocumentedConnectivity', 'EvidenceOfConnectivity', 'EvidencesListConnectivity', 'ConnectivityIntegrationInManagementPlan')
                ->whereNotNull('DocumentedConnectivity')
                ->orWhereNotNull('EvidenceOfConnectivity')
                ->orWhereNotNull('EvidencesListConnectivity')
                ->orWhereNotNull('ConnectivityIntegrationInManagementPlan')
            );

        // 3. Remove columns from 'context_territorial_reference_context'
        Schema::table($territorial_reference_context_table, function (Blueprint $table): void {
            $table->dropColumn('DocumentedConnectivity');
            $table->dropColumn('EvidenceOfConnectivity');
            $table->dropColumn('EvidencesListConnectivity');
            $table->dropColumn('ConnectivityIntegrationInManagementPlan');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connectivity_table = Database::getTable(Database::IMET_SCHEMA, 'context_connectivity');
        $territorial_reference_context_table = Database::getTable(Database::IMET_SCHEMA, 'context_territorial_reference_context');

        // 1. Create columns in 'context_territorial_reference_context'
        Schema::table($territorial_reference_context_table, function (Blueprint $table): void {
            $table->string('DocumentedConnectivity', 50)->nullable();
            $table->string('EvidenceOfConnectivity', 50)->nullable();
            $table->text('EvidencesListConnectivity')->nullable();
            $table->string('ConnectivityIntegrationInManagementPlan', 50)->nullable();
        });

        // 2. Copy column values back from 'context_connectivity' to 'context_territorial_reference_context'
        DB::statement('
            UPDATE '.$territorial_reference_context_table.'
            SET DocumentedConnectivity = "'.$connectivity_table.'"."DocumentedConnectivity",
                EvidenceOfConnectivity = "'.$connectivity_table.'"."EvidenceOfConnectivity",
                EvidencesListConnectivity = "'.$connectivity_table.'"."EvidencesListConnectivity",
                ConnectivityIntegrationInManagementPlan = "'.$connectivity_table.'"."ConnectivityIntegrationInManagementPlan"
            FROM '.$connectivity_table.'
            WHERE '.$territorial_reference_context_table.'."FormID" = '.$connectivity_table.'."FormID"
        ');

        // 3. Remove 'context_connectivity'
        Schema::dropIfExists($connectivity_table);
    }
};
