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

namespace ImetCore\Services\Scores\Functions;

use ImetCore\Models\Imet\Imet;
use ImetCore\Models\Imet\oecm\Imet as ImetOEMC;
use ModularForms\Models\Cache;

abstract class _Scores
{
    use Math;

    const CACHE_PREFIX = 'imet_scores';

    const RADAR_SCORES = 'global';

    const ALL_SCORES = 'ALL';

    const CONTEXT = 'context';

    const PLANNING = 'planning';

    const INPUTS = 'inputs';

    const PROCESS = 'process';

    const OUTPUTS = 'outputs';

    const OUTCOMES = 'outcomes';

    /**
     * Ensure to return IMET model
     */
    public static function getAsModel(Imet|ImetOEMC|int|string $imet): Imet|ImetOEMC
    {
        if (is_int($imet) || is_string($imet)) {
            return Imet::query()->find($imet);
        }

        return $imet;
    }

    abstract public static function scores_context(int $imet_id): array;

    abstract public static function scores_planning(int $imet_id): array;

    abstract public static function scores_inputs(int $imet_id): array;

    abstract public static function scores_process(int $imet_id): array;

    abstract public static function scores_outputs(int $imet_id): array;

    abstract public static function scores_outcomes(int $imet_id): array;

    /**
     * Calculate all assessment scores
     */
    private static function calculate_scores(int $imet_id): array
    {
        // Granular scores per each step
        $scores = [
            static::CONTEXT => static::scores_context($imet_id),
            static::PLANNING => static::scores_planning($imet_id),
            static::INPUTS => static::scores_inputs($imet_id),
            static::PROCESS => static::scores_process($imet_id),
            static::OUTPUTS => static::scores_outputs($imet_id),
            static::OUTCOMES => static::scores_outcomes($imet_id),
        ];

        // Overall steps scores
        $scores[self::RADAR_SCORES] = [
            static::CONTEXT => $scores[static::CONTEXT]['avg_indicator'],
            static::PLANNING => $scores[static::PLANNING]['avg_indicator'],
            static::INPUTS => $scores[static::INPUTS]['avg_indicator'],
            static::PROCESS => $scores[static::PROCESS]['avg_indicator'],
            static::OUTPUTS => $scores[static::OUTPUTS]['avg_indicator'],
            static::OUTCOMES => $scores[static::OUTCOMES]['avg_indicator'],
        ];

        // Overall IMET score
        $scores[self::RADAR_SCORES]['imet_index'] = static::average([
            $scores[self::RADAR_SCORES][static::CONTEXT],
            $scores[self::RADAR_SCORES][static::PLANNING],
            $scores[self::RADAR_SCORES][static::INPUTS],
            $scores[self::RADAR_SCORES][static::PROCESS],
            $scores[self::RADAR_SCORES][static::OUTPUTS],
            $scores[self::RADAR_SCORES][static::OUTCOMES],
        ]);

        return $scores;
    }

    public static function get_scores(int $imet_id, bool $refresh_cache = false): array
    {
        // Retrieve scores from cache
        $cache_key = Cache::buildKey(static::CACHE_PREFIX, ['id' => $imet_id]);
        if (! $refresh_cache && ($cache_value = Cache::get($cache_key)) !== null) {
            $scores = $cache_value;
        }
        // Calculate scores and store in cache
        else {
            $scores = static::calculate_scores($imet_id);
            Cache::put($cache_key, $scores, null);
        }

        return $scores;
    }
}
