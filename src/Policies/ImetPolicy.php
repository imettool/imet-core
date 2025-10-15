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
use Illuminate\Support\Facades\Auth;
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
        $user = $user ?? Auth::user();
        if (Role::isRole(Role::ROLE_ENCODER, $user)) {
            return true;
        }
        if (Role::isRole(Role::ROLE_NATIONAL_AUTHORITY, $user)) {
            return true;
        }

        return Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY, $user);
    }

    /**
     * Determine whether the user can EXPORT
     */
    public function export($user, $form = null): bool
    {
        $user = $user ?? Auth::user();

        return Role::isWdpaAllowed($form->wdpa_id, $user) && (
            Role::isRole(Role::ROLE_ENCODER, $user) ||
            Role::isRole(Role::ROLE_NATIONAL_AUTHORITY, $user) ||
            Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY, $user)
        );
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
     * Determine whether the user can view api_assessment
     */
    public function api_assessment($user, $form = null): bool
    {
        return $this->role_national_or_observatory() &&
            Role::isWdpaAllowed($form->wdpa_id, $user);
    }

    /**
     * Determine whether the user can view api_scaling_up
     */
    public function api_scaling_up($user, $form = null): bool
    {
        return $this->role_national_or_observatory() && Role::isWdpaAllowed($form->wdpa_id, $user);
    }

    /**
     * Determine whether the user is a national authority or an observatory
     */
    public function scaling_up(): bool
    {
        return $this->role_national_or_observatory();
    }

    public function role_national_or_observatory(): bool
    {
        if (Role::isRole(Role::ROLE_NATIONAL_AUTHORITY)) {
            return true;
        }

        return Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY);
    }

    /**
     * Determine whether the user can view api_details
     */
    public function api_details($user, $form = null, $model = null): bool
    {
        return Role::hasRequiredAccessLevel($model) &&
            Role::isWdpaAllowed($form->wdpa_id, $user);
    }
}
