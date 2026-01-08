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

namespace ImetCore\Models\Imet\ScalingUp\Analysis;

/**
 * Abstract base class for all scaling up analysis classes
 */
abstract class BaseAnalysis
{
    public static string $template = '';

    public static string $title = '';

    public static string $exclude_elements = '';

    public static string $code = '';

    public static string $info_label = '';


    protected static ?int $scaling_id = null;



    /**
     * Set the scaling ID for all analysis operations
     * Call this once before performing any analysis
     */
    public static function setScalingId(int $scalingId): void
    {
        static::$scaling_id = $scalingId;
    }

    /**
     * Get the current scaling ID
     */
    protected static function getScalingId(): ?int
    {
        return static::$scaling_id;
    }

    /**
     * Create a success response
     */
    protected static function successResponse(array $data, ?float $execution_time = null): array
    {
        $response = ['status' => 'success', 'data' => $data];

        if ($execution_time !== null) {
            $response['execution_time'] = $execution_time;
        }

        return $response;
    }
}

