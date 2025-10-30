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
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;
use ImetCore\Models\User\Role;

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
class ProtectedArea extends BaseModel
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'protected_areas';

    public $primaryKey = 'global_id';

    public $incrementing = false;       // required for textual primary_key

    public $timestamps = false;

    /**
     * Scope a query by search key
     *
     * @phpstan-param Builder<$this> $query
     */
    #[Scope]
    protected function like(Builder $query, ?string $searchKey = null): void
    {
        if($searchKey !== null && $searchKey !== ''){

            if (is_numeric($searchKey)) {
                $query->where('wdpa_id', $searchKey);

            } else {

                $like_operator = $this->getConnection()->getDriverName() == 'sqlite'
                    ? 'LIKE'
                    : '~~*'; // PostgreSQL case insensitive

                $query->where('name', $like_operator, '%'.$searchKey.'%');
            }
        }
    }

    /**
     * Get by WDPA id
     */
    public static function getByWdpa(string $wdpa): static
    {
        return static::query()
            ->where('wdpa_id', $wdpa)
            ->firstOrFail();
    }

    /**
     * Get by global_id
     */
    public static function getByGlobalId($global_id): ?ProtectedArea
    {
        return static::query()
            ->where('global_id', '=', $global_id)
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
                foreach (explode(';', (string) $iso) as $i) {
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

        ProtectedArea::query()
            ->select('country')
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

        return Country::query()
            ->select(['iso3', 'iso2', Country::labelKey()])
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
        $protected_areas = self::query()
            ->like($search_key)
            ->where(function (Builder $query) use ($country): void {
                if ($country != null) {
                    $query->orWhere('country', 'LIKE', '%'.$country.'%');  // use LIKE for over-national WDPAs
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
        $countries = Country::query()
            ->select(['iso3', Country::labelKey()])
            ->whereIn('iso3', $protected_areas_countries)
            ->pluck(Country::labelKey(), 'iso3')
            ->sort()
            ->toArray();

        return $protected_areas
            ->map(function (ProtectedArea $item) use ($countries): ProtectedArea {
                foreach (static::parseISOs([$item->country]) as $iso) {
                    $item['country_name'] .= $countries[$iso].', ';
                }

                $item['country_name'] = rtrim((string) $item['country_name'], ', ');

                return $item;
            });
    }

    /**
     * Get selection list
     */
    public static function selectionList(): array
    {
        $label_attribute = 'name';
        $key_attribute = (new self)->getKeyName();

        return static::query()
            ->get()
            ->sortBy($label_attribute, SORT_NATURAL | SORT_FLAG_CASE)
            ->pluck($label_attribute, $key_attribute)
            ->toArray();
    }
}
