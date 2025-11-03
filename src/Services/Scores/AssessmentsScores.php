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

namespace ImetCore\Services\Scores;

use Illuminate\Http\JsonResponse;
use ImetCore\Models\Imet\v1\Imet as ImetV1;
use ImetCore\Models\Imet\v2\Imet as ImetV2;
use ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use ImetCore\Services\Assessment\ImetAssessment;
use ImetCore\Services\Assessment\OecmAssessment;
use ImetCore\Services\Scores\Functions\_Scores;

class AssessmentsScores
{
    public static function scores(ImetV1|ImetV2|int $item, bool $responseTypeJson = true, bool $refresh_cache = false): JsonResponse|array
    {
        $stats = ImetAssessment::getAssessment($item, _Scores::ALL_SCORES, false, $refresh_cache);

        return $responseTypeJson
            ? new JsonResponse($stats)
            : $stats;
    }

    public static function scores_oecm(ImetOecm|int $item, bool $responseTypeJson = true, bool $refresh_cache = false): JsonResponse|array
    {
        $stats = OecmAssessment::getAssessment($item, _Scores::ALL_SCORES, false, $refresh_cache);

        return $responseTypeJson
            ? new JsonResponse($stats)
            : $stats;
    }

    public static function score_class(?int $value): string
    {
        if ($value === null) {
            $class = 'score_no';
        } elseif ($value <= -51) {
            $class = 'score_danger_alert';
        } elseif ($value < -33 && $value > -51) {
            $class = 'score_danger_warning';
        } elseif ($value <= 0) {
            $class = 'score_danger';
        } elseif ($value < 34) {
            $class = 'score_alert';
        } elseif ($value < 51) {
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }

        return $class;
    }

    public static function score_class_threats(?int $value, string $score_success_color = 'score_success'): string
    {
        if ($value === null) {
            $class = 'score_no';
        } elseif ($value < -51) {
            $class = 'score_threat_danger';
        } elseif ($value < -1) {
            $class = 'score_threat_medium_danger';
        } else {
            $class = $score_success_color;
        }

        return $class;
    }
}
