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

/**
 * Base class for data providers with common functionality
 *
 * All data provider classes should extend this base class to inherit
 * common utility methods and maintain consistency across providers.
 */
abstract readonly class BaseDataProvider
{
    public function __construct(
        protected ?int $scalingId = null
    ) {}

    /**
     * Get the scaling ID
     */
    protected function getScalingId(): ?int
    {
        return $this->scalingId;
    }
}
