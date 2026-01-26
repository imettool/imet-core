<?php

namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Imet\ScalingUp\Charts\Group;
use ImetCore\Models\Imet\ScalingUp\Charts\Scatter;

final class GroupingDataProvider
{
    public function __construct(
        private int $scalingId
    ) {}

    public function getRadarData(array $parameters, array $assessments = []): array
    {
        $average = Group::get_calculation_grouping_analysis(
            $parameters,
            $assessments,
            $this->scalingId
        );

        return array_map(fn($data) => [
            ...$data,
            'legend_selected' => true
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
