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
use Illuminate\Http\JsonResponse;
use ImetCore\Models\Imet;
use ImetCore\Services\Scores\AssessmentsScores;

// Migrate the database
uses(RefreshDatabase::class);

// Seed the database before each test
beforeEach(function () {
    (new UserSeeder)->run();
    (new ProtectedAreaSeeder)->run(1);
    (new SpeciesSeeder)->run(1);
});

describe('Score services', function () {

    it('gets IMET v1 scores', function () {

        (new FormSeeder)->run(Imet\Imet::IMET_V1, 1);

        $form = Imet\v1\Imet::query()->first();
        $response = AssessmentsScores::scores(item: $form, responseTypeJson: true, refresh_cache: true);

        expect($response)
            ->toBeInstanceOf(JsonResponse::class);

        $response_data = $response->getData(true);

        expect($response_data)
            ->toBeArray()
            ->and($response_data['version'])->toBe(Imet\Imet::IMET_V1)
            ->and($response_data['wdpa_id'])->toBe($form->wdpa_id)
            ->and($response_data['scores'])->toBeArray()
            ->and($response_data['scores']['context'])->toBeArray()
            ->and($response_data['scores']['global'])->toBeArray();
    });

    it('gets IMET v2 scores', function () {

        (new FormSeeder)->run(Imet\Imet::IMET_V2, 1);

        $form = Imet\v2\Imet::query()->first();
        $response = AssessmentsScores::scores(item: $form, responseTypeJson: true, refresh_cache: true);

        expect($response)
            ->toBeInstanceOf(JsonResponse::class);

        $response_data = $response->getData(true);

        expect($response_data)
            ->toBeArray()
            ->and($response_data['version'])->toBe(Imet\Imet::IMET_V2)
            ->and($response_data['wdpa_id'])->toBe($form->wdpa_id)
            ->and($response_data['scores'])->toBeArray()
            ->and($response_data['scores']['context'])->toBeArray()
            ->and($response_data['scores']['global'])->toBeArray();
    });

    it('gets IMET OECM scores', function () {

        (new FormSeeder)->run(Imet\Imet::IMET_OECM, 1);

        $form = Imet\oecm\Imet::query()->first();
        $response = AssessmentsScores::scores_oecm(item: $form, responseTypeJson: true, refresh_cache: true);

        expect($response)
            ->toBeInstanceOf(JsonResponse::class);

        $response_data = $response->getData(true);

        expect($response_data)
            ->toBeArray()
            ->and($response_data['version'])->toBe(Imet\Imet::IMET_OECM)
            ->and($response_data['wdpa_id'])->toBe($form->wdpa_id)
            ->and($response_data['scores'])->toBeArray()
            ->and($response_data['scores']['context'])->toBeArray()
            ->and($response_data['scores']['global'])->toBeArray();
    });

});
