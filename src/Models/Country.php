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

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ImetCore\Helpers\Database;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Locale;
use ModularForms\Models\Utils\Country as BaseCountry;
use Override;

/**
 * Class Country
 *
 * @property int $iso2
 * @property int $iso3
 * @property string $name
 * @property string $Name
 */
class Country extends BaseCountry
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'countries';

    public $primaryKey = 'iso3';

    public static ?string $foreign_key = 'region_id';

    /**
     * Override: get the table name with schema
     */
    #[Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, parent::getTable());
    }

    /**
     * Get the region associated with the country.
     *
     * @return BelongsTo<Region, Country>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get country by regions
     *
     * @throws Exception
     */
    public static function getByRegion(string $region): array
    {
        if (strlen($region) === 2) {
            return static::query()->where('region_id', $region)->pluck('iso3')->toArray();
        }

        throw new Exception('Wrong size for region: '.$region);
    }

    /**
     * Override: get only allowed countries
     */
    #[Override]
    public static function selectionList(string $type = 'PAIRS', ?Collection $collection = null, array $fields = []): array
    {
        $allowed_countries = Role::allowedCountries();
        $collection = static::query()->select(['iso3', 'name_'.Locale::lower()])
            ->where(function ($query) use ($allowed_countries): void {
                if ($allowed_countries !== null) {
                    $query->whereIn('iso3', array_values($allowed_countries));
                }
            })
            ->get();

        return parent::selectionList('FIELDS', $collection);
    }
}
