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

namespace ImetCore\Models\User;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ImetCore\Models\Country;
use ModularForms\Models\User\User as BaseUser;

/**
 * Class User
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $organisation
 * @property string $function
 * @property string $imet_role
 */
class User extends BaseUser
{
    /**
     * Override: set the fillable attributes
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'first_name',
        'last_name',
        'organisation',
        'function',
        'country',
        'imet_role',
    ];

    protected $appends = ['name'];

    /**
     * Relation to Role
     */
    public function imet_roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Relation to Country
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'iso3', 'country');
    }

    /**
     * Get the user's full name.
     */
    public function getNameAttribute(): string
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    /**
     * Override: Retrieve the name of the user
     */
    #[\Override]
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Retrieve user's personal info (requires to be overridden)
     */
    #[\Override]
    public function getInfo(): array
    {
        return $this->only([
            'first_name',
            'last_name',
            'organisation',
            'country',
        ]);
    }

    /**
     * Search by key
     *
     * @return mixed
     */
    public static function searchByKey(string $search_key)
    {
        return static::query()->where('first_name', '~~*', '%'.$search_key.'%')
            ->orWhere('last_name', '~~*', '%'.$search_key.'%')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->with('country')
            ->get();
    }
}
