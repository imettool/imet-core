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
use ImetCore\Models\Imet\ImetOecm\Imet as ImetOecm;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\Functions\OECMScores as OECMScoresFunctions;

final class OecmScores
{
    use Labels;

    /**
     * Ensure to return IMET id
     */
    private static function getAsId(ImetOecm|int|string $imet): int
    {
        return (is_int($imet) || is_string($imet))
            ? (int) $imet
            : $imet->getKey();
    }

    /**
     * Retrieve IMET OECM assessment's scores (all)
     */
    public static function get_all(ImetOecm|int|string $imet, bool $refresh_cache = false): array
    {
        $imet_id = self::getAsId($imet);

        return OECMScoresFunctions::get_scores($imet_id, $refresh_cache);
    }

    /**
     * Retrieve IMET OECM assessment's radar scores
     */
    public static function get_radar(ImetOecm|int|string $imet, bool $with_abbreviations = false, bool $refresh_cache = false): array
    {
        $scores = self::get_all($imet, $refresh_cache)[_Scores::RADAR_SCORES];

        // use abbreviations instead of keys
        if ($with_abbreviations) {
            $labels = self::labels(true);
            unset($scores['imet_index']);

            return array_combine($labels, $scores);
        }

        return $scores;
    }

    /**
     * Retrieve IMET OECM assessment's given step scores
     */
    public static function get_step(ImetOecm|int|string $imet, string $step, bool $refresh_cache = false): array
    {
        return self::get_all($imet, $refresh_cache)[$step];
    }

    /**
     * Retrieve the global IMET OECM assessment score
     */
    public static function get_score(ImetOecm|int|string $imet): array
    {
        return self::get_radar($imet)['imet_index'];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(ImetOecm|int|string $imet): array
    {
        $imet_id = self::getAsId($imet);

        return OECMScoresFunctions::get_scores($imet_id, true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(bool $only_abbreviations = false): array
    {
        return self::get_labels(Imet::IMET_OECM, $only_abbreviations);
    }

    /**
     * Retrieve the indicators labels
     */
    public static function indicators_labels(?string $version = null): array
    {
        return self::get_scores_labels($version);
    }
}
