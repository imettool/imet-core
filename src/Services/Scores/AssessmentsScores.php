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

use ImetCore\Models\Imet\ImetV1\Imet as ImetV1;
use ImetCore\Models\Imet\ImetV2\Imet as ImetV2;
use ImetCore\Models\Imet\ImetOecm\Imet as ImetOecm;
use ImetCore\Services\Assessment\ImetAssessment;
use ImetCore\Services\Assessment\OecmAssessment;
use ImetCore\Services\Scores\Functions\_Scores;

class AssessmentsScores
{
    public static function scores(ImetV1|ImetV2|int $item, bool $refresh_cache = false): array
    {
        return ImetAssessment::getAssessment($item, _Scores::ALL_SCORES, false, $refresh_cache);
    }

    public static function scores_oecm(ImetOecm|int $item, bool $refresh_cache = false): array
    {
        return OecmAssessment::getAssessment($item, _Scores::ALL_SCORES, false, $refresh_cache);
    }

    public static function score_class(?int $value): string
    {
        if ($value === null) {
            $class = 'score_no';
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

    public static function score_class_threats(?int $value): string
    {
        if ($value === null) {
            $class = 'score_no';
        } elseif ($value < -50) {
            $class = 'score_very_high_danger';
        } elseif ($value < 0) {
            $class = 'score_high_danger';
        } else {
            $class = 'score_success';
        }

        return $class;
    }

    public static function score_class_contraints(?int $value): string
    {
        if ($value === null) {
            $class = 'score_no';
        } elseif ($value < -50) {
            $class = 'score_very_high_danger';
        } elseif ($value < 0) {
            $class = 'score_high_danger';
        } elseif ($value == 0) {
            $class = 'score_danger';
        } elseif ($value <= 33.3) {
            $class = 'score_alert';
        } elseif ($value <= 50) {
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return $class;
    }


}
