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

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use ImetCore\Models\User\Role;
use ImetCore\Models\User\User as ImetUser;

class User extends ImetUser
{
    use HasFactory;

    /** @phpstan-var array<string, string> $rules */
    public static array $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'organisation' => 'required|string|max:255',
        'function' => 'required|string|max:255',
        'country' => 'required|string|max:3',
    ];

    /**
     * @phpstan-param array<string, string> $attributes
     *
     * @phpstan-return ?User
     */
    public function update_offline(array $attributes): ?User
    {
        $item = User::query()->find($attributes['id']);

        if ($item !== null) {
            $item->fill($attributes);
            if ($item->imet_role == null) {
                $item->imet_role = Role::ROLE_ADMINISTRATOR;
            }

            if ($item->isDirty()) {
                $item->touch();
                $item->save();
            }
        }

        return $item;
    }

    /**
     * @param  array<string, string>  $attributes
     * @return array<string, array<int, string>>
     */
    public function validate(array $attributes): array
    {
        $validator = Validator::make($attributes, static::$rules);

        return $validator->fails()
            ? $validator->errors()->messages()
            : [];
    }
}
