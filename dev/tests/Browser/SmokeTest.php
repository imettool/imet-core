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
use ImetCore\Models\Imet\Imet;
use ImetCore\Models\User\User;

uses(RefreshDatabase::class);

// Seed the database before each test
// Note: apparently it is not possible to seed the database in beforeAll
beforeEach(function () {
    (new UserSeeder)->run();
    (new ProtectedAreaSeeder)->run(5);
    (new SpeciesSeeder)->run(30);
    (new FormSeeder)->run(Imet::IMET_V2, 1);
});


it('does not smoke', function (){

    $user = User::query()->where('id', 0)->first();
    $this->actingAs($user);

    $routes = [
        '/',
        '/imet',
    ];

    foreach ($routes as $route) {
        $response = visit($route);
        $response->assertNoJavaScriptErrors();
    }

});
