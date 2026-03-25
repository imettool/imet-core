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

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ImetCore\Helpers\Seeders\FormSeeder;
use ImetCore\Helpers\Seeders\ProtectedAreaSeeder;
use ImetCore\Helpers\Seeders\SpeciesSeeder;
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

        $form = Imet\ImetV1\Imet::query()->first();
        $scores = AssessmentsScores::scores(item: $form, refresh_cache: true);

        expect($scores)
            ->toBeArray()
            ->and($scores['version'])->toBe(Imet\Imet::IMET_V1)
            ->and($scores['wdpa_id'])->toBe($form->wdpa_id)
            ->and($scores['scores'])->toBeArray()
            ->and($scores['scores']['context'])->toBeArray()
            ->and($scores['scores']['global'])->toBeArray();
    });

    it('gets IMET v2 scores', function () {

        (new FormSeeder)->run(Imet\Imet::IMET_V2, 1);

        $form = Imet\ImetV2\Imet::query()->first();
        $scores = AssessmentsScores::scores(item: $form, refresh_cache: true);

        expect($scores)
            ->toBeArray()
            ->and($scores['version'])->toBe(Imet\Imet::IMET_V2)
            ->and($scores['wdpa_id'])->toBe($form->wdpa_id)
            ->and($scores['scores'])->toBeArray()
            ->and($scores['scores']['context'])->toBeArray()
            ->and($scores['scores']['global'])->toBeArray();
    });

    it('gets IMET OECM scores', function () {

        (new FormSeeder)->run(Imet\Imet::IMET_OECM, 1);

        $form = Imet\ImetOecm\Imet::query()->first();
        $scores = AssessmentsScores::scores_oecm(item: $form, refresh_cache: true);

        expect($scores)
            ->toBeArray()
            ->and($scores['version'])->toBe(Imet\Imet::IMET_OECM)
            ->and($scores['wdpa_id'])->toBe($form->wdpa_id)
            ->and($scores['scores'])->toBeArray()
            ->and($scores['scores']['context'])->toBeArray()
            ->and($scores['scores']['global'])->toBeArray();
    });

});
