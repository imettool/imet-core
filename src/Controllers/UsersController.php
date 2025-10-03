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

namespace ImetCore\Controllers;

use ModularForms\Models\Traits\Payload;
use ImetCore\Models\User\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsersController extends __Controller
{
    protected static ?string $form_class = Role::class;
    protected static ?string $form_view_prefix = 'imet-core::users';

    /**
     * @param Request $request
     * @param $role_type
     * @return Application|View|Factory
     */
    public function list_by_role(Request $request, $role_type = null): Application|View|Factory
    {
        $this->authorize('manage', static::$form_class);

        $role_type = $role_type ?? Role::ROLE_ADMINISTRATOR;
        $users = (config('imet-core.user'))::select(['id'])->where('imet_role', $role_type)
            ->with(['imet_roles.country_obj', 'imet_roles.wdpa_obj'])
            ->get()
            ->map(function ($item){
                $role_isos = [];
                $role_wdpas = [];
                foreach($item['imet_roles'] as $r){
                    if($r['country']!==null){
                        $role_isos[] = $r['country'];
                    }
                    if($r['wdpa']!==null){
                        $role_wdpas[] = $r['wdpa'];
                    }
                }
                unset($item['imet_roles']);
                return [
                    'user' => $item['id'],
                    'role_isos' => json_encode($role_isos),
                    'role_wdpas' => json_encode($role_wdpas),
                    'changed' => false
                ];
            });

        return view(static::$form_view_prefix . '.roles', [
            'controller' => static::class,
            'role' => $role_type,
            'users_and_roles' => $users
        ]);
    }

    /**
     * Manage "search" route
     */
    public function search(Request $request): JsonResponse
    {
        $this->authorize('manage', static::$form_class);
        $list = $request->filled('search_key')
            ? (config('imet-core.user'))::searchByKey($request->input('search_key'))
            : collect();

        return static::sendAPIResponse($list->toArray());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get_labels(Request $request): JsonResponse
    {
        $this->authorize('manage', static::$form_class);
        $pairs = [];

        if($request->filled('id')){

            $id = $request->input(['id']);
            $pairs = (config('imet-core.user'))::select(['id', 'first_name', 'last_name'])
                ->where('id', $id)
                ->get()
                ->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => [$user->getName()]
                    ];
                });
        }
        return static::sendAPIResponse($pairs);
    }

    /**
     * Manage "update_roles" route
     */
    public function update_roles(Request $request): array
    {
        $this->authorize('manage', static::$form_class);

        $records = Payload::decode($request->input('records'));
        $role_type = $request->input('role_type');

        DB::beginTransaction();

        if($role_type == Role::ROLE_ADMINISTRATOR){
            $defined_users = [];
            foreach ($records as $record){
                if($record['user']){
                    // Remove any eventual role and set user's imet_role
                    Role::query()->where('user_id', $record['user'])->delete();
                    (config('imet-core.user'))::find($record['user'])->update(['imet_role' => $role_type]);
                    $defined_users[] = $record['user'];
                }
            }
            // Set imet_role to null for any user with the given role which is not in the provided list
            if(filled($defined_users)){
                (config('imet-core.user'))::where('imet_role', $role_type)
                    ->whereNotIn('id', $defined_users)
                    ->update(['imet_role' => null]);
            }
        } else {

            foreach ($records as $record){
                if($record['user'] !== null){
                    $user_id = $record['user'];
                    $wdpas = json_decode($record['role_wdpas']) ?? [];
                    $isos = json_decode($record['role_isos']) ?? [];

                    $wdpas = array_unique(array_filter($wdpas));
                    $isos = array_unique(array_filter($isos));

                    // Create/update provided roles
                    if(filled($wdpas)){
                        foreach ($wdpas as $wdpa){
                            $attributes = [ 'user_id' => $user_id, 'wdpa' => $wdpa, 'country' => null];
                            Role::query()->updateOrCreate($attributes, $attributes);
                        }
                    }
                    if(filled($isos)){
                        foreach ($isos as $iso){
                            $attributes = [ 'user_id' => $user_id, 'wdpa' => null, 'country' => $iso ];
                            Role::query()->updateOrCreate($attributes, $attributes);
                        }
                    }
                    // Remove any extra role
                    Role::query()->where('user_id', $user_id)
                        ->whereNull('country')
                        ->whereNotNull('wdpa')
                        ->whereNotIn('wdpa', $wdpas)
                        ->delete();

                    Role::query()->where('user_id', $user_id)
                        ->whereNull('wdpa')
                        ->whereNotNull('country')
                        ->whereNotIn('country', $isos)
                        ->delete();

                }
            }
        }

        DB::commit();

        return [
            'status' => 'success'
        ];
    }

}
