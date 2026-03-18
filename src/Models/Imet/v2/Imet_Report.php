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

namespace ImetCore\Models\Imet\v2;

use ImetCore\Models\Imet\v2\Modules\Report\KeyQuestions;

class Imet_Report extends Imet
{
    public static ?array $modules = [
        'report' => [
            Modules\Report\ManagementContext::class,
            Modules\Report\ManagementEffectivenessAnalysis::class,
            Modules\Report\OperatingRecommendations::class,
            Modules\Report\KeyConservationElements::class,
            Modules\Report\KeyQuestions::class
        ]
    ];
}
