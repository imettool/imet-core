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

namespace ImetCore\Services\Scores\Functions\CustomFunctions\V1;

use ImetCore\Models\Imet\v1\Modules\Evaluation\BoundaryLevel;

trait Planning
{
    protected static function score_p3(int $imet_id): ?float
    {
        $records = BoundaryLevel::getModule($imet_id)
            ->toArray();

        $value = !empty($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 25;
        } elseif($value===2){
            $score = 62.5;
        } elseif($value===3){
            $score = 87.5;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }

        return $score;
    }
}