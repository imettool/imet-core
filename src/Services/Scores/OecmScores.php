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

use ImetCore\Models\Imet\Imet;
use ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\Functions\OECMScores as OECMScoresFunctions;

class OecmScores
{
    use Labels;

    /**
     * Ensure to return IMET id
     */
    private static function getAsId(ImetOecm|int|string $imet): int
    {
        return (is_int($imet) or is_string($imet))
            ? (int) $imet
            : $imet->getKey();
    }

    /**
     * Retrieve IMET OECM assessment's scores (all)
     */
    public static function get_all(ImetOecm|int|string $imet): array
    {
        $imet_id = static::getAsId($imet);

        return OECMScoresFunctions::get_scores($imet_id);
    }

    /**
     * Retrieve IMET OECM assessment's radar scores
     */
    public static function get_radar(ImetOecm|int|string $imet, bool $with_abbreviations = false): array
    {
        $scores = static::get_all($imet)[_Scores::RADAR_SCORES];

        // use abbreviations instead of keys
        if ($with_abbreviations) {
            $labels = static::labels(true);
            unset($scores['imet_index']);

            return array_combine($labels, $scores);
        } else {
            return $scores;
        }
    }

    /**
     * Retrieve IMET OECM assessment's given step scores
     */
    public static function get_step(ImetOecm|int|string $imet, string $step): array
    {
        return static::get_all($imet)[$step];
    }

    /**
     * Retrieve the global IMET OECM assessment score
     */
    public static function get_score(ImetOecm|int|string $imet): array
    {
        return static::get_radar($imet)['imet_index'];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(ImetOecm|int|string $imet): array
    {
        $imet_id = static::getAsId($imet);

        return OECMScoresFunctions::get_scores($imet_id, true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(bool $only_abbreviations = false): array
    {
        return static::get_labels(Imet::IMET_OECM, $only_abbreviations);
    }

    /**
     * Retrieve the indicators labels
     */
    public static function indicators_labels(?string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_scores_labels($version);
    }
}
