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
use ImetCore\Controllers\Imet\v2\Controller as ImetController;
use ImetCore\Models\Imet\Imet;

class Export extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export IMETs to JSON.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $i = 0;
        $imets = Imet::query()->orderBy('name')->orderBy('Year')->get();
        $this->info($imets->count().' IMETS found.');
        foreach ($imets as $imet) {
            new ImetController()->export($imet, false, true);
            $this->info($imet->name.' ('.$imet->Year.') exported.');
            $i++;
        }
        $this->info($i.' IMETS exported (storage/framework/cache/).');

        return 0;
    }
}
