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

use ImetCore\Helpers\ImetEnv;
use ImetCore\Models\User\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DevUsersController extends __Controller {

    /**
     * Create DEV users (in dev env)
     */
    public function create_dev_users(): RedirectResponse
    {
        if(ImetEnv::isImetGlobalDevEnv()){

            $userClass = (config('imet-core.user'))::class;

            // ######  Logout  ######
            Auth::logout();

            DB::beginTransaction();

            // ######  Destroy DEV users if already exists  ######
            $userClass::destroy(99999);
            $userClass::destroy(99998);
            $userClass::destroy(99997);
            $userClass::destroy(99996);
            $userClass::destroy(99995);
            $userClass::destroy(99994);
            $userClass::destroy(99993);

            // ######  Create new DEV users (one for each ROLE type)  ######

            // Administrator
            $userClass::create([
                'id' => 99999,
                'first_name' =>  'TestUser',
                'last_name' => 'Administrator',
                'country' => 'ITA',
                'organisation' => 'IMET dev team',
                'imet_role' => Role::ROLE_ADMINISTRATOR
            ]);

            // National Authority
            $user = $userClass::create([
                'id' => 99998,
                'first_name' =>  'TestUser',
                'last_name' => 'National Authority',
                'country' => 'GRL',
                'organisation' => 'IMET national authorities',
                'imet_role' => Role::ROLE_NATIONAL_AUTHORITY
            ]);
            $user->imet_roles()->create(['country' => 'CMR']);
            $user->imet_roles()->create(['wdpa' => '61707']);

            // Regional Authority
            $user = $userClass::create([
                'id' => 99997,
                'first_name' =>  'TestUser',
                'last_name' => 'Regional Authority',
                'country' => 'GRL',
                'organisation' => 'IMET national authorities',
                'imet_role' => Role::ROLE_REGIONAL_AUTHORITY
            ]);
            $user->imet_roles()->create(['country' => 'CMR']);
            $user->imet_roles()->create(['country' => 'GAB']);
            $user->imet_roles()->create(['country' => 'COD']);
            $user->imet_roles()->create(['country' => 'COG']);

            // Observatory
            $user = $userClass::create([
                 'id' => 99996,
                 'first_name' =>  'TestUser',
                 'last_name' => 'Observatory',
                 'imet_role' => Role::ROLE_REGIONAL_OBSERVATORY
             ]);
            $user->imet_roles()->create(['country' => 'BDI']);

            // International institution
            $user = $userClass::create([
                 'id' => 99995,
                 'first_name' =>  'TestUser',
                 'last_name' => 'International institution',
                 'imet_role' => Role::ROLE_INTERNATIONAL_INSTITUTIION
             ]);
            $user->imet_roles()->create(['country' => 'BDI']);
            $user->imet_roles()->create(['country' => 'GAB']);

            // Donor
            $user = $userClass::create([
                 'id' => 99994,
                 'first_name' =>  'TestUser',
                 'last_name' => 'Donor',
                 'imet_role' => Role::ROLE_DONOR
             ]);
            $user->imet_roles()->create(['country' => 'GAB']);

            // Encoder
            $user = $userClass::create([
                'id' => 99993,
                'first_name' =>  'TestUser',
                'last_name' => 'Encoder',
                'country' => 'ATA',
                'organisation' => 'IMET encoders',
                'imet_role' => Role::ROLE_ENCODER
            ]);
            $user->imet_roles()->create(['country' => 'BDI']);
            $user->imet_roles()->create(['wdpa' => '20166']);
            $user->imet_roles()->create(['wdpa' => '30674']);
            $user->imet_roles()->create(['wdpa' => '555547988']);

            DB::commit();

            // ######  Login as Administrator  ######
            Auth::loginUsingId(99999);

            return redirect()->route('dashboard');
        }
        abort(404);
    }

    /**
     * Route to change user (in dev env)
     */
    public function change_user(Request $request): RedirectResponse
    {
        // Create test users
        if(ImetEnv::isImetGlobalDevEnv()){

            $role = $request->input('imet_role');
            Auth::logout();

            if($role == Role::ROLE_ADMINISTRATOR){
                Auth::loginUsingId(99999);
            } else if($role == Role::ROLE_NATIONAL_AUTHORITY){
                Auth::loginUsingId(99998);
            } else if($role == Role::ROLE_REGIONAL_AUTHORITY){
                Auth::loginUsingId(99997);
            } else if($role == Role::ROLE_REGIONAL_OBSERVATORY){
                Auth::loginUsingId(99996);
            } else if($role == Role::ROLE_INTERNATIONAL_INSTITUTIION){
                Auth::loginUsingId(99995);
            } else if($role == Role::ROLE_DONOR){
                Auth::loginUsingId(99994);
            } else if($role == Role::ROLE_ENCODER){
                Auth::loginUsingId(99993);
            } else {
                abort(505);
            }

            return redirect()->route('dashboard');

        } else {
            abort(404);
        }
    }


}
