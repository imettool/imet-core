<?php

namespace ImetCore\Models\Imet\API\ScalingUp;

use ImetCore\Models\Imet\API\ScalingUp\Analysis\Average;
use ImetCore\Models\Imet\API\ScalingUp\Analysis\Data;
use ImetCore\Models\Imet\API\ScalingUp\Analysis\DataUpperLowerAverage;
use ImetCore\Models\Imet\API\ScalingUp\Analysis\Ranking;

trait Analysis
{
    use Ranking;
    use Data;
    use Average;
    use DataUpperLowerAverage;
}
