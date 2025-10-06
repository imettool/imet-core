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
use Illuminate\Support\Facades\Auth;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     */
    public function before($user, string $ability)
    {
        // authorize any route to ADMINISTRATOR
        if (Role::isAdmin($user)) {
            return true;
        }
    }


    /**
     * Determine whether the user can INDEX
     * Every role can access the index route but the list will be filtered accordingly
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can VIEW
     */
    public function view($user, $form = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can EDIT
     */
    public function edit($user, $form = null): bool
    {
       return true;
    }

    /**
     * Determine whether the user can UPDATE
     */
    public function update($user, $form = null): bool
    {
        // if user can EDIT can also UPDATE
        return $this->edit($user, $form);
    }

    /**
     * Determine whether the user can CREATE
     */
    public function create($user): bool
    {
        // if user can EDIT can also CREATE
        return $this->edit($user);
    }

    /**
     * Determine whether the user can DESTROY
     */
    public function destroy($user, $form = null): bool
    {
        // if user can EDIT can also DESTROY
        return $this->edit($user, $form);
    }

   /**
     * Determine whether the user can EXPORT
     */
    public function export($user, $form = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can export ALL the assessments
     */
    public function exportAll($user, $form = null): bool
    {
        // only ADMIN can export in batch
        return false;
    }

    /**
     * Determine whether the user can view wdpa_assessment
     */
    public function wdpa_assessment($user, $form = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view wdpa_scaling_up
     */
    public function wdpa_scaling_up($user, $form = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user is a national authority or an observatory
     */
    public function scaling_up(): bool{
        return true;
    }
}
