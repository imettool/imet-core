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

namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Models\Imet\ScalingUp\Charts\Group;
use ImetCore\Models\Imet\ScalingUp\Charts\Scatter;

final readonly class GroupingDataProvider extends BaseDataProvider
{

    public function getRadarData(array $parameters, array $assessments = []): array
    {
        $average = Group::get_calculation_grouping_analysis(
            $parameters,
            $assessments,
            $this->scalingId
        );

        return array_map(fn ($data): array => [
            ...$data,
            'legend_selected' => true,
        ], $average);
    }

    public function getScatterData(
        array $parameters,
        array $assessments = [],
        bool $notGrouped = false
    ): array {
        return Scatter::get_scatter_grouping_analysis(
            $parameters,
            $assessments,
            $notGrouped,
            $this->scalingId
        );
    }
}
