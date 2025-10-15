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
use ImetCore\Models\Imet\v1\Imet as ImetV1;
use ImetCore\Models\Imet\v2\Imet as ImetV2;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\Functions\V1ToV2Scores;
use ImetCore\Services\Scores\Functions\V2Scores;

class ImetScores
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function getAsModel(ImetV1|ImetV2|int|string $imet): ImetV1|ImetV2
    {
        if (is_int($imet) || is_string($imet)) {
            $imet_model = ImetV2::query()->find($imet);

            return $imet_model->version === ImetV2::$version
                ? $imet_model
                : ImetV1::query()->find($imet);
        }

        return $imet;
    }

    /**
     * Retrieve IMET assessment's scores (all)
     */
    public static function get_all(ImetV1|ImetV2|int|string $imet): array
    {
        $imet = static::getAsModel($imet);

        return $imet->version === Imet::IMET_V1
            ? V1ToV2Scores::get_scores($imet->getKey())
            : V2Scores::get_scores($imet->getKey());
    }

    /**
     * Retrieve IMET assessment's radar scores
     */
    public static function get_radar(ImetV1|ImetV2|int|string $imet, bool $with_abbreviations = false): array
    {
        $imet = static::getAsModel($imet);
        $scores = static::get_all($imet)[_Scores::RADAR_SCORES];

        // use abbreviations instead of keys
        if ($with_abbreviations) {
            $labels = static::labels($imet->version, true);
            unset($scores['imet_index']);

            return array_combine($labels, $scores);
        }

        return $scores;
    }

    /**
     * Retrieve IMET assessment's given step scores
     */
    public static function get_step(ImetV1|ImetV2|int|string $imet, string $step): array
    {
        return static::get_all($imet)[$step];
    }

    /**
     * Retrieve the global IMET assessment score
     */
    public static function get_score(ImetV1|ImetV2|int|string $imet): array
    {
        return static::get_radar($imet)['imet_index'];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(ImetV1|ImetV2|int|string $imet): array
    {
        $imet = static::getAsModel($imet);

        return $imet->version === Imet::IMET_V1
            ? V1ToV2Scores::get_scores($imet->getKey(), true)
            : V2Scores::get_scores($imet->getKey(), true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(?string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_labels($version, $only_abbreviations);
    }

    /**
     * Retrieve the indicators labels
     */
    public static function indicators_labels(?string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_scores_labels($version);
    }
}
