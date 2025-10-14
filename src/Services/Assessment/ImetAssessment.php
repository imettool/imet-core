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

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\v1\Imet as ImetV1;
use ImetCore\Models\Imet\v2\Imet as ImetV2;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\ImetScores;
use ImetCore\Services\Scores\Labels;

class ImetAssessment
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function getAsModel(ImetV1|ImetV2|int|string $imet): ImetV1|ImetV2
    {
        if (is_int($imet) || is_string($imet)) {
            $imet_model = ImetV2::query()->find($imet);

            return $imet_model->version === ImetV2::version
                ? $imet_model
                : ImetV1::query()->find($imet);
        }

        return $imet;
    }

    /**
     * Retrieve IMET info and scores
     */
    public static function getAssessment(ImetV1|ImetV2|int|string $imet, $step = _Scores::RADAR_SCORES, $with_labels = true): array
    {
        $imet = static::getAsModel($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? ImetScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? ImetScores::get_radar($imet)
                    : ImetScores::get_step($imet, $step)
            );

        $result = [
            'form_id' => $imet->getKey(),
            'wdpa_id' => $imet->wdpa_id,
            'iso3' => $imet->Country,
            'name' => $imet->name,
            'version' => $imet->version,
            'scores' => $scores,
        ];

        return $with_labels
            ? array_merge($result, ['labels' => static::get_scores_labels($imet->version)])
            : $result;
    }

    /**
     * Retrieve the last IMET of the given WDPA (return only ID and version)
     */
    public static function getLast($wdpa_id): ?ImetV2
    {
        return ImetV2::query()->where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->first();
    }

    /**
     * Retrieve the last IMET of the given PA
     */
    public static function getAvailableYears($wdpa_id): Collection
    {
        return ImetV2::query()->where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->get();
    }

    /**
     * Retrieve the number of assessment and the related WDPA IDs for the given country
     */
    public static function getAssessmentByCountry($country, bool $with_scores = true): array
    {
        return ImetV2::query()->select(['FormID', 'wdpa_id', 'Country', 'Year', 'name', 'language', 'version'])
            ->where('Country', $country)
            ->orderBy('Year', 'DESC')
            ->get()
            ->map(function (array $item) use ($with_scores): \stdClass {
                if ($with_scores) {
                    $item['scores'] = ImetScores::get_radar($item, true);
                }

                return $item;
            })
            ->toArray();
    }
}
