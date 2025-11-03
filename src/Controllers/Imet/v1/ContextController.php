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

namespace ImetCore\Controllers\Imet\v1;

final class ContextController extends Controller
{
    protected static ?string $form_view_prefix = 'imet-core::v1.context';

    protected static ?string $form_default_step = 'general_info';

    private static $total_budget = 0;

    private static $financial_available_resources_totals = 0;

    public static function get_records_total_budget()
    {
        return self::$total_budget;
    }

    public static function set_records_total_budget($value): void
    {
        self::$total_budget = $value;
    }

    public static function get_financial_available_resources_totals()
    {
        return self::$financial_available_resources_totals;
    }

    public static function set_financial_available_resources_totals($value): void
    {
        self::$financial_available_resources_totals = $value;
    }
}
