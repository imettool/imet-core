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

use Database\Seeders\FormSeeder;
use Database\Seeders\ProtectedAreaSeeder;
use Database\Seeders\SpeciesSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ImetCore\Models\Imet;
use ImetCore\Models\User\User;

/**
 * Get all form related routes
 * @param string[] $steps_context
 * @param string[] $steps_eval
 * @return string[]
 */
function getAllRoutes(string $version, array $steps_context, array $steps_eval): array
{
    // Basic routes
    $routes = [
        "/imet",
        "/imet/{$version}",
        "/imet/{$version}/create/",
        "/imet/{$version}/create_non_wdpa/",
    ];

    // Add edit/view routes for each form
    foreach (['edit', 'show'] as $mode){
        $routes[] = "/imet/{$version}/context/{form-id}/{$mode}";
        $routes[] = "/imet/{$version}/evaluation/{form-id}/{$mode}";
        $routes[] = "/imet/{$version}/report/{form-id}/{$mode}";
        foreach ($steps_context as $step) {
            $routes[] = "/imet/{$version}/context/{form-id}/{$mode}/{$step}";
        }
        foreach ($steps_eval as $step) {
            $routes[] = "/imet/{$version}/evaluation/{form-id}/{$mode}/{$step}";
        }
    }

    return $routes;
}

// Use RefreshDatabase to migrate the database
uses(RefreshDatabase::class);

// Seed the database before each test
// Note: apparently it is not possible to seed the database in beforeAll
beforeEach(function () {
    (new UserSeeder)->run();
    (new ProtectedAreaSeeder)->run(5);
    (new SpeciesSeeder)->run(30);
});

describe('Browse IMET v1', function () {

    // Seed some IMETv1 forms
    beforeEach(
        /**
         * @throws Exception
         */
        function(){
        (new FormSeeder)->run(Imet\Imet::IMET_V1, 1);
    });

    $routes = getAllRoutes(
        version: Imet\Imet::IMET_V1,
        steps_context: array_keys(Imet\v1\Imet::$modules),
        steps_eval: array_keys(Imet\v1\Imet_Eval::$modules)
    );

    foreach ($routes as $route) {
        it("does not smoke on route {$route}", function () use ($route) {

            // Authenticate as admin user
            $this->actingAs(User::query()->find(0));

            // Retrieve seeded forms
            $forms = Imet\v1\Imet::all()->pluck('FormID')->toArray();

            foreach ($forms as $formID){

                // Visit the route and assert no smoke (no javascript errors and no console logs)
                $route = \Illuminate\Support\Str::replace('{form-id}', $formID, $route);
                $response = visit( $route);
                $response->assertNoSmoke();
            }

        });
    }

});

describe('Browse IMET v2', function () {

    // Seed some IMETv2 forms
    beforeEach(
        /**
         * @throws Exception
         */
        function(){
        (new FormSeeder)->run(Imet\Imet::IMET_V2, 1);
    });

    $routes = getAllRoutes(
        version: Imet\Imet::IMET_V2,
        steps_context: array_keys(Imet\v2\Imet::$modules),
        steps_eval: array_keys(Imet\v2\Imet_Eval::$modules)
    );

    foreach ($routes as $route) {
        it("does not smoke on route {$route}", function () use ($route) {

            // Authenticate as admin user
            $this->actingAs(User::query()->find(0));

            // Retrieve seeded forms
            $forms = Imet\v2\Imet::all()->pluck('FormID')->toArray();

            foreach ($forms as $formID){

                // Visit the route and assert no smoke (no javascript errors and no console logs)
                $route = \Illuminate\Support\Str::replace('{form-id}', $formID, $route);
                $response = visit( $route);
                $response->assertNoSmoke();
            }

        });
    }

});

describe('Browse OECM', function () {

    // Seed some OECM forms
    beforeEach(
        /**
         * @throws Exception
         */
        function(){
        (new FormSeeder)->run(Imet\Imet::IMET_OECM, 1);
    });

    $routes = getAllRoutes(
        version: Imet\Imet::IMET_OECM,
        steps_context: array_keys(Imet\oecm\Imet::$modules),
        steps_eval: array_keys(Imet\oecm\Imet_Eval::$modules)
    );

    foreach ($routes as $route) {
        it("does not smoke on route {$route}", function () use ($route) {

            // Authenticate as admin user
            $this->actingAs(User::query()->find(0));

            // Retrieve seeded forms
            $forms = Imet\oecm\Imet::all()->pluck('FormID')->toArray();

            foreach ($forms as $formID){

                // Visit the route and assert no smoke (no javascript errors and no console logs)
                $route = \Illuminate\Support\Str::replace('{form-id}', $formID, $route);
                $response = visit( $route);
                $response->assertNoSmoke();
            }

        });
    }

});
