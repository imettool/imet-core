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

namespace ImetCore\Services\Assessment;

use ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\OecmScores;
use ImetCore\Services\Scores\Labels;

class OecmAssessment
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function getAsModel(ImetOecm|int|string $imet): ImetOecm
    {
        return (is_int($imet) or is_string($imet))
            ? ImetOecm::query()->find($imet)
            : $imet;
    }

    public static function getAssessment(ImetOecm|int|string $imet, $step = _Scores::RADAR_SCORES, $with_labels = true): array
    {
        $imet = static::getAsModel($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? OecmScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? OecmScores::get_radar($imet)
                    : OecmScores::get_step($imet, $step)
            );

        $result = [
            'form_id' => $imet->getKey(),
            'wdpa_id' => $imet->wdpa_id,
            'iso3' => $imet->Country,
            'name' => $imet->name,
            'version' => $imet->version,
            'scores' => $scores
        ];

        return $with_labels
            ? array_merge($result, ['labels' => static::get_scores_labels($imet->version)])
            : $result;
    }

}
