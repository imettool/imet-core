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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ImetCore\Helpers\Database;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // CSV retrieved from https://stefangabos.github.io/world_countries/

        $filename = __DIR__.'/countries.csv';
        $data = [];

        // Read the CSV file and extract the countries
        $handle = fopen($filename, 'r');
        if ($handle) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $row = array_combine($header, $row);
                if ($row !== []) {
                    $row = [
                        'iso2' => Str::upper($row['alpha2']),
                        'iso3' => Str::upper($row['alpha3']),
                        'iso' => $row['id'],
                        'name_fr' => $row['fr'],
                        'name_en' => $row['en'],
                        'name_sp' => $row['es'],
                        'name_pt' => $row['pt'],
                        'region_id' => null,
                    ];

                    $data[] = $row;
                }
            }
        }

        $data[] = $this->addFakeCountry();
        $data = $this->addRegion($data);

        // Split the data into chunks
        $data = array_chunk($data, 100);

        // Upsert data into the database
        foreach ($data as $chunk) {
            DB::table(Database::getTable(Database::COMMON_SCHEMA, 'countries'))
                ->upsert($chunk, ['iso3'],
                    ['iso2', 'iso3', 'iso', 'name_fr', 'name_en', 'name_sp', 'name_pt', 'region_id']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table(Database::getTable(Database::COMMON_SCHEMA, 'countries'))->truncate();
    }

    /**
     * Add fake country
     */
    private function addFakeCountry(): array
    {
        return [
            'iso2' => 'WY',
            'iso3' => 'AWY',
            'iso' => null,
            'name_fr' => 'Far Far Away',
            'name_en' => 'Far Far Away',
            'name_sp' => 'Far Far Away',
            'name_pt' => 'Tão Tão Distante',
            'region_id' => null,
        ];
    }

    /**
     * Add region_id (required to maintain backward compatibility with old IMET JSONs - which still using global_id instead of wdpa_id)
     */
    private function addRegion(array $data): array
    {
        foreach ($data as $key => $country) {
            if (in_array($country['iso3'],
                ['AGO', 'ZAF', 'BWA', 'COM', 'LSO', 'MDG', 'MWI', 'MUS', 'MOZ', 'NAM', 'SYC', 'ZMB', 'ZWE'])) {
                $data[$key]['region_id'] = 'sa';
            }

            if (in_array($country['iso3'],
                ['ATG', 'BHS', 'BRB', 'BLZ', 'CUB', 'DMA', 'GRD', 'GUY', 'HTI', 'JAM', 'DOM', 'LCA', 'KNA', 'VCT', 'SUR', 'TTO'])) {
                $data[$key]['region_id'] = 'ac';
            }

            if (in_array($country['iso3'],
                ['AND', 'CPV', 'CIV', 'GMB', 'GHA', 'GIN', 'GNB', 'GUF', 'LBR', 'MLI', 'MRT', 'NER', 'NGA', 'SEN', 'SLE', 'TGO'])) {
                $data[$key]['region_id'] = 'wa';
            }

            if (in_array($country['iso3'],
                ['ATA', 'CMR', 'GAB', 'GNQ', 'CAF', 'COD', 'COG', 'STP', 'TCD'])) {
                $data[$key]['region_id'] = 'ca';
            }

            if (in_array($country['iso3'],
                ['DJI', 'ERI', 'ETH', 'KEN', 'UGA', 'TZA', 'RWA', 'SOM', 'SDN'])) {
                $data[$key]['region_id'] = 'ea';
            }

            if (in_array($country['iso3'],
                ['FSM', 'FJI', 'COK', 'MHL', 'SLB', 'KIR', 'NRU', 'NIU', 'PLW', 'PNG', 'WSM', 'TLS', 'TON', 'TUV', 'VUT'])) {
                $data[$key]['region_id'] = 'ap';
            }

        }

        return $data;
    }
};
