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

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use ImetCore\Helpers\Database;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Locale;
use ModularForms\Models\Utils\ProtectedArea as BaseProtectedArea;

/**
 * Class ProtectedArea
 *
 * @property string $global_id
 * @property string $country
 * @property int $wdpa_id
 * @property string $name
 * @property string $iucn_category
 * @property string $creation_date
 * @property numeric $area
 */
class ProtectedArea extends BaseProtectedArea
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'protected_areas';

    public $primaryKey = 'global_id';

    public const CREATED_AT = null;

    public const UPDATED_AT = null;

    public const UPDATED_BY = null;

    public const CREATED_BY = null;

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, parent::getTable());
    }

    /**
     * Get by global_id
     */
    public static function getByGlobalId($global_id): ?ProtectedArea
    {
        return static::query()->where('global_id', '=', $global_id)
            ->first();
    }

    /**
     * Parse for over-national WDPAs
     */
    public static function parseISOs(array $countries): array
    {
        $parsed_isos = [];
        foreach ($countries as $iso) {
            if (Str::contains($iso, ';')) {
                foreach (explode(';', (string)$iso) as $i) {
                    $parsed_isos[] = $i;
                }
            } else {
                $parsed_isos[] = $iso;
            }
        }

        $parsed_isos = array_unique($parsed_isos);

        return array_values($parsed_isos);
    }

    /**
     * Get protected areas' countries ISO
     */
    public static function getCountriesISO(?Closure $custom_where = null): array
    {
        $iso3s = [];

        ProtectedArea::query()->select('country')
            ->distinct()
            ->where(function ($query) use ($custom_where): void {
                if ($custom_where instanceof Closure) {
                    $custom_where($query);
                }
            })
            ->get()
            ->pluck('country')
            ->sort()
            ->each(function ($iso) use (&$iso3s): void {
                $iso3s = array_merge($iso3s, explode(';', $iso));
            });

        return $iso3s;
    }

    /**
     * Get protected areas' countries
     */
    public static function getCountries(bool $only_allowed = true): Collection
    {
        $countries = $only_allowed
            ? Role::allowedCountries()
            : static::getCountriesISO();

        return Country::query()->select(['iso3', 'iso2', 'name_' . Locale::lower()])
            ->where(function ($query) use ($countries): void {
                if ($countries !== null) {
                    $query->whereIn('iso3', array_values($countries));
                }
            })
            ->get();
    }

    /**
     * Search by key or country
     */
    public static function searchByKeyOrCountry(?string $search_key = null, ?string $country = null): Collection
    {
        // Retrieve allowed WDPAs
        $allowed_wdpas = Role::allowedWdpas();

        // Retrieve Protected Areas (according to filters AND allowed)
        $protected_areas = static::query()
            ->where(function (Builder $query) use ($search_key, $country): void {
                $query = $query->like($search_key);
                if ($country != null) {
                    $query->orWhere('country', 'LIKE', '%' . $country . '%');  // use LIKE for over-national WDPAs
                }
            })
            ->where(function (Builder $query) use ($allowed_wdpas): void {
                if ($allowed_wdpas !== null) {
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }
            })
            ->orderBy('name')
            ->get();

        // Retrieve ISOs from the Protected Areas collection
        $protected_areas_countries = static::parseISOs(
            $protected_areas->pluck('country')->unique()->toArray()
        );

        // Retrieve country names
        $countries = Country::query()->select(['iso3', 'name_' . Locale::lower()])
            ->whereIn('iso3', $protected_areas_countries)
            ->pluck('name_' . Locale::lower(), 'iso3')
            ->sort()
            ->toArray();

        return $protected_areas
            ->map(function (ProtectedArea $item) use ($countries): ProtectedArea {
                foreach (static::parseISOs([$item->country]) as $iso) {
                    $item['country_name'] .= $countries[$iso] . ', ';
                }

                $item['country_name'] = rtrim((string)$item['country_name'], ', ');

                return $item;
            });
    }
}
