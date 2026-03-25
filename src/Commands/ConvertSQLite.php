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

namespace ImetCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ImetCore\Controllers\Imet\Controller;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ModularForms\Helpers\File\File;
use ModularForms\Helpers\Type\Chars;

class ConvertSQLite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:convert_sqlite {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert old SQLIte base IMET databases to JSON.';

    private $storage;

    private ?ConnectionInterface $db_connection = null;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->storage = Storage::disk('');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \Throwable
     */
    public function handle(): int
    {

        $sqlite_db_file = $this->argument('filename');
        $basename = basename($sqlite_db_file);

        // Input file not found
        if (! $this->storage->exists($basename)) {
            $this->error('File not found at '.$this->storage->path($basename));

            return 1;
        }

        $this->info('');
        $this->info('');

        // Set up connection
        $this->info('Setting up connection with SQLite database...');
        $this->db_connection = $this->db_connection($basename);

        // Retrieve IMET forms from SQLITE
        $this->info('Retrieving IMET assessments...');
        $imets = $this->retrieve();

        if (count($imets) > 0) {
            $this->info(count($imets).' IMETS found. Converting to JSON...');
            foreach ($imets as $i => $imet) {
                $this->info('');
                $this->comment(($i + 1).'. #############');

                // Execute IMET conversion
                $this->convert($imet);
            }
        } else {
            $this->error('No IMET found');

            return 0;
        }

        return 0;
    }

    /**
     *  Create connection to SQLITE file
     */
    private function db_connection(string $filename): ConnectionInterface
    {
        Config::set('database.connections.sqlite_old', [
            'driver' => 'sqlite',
            'database' => $this->storage->path($filename),
        ]);

        return DB::connection('sqlite_old');
    }

    /**
     * Retrieve IMET forms from SQLITE file
     *
     * @return mixed
     */
    private function retrieve()
    {
        return $this->db_connection
            ->table('ProtectedAreas_ProtectedAreaForm')
            ->select()
            ->orderByDesc('Year')
            ->orderBy('Country')
            ->orderBy('ProtectedAreaID')
            ->get();
    }

    /**
     * Convert IMET
     */
    private function convert($imet): void
    {
        $json = Controller::convert($imet, $this->db_connection);

        if (filled($json)) {

            $output = $json['Imet']['name'];
            $output .= ProtectedAreaNonWdpa::isNonWdpa($json['Imet']['wdpa_id']) ? ' (No WDPA)' : ' (WDPA: '.$json['Imet']['wdpa_id'].')';
            $output .= ' - '.$json['Imet']['Country'];
            $output .= ' - '.$json['Imet']['Year'];
            $this->info($output);

            // Save JSON file
            $file_name = 'IMET-V1'.
                (ProtectedAreaNonWdpa::isNonWdpa($json['Imet']['wdpa_id']) ? '' : '_'.$json['Imet']['wdpa_id']).
                '-'.Chars::clean(Chars::replaceAccents($json['Imet']['name'])).
                '-'.$json['Imet']['Year'].
                '.'.'json';
            $file_path = $this->storage->path($file_name);

            $handle = fopen($file_path, 'w');
            fwrite($handle, json_encode($json));
            fclose($handle);
            $this->info('JSON saved: '.$file_path);

        } else {

            $output = 'Cannot identify Protected Area (';
            $output .= 'ProtectedAreaID: '.$imet->ProtectedAreaID;
            $output .= ', Country '.$imet->Country;
            $output .= ', Year '.$imet->Year;
            $output .= ')';
            $this->error($output);

        }
    }
}
