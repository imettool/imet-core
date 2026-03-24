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

namespace ImetCore\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class ScoreBar extends Component
{
    public bool $isNegative = false;

    public function __construct(
        public string $label,
        public string $score,
        public string $percentage,
        public bool $withJs = true,
        public string $color = '#87c89b',
        public int $limitMin = 0,
        public int $limitMax = 100,
    ){
        $this->isNegative = $limitMin < 0;
    }

    public function render(): View
    {
        return view('imet-core::components.score-bar');
    }
}
