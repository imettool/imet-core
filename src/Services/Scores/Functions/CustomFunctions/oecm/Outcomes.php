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

namespace ImetCore\Services\Scores\Functions\CustomFunctions\oecm;

use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\KeyElementsImpact;

trait Outcomes
{
    protected static function score_oc2(int $imet_id): ?float
    {
        return KeyElementsImpact::getModule($imet_id)
            ->filter(fn (KeyElementsImpact $item): bool => $item['EffectSH'] !== null
                && $item['ReliabilitySH'] !== null
                && $item['EffectER'] !== null
                && $item['ReliabilityER'] !== null)
            ->map(function (KeyElementsImpact $item): KeyElementsImpact {

                if ($item['ReliabilitySH'] === 'high') {
                    $reliabilitySH = 3;
                } elseif ($item['ReliabilitySH'] === 'medium') {
                    $reliabilitySH = 2;
                } else {
                    $reliabilitySH = 1;
                }

                if ($item['ReliabilityER'] === 'high') {
                    $reliabilityER = 3;
                } elseif ($item['ReliabilityER'] === 'medium') {
                    $reliabilityER = 2;
                } else {
                    $reliabilityER = 1;
                }

                $item['_score'] = (($item['EffectSH'] * $reliabilitySH) + ($item['EffectER'] * $reliabilityER))
                    / ($reliabilitySH + $reliabilityER);

                return $item;
            })
            ->pluck(['_score'])
            ->avg();

    }
}
