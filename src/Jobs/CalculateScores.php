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

namespace ImetCore\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use ImetCore\Models\Imet\ImetOecm\Imet as ImetOECM;
use ImetCore\Models\Imet\ImetV2\Imet as ImetV2;
use ImetCore\Services\Scores\ImetScores;
use ImetCore\Services\Scores\OecmScores;

/**
 * use this job to update assessments effectiveness scores
 * every time a change is made in an assessment
 * It will cache the scores pre imet in json format
 */
class CalculateScores implements ShouldQueue
{
    use \Illuminate\Foundation\Queue\Queueable;
    use Utils;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // IMETs
        $IMETs = ImetV2::query()->select(['FormID', 'version'])->get();
        foreach ($IMETs as $imet) {
            ImetScores::refresh_scores($imet);
            Log::info('IMET #'.$imet.' scores updated');
        }

        // OECM
        $OECMs = ImetOECM::query()->select(['FormID'])->get();
        foreach ($OECMs as $oecm) {
            OecmScores::refresh_scores($oecm);
            Log::info('OECM #'.$oecm.' scores updated');
        }

    }
}
