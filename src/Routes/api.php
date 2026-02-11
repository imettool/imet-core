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

use Illuminate\Support\Facades\Route;
use ImetCore\Controllers\Imet\Controller;
use ImetCore\Controllers\Imet\v2\ScoresController as ScoresControllerV2;
use ImetCore\Controllers\Imet\oecm\ScoresController as ScoresControllerOecm;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api'], function (): void {
    Route::group(['prefix' => 'imet'], function (): void {
        Route::match(['get', 'post'], '/', [Controller::class, 'pame']);
        Route::get('scores/{item}', ScoresControllerV2::class)->name('imet_core::api::scores');
        Route::get('scores_oecm/{item}', ScoresControllerOecm::class)->name('imet_core::api::scores_oecm');
    });
});
