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

namespace ImetCore\Models;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;
use ModularForms\Helpers\Locale;

/**
 * Class Currency
 *
 * @property string $iso
 * @property string $name_fr
 * @property string $name_en
 * @property string $name_sp
 */
class Currency extends BaseModel
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'currencies';

    protected $primaryKey = 'iso';

    public $incrementing = false;

    public const array MINIMAL_CURRENCIES = ['EUR', 'USD'];

    /**
     * Exchange rates
     */
    protected const float USD_EUR = 0.89;

    protected const float GBP_EUR = 1.11;

    protected const float CNY_EUR = 0.13;

    protected const float JPY_EUR = 0.0082;

    protected const float XAF_EUR = 0.0015;

    protected const float CFA_EUR = 0.0015;

    protected const float STD_EUR = 0.0000411945;

    protected const float BIF_EUR = 0.00048;

    protected const float CDF_EUR = 0.00054;

    protected const float RWF_EUR = 0.00097;

    /**
     * Get the key for the "name" field in the current locale
     */
    public static function labelKey(): string
    {
        return 'name_'.Locale::lower();
    }

    /**
     * Override: get locale of IMET form
     */
    public static function selectionList(): array
    {
        $label_attribute = self::labelKey();
        $key_attribute = 'iso';

        return static::query()
            ->get()
            ->sortBy($label_attribute, SORT_NATURAL | SORT_FLAG_CASE)
            ->pluck($label_attribute, $key_attribute)
            ->toArray();
    }

    /**
     * Exchange between 2 given currency
     */
    public static function exchange(float|int $amount, string $in_currency, string $out_currency): float
    {
        $in_currency = strtoupper($in_currency);
        $out_currency = strtoupper($out_currency);
        if ($in_currency !== '' && $out_currency !== '' && $in_currency !== $out_currency) {
            if ($in_currency !== 'EUR') {
                // first convert to EUR
                $amount *= constant('static::'.$in_currency.'_EUR');
                // then convert to target currency
                if ($out_currency !== 'EUR') {
                    $amount /= constant('static::'.$out_currency.'_EUR');
                }
            } else {
                $amount /= constant('static::'.$out_currency.'_EUR');
            }
        }

        return (float) $amount;
    }
}
