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

namespace ImetCore\Policies;

use ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;


class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     *
     * @param \App\Models\User\User|\ImetUser $user
     * @param string $ability
     * @return void|bool
     */
    public function before($user, string $ability)
    {
        // authorize any route to ADMINISTRATOR
        if (Role::isAdmin($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can manage Roles
     *
     * @param \App\Models\User\User|\ImetUser $user
     * @return bool
     */
    public function manage($user): bool
    {
        // TODO: ROLE_REGIONAL_OBSERVATORY ?
        return false;
    }

}
