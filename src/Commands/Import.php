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

use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ImetCore\Controllers\Imet\ImetV2\Controller;
use ModularForms\Helpers\File\File;
use Throwable;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import multiple IMETs JSON.';

    private $storage;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = Storage::disk(File::TEMP_STORAGE);
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $i = 0;
        foreach ($this->storage->files() as $file) {
            if (Str::endsWith($file, '.json')) {
                $file_content = $this->storage->get($file);
                $json = json_decode((string) $file_content, true);
                if ($json !== null && isset($json['Imet']['version'])) {
                    $this->info('Importing file '.$file.'...');
                    try {
                        $response = (new Controller)->import(new Request, $json)->getContent();
                        if (Str::contains($response, 'success')) {
                            $this->info('Successfully imported.');
                        }
                    } catch (Exception|Throwable $e) {
                        $this->error('Error: '.$e->getMessage());
                    }

                    $i++;
                }
            }
        }

        if ($i > 0) {
            $this->info('All done.');
        } else {
            $this->warn('Nothing to import.');
            $this->warn('No IMET json files found in storage/app/temp.');
        }

        return 0;
    }
}
