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
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Locale;

/**
 * Class Country
 *
 * @property int $iso2
 * @property int $iso3
 * @property string $name
 */
class Country extends BaseModel
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'countries';

    public $primaryKey = 'iso3';

    public $incrementing = false;

    public static ?string $foreign_key = 'region_id';

    protected $appends = ['name'];

    /**
     * Get the key for the "name" field in the current locale
     */
    public static function labelKey(): string
    {
        return 'name_'.Locale::lower();
    }

    /**
     * Get the country's name attribute according to the current locale
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (): mixed => $this->attributes[static::labelKey()],
        );
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
     * Get country by iso
     *
     * @throws Exception
     */
    public static function getByISO(string $iso): ?Country
    {
        if (strlen($iso) === 2) {
            return static::query()->where('iso2', $iso)->first();
        }

        if (strlen($iso) === 3) {
            return static::query()->where('iso3', $iso)->first();
        }

        throw new Exception('Wrong size for iso: '.$iso);
    }

    /**
     * Get only allowed countries
     */
    public static function selectionList(): array
    {
        $label_attribute = static::labelKey();
        $key_attribute = 'iso3';
        $allowed_countries = Role::allowedCountries();

        return static::query()
            ->select([$label_attribute, $key_attribute])
            ->where(function ($query) use ($allowed_countries): void {
                if ($allowed_countries !== null) {
                    $query->whereIn('iso3', array_values($allowed_countries));
                }
            })
            ->get()
            ->sortBy($label_attribute, SORT_NATURAL | SORT_FLAG_CASE)
            ->pluck($label_attribute, $key_attribute)
            ->toArray();
    }
}
