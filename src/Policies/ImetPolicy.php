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

use Illuminate\Auth\Access\HandlesAuthorization;
use ImetCore\Models\User\Role;

class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     */
    public function before($user, string $ability): ?bool
    {
        // authorize any route to ADMINISTRATOR
        if (Role::isAdmin($user)) {
            return true;
        }

        return null;
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
        if (is_null($form)) {
            return Role::hasAnyRole($user);
        }

        return Role::isWdpaAllowed($form->wdpa_id, $user);
    }

    /**
     * Determine whether the user can EDIT
     */
    public function edit($user, $form = null): bool
    {
        if (is_null($form)) {
            return Role::isRole(Role::ROLE_ENCODER);
        }

        return Role::isRole(Role::ROLE_ENCODER)
            && Role::isWdpaAllowed($form->wdpa_id, $user);
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
     * Determine whether the user can view the EXPORT button
     */
    public function export_button($user, $form = null): bool
    {
        // if user can VIEW can also export
        return $this->view($user, $form);
    }

    /**
     * Determine whether the user can EXPORT
     */
    public function export($user, $form = null): bool
    {
        // if user can VIEW can also export
        return $this->view($user, $form);
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
     * Determine whether the user can view wdpa_scaling_up
     */
    public function wdpa_scaling_up($user, $form = null): bool
    {
        return true;
    }
}
