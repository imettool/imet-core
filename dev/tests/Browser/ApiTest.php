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

// Migrate the database
uses(RefreshDatabase::class);

// Seed the database before each test
beforeEach(function () {
    (new UserSeeder)->run();
    (new ProtectedAreaSeeder)->run(1);
    (new SpeciesSeeder)->run(1);
});

describe('Score APIs', function () {

    it( 'hits IMET v1 scores', function () {
        (new FormSeeder)->run(Imet\Imet::IMET_V1, 1);

        $form = Imet\v1\Imet::query()->first();
        $response = $this->getJson(route('imet_core::api::scores', ['item' => $form]));

        expect($response)->isSuccessful()
            ->and($response->json('version'))->toBe(Imet\Imet::IMET_V1)
            ->and($response->json('wdpa_id'))->toBe($form->wdpa_id)
            ->and($response->json('scores'))->toBeArray()
            ->and($response->json('scores.context'))->toBeArray()
            ->and($response->json('scores.global'))->toBeArray();
    });

    it( 'hits IMET v2 scores', function () {
        (new FormSeeder)->run(Imet\Imet::IMET_V2, 1);

        $form = Imet\v2\Imet::query()->first();
        $response = $this->getJson(route('imet_core::api::scores', ['item' => $form]));

        expect($response)->isSuccessful()
            ->and($response->json('version'))->toBe(Imet\Imet::IMET_V2)
            ->and($response->json('wdpa_id'))->toBe($form->wdpa_id)
            ->and($response->json('scores'))->toBeArray()
            ->and($response->json('scores.context'))->toBeArray()
            ->and($response->json('scores.global'))->toBeArray();
    });

    it( 'hits IMET OECM scores', function () {
        (new FormSeeder)->run(Imet\Imet::IMET_OECM, 1);

        $form = Imet\oecm\Imet::query()->first();
        $response = $this->getJson(route('imet_core::api::scores_oecm', ['item' => $form]));

        expect($response)->isSuccessful()
            ->and($response->json('version'))->toBe(Imet\Imet::IMET_OECM)
            ->and($response->json('wdpa_id'))->toBe($form->wdpa_id)
            ->and($response->json('scores'))->toBeArray()
            ->and($response->json('scores.context'))->toBeArray()
            ->and($response->json('scores.global'))->toBeArray();
    });

});
