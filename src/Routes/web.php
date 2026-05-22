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

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use ImetCore\Controllers\Imet;
use ImetCore\Controllers\Imet\ImetOecm;
use ImetCore\Controllers\Imet\ImetV1;
use ImetCore\Controllers\Imet\ImetV2;
use ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use ImetCore\Controllers\Imet\ScalingUpBasketController;
use ImetCore\Controllers\ProtectedAreaController;
use ImetCore\Controllers\SpeciesController;
use ImetCore\Middleware\SetLocale;

Route::middleware([SetLocale::class, 'web'])->group(function (): void {

    // Old routes: to be kept for the moment to ensure backwards compatibility
    Route::get('/{url}', fn ($url) => Redirect::to('imet/'))
        ->where(['url' => 'admin/imet|admin/imet/v1|admin/imet/v2']);
    Route::get('/{url}', fn ($url) => Redirect::to('oecm/'))
        ->where(['url' => 'admin/oecm']);

    /*
    |--------------------------------------------------------------------------
    | IMET Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'imet', 'middleware' => 'auth'], function (): void {

        // ####  common routes (v1 & v2) ####
        Route::get('import', [ImetV2\Controller::class, 'import_view'])->name(Imet\Controller::ROUTE_PREFIX.'import_view');
        Route::post('import', [ImetV2\Controller::class, 'import'])->name(Imet\Controller::ROUTE_PREFIX.'import');
        Route::post('ajax/upload', [ImetV2\Controller::class, 'upload'])->name(Imet\Controller::ROUTE_PREFIX.'upload_json');
        Route::match(['get', 'post'], '/', [ImetV2\Controller::class, 'index'])->name(Imet\Controller::ROUTE_PREFIX.'index');

        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function (): void {

            Route::match(['get', 'post'], '/', [ImetV1\Controller::class, 'index'])->name(ImetV1\Controller::ROUTE_PREFIX.'index');     // alias

            // import/export
            Route::match(['get', 'post'], 'export_view', [ImetV1\Controller::class, 'export_view'])->name(ImetV1\Controller::ROUTE_PREFIX.'export_view');
            Route::get('{item}/print', [ImetV1\Controller::class, 'print']);
            Route::get('{item}/export', [ImetV1\Controller::class, 'export']);
            Route::get('{item}/export_no_attachments', [ImetV1\Controller::class, 'export_no_attachments']);
            Route::post('export_batch', [ImetV1\Controller::class, 'export_batch'])->name(ImetV1\Controller::ROUTE_PREFIX.'export_batch');
            Route::get('import', [ImetV1\Controller::class, 'import_view'])->name(ImetV1\Controller::ROUTE_PREFIX.'import_view');    // alias
            Route::post('import', [ImetV1\Controller::class, 'import'])->name(ImetV1\Controller::ROUTE_PREFIX.'import');    // alias
            Route::post('ajax/upload', [ImetV1\Controller::class, 'upload'])->name(ImetV1\Controller::ROUTE_PREFIX.'upload_json');    // alias

            // merge
            Route::get('{item}/merge', [ImetV1\Controller::class, 'merge_view'])->name(ImetV1\Controller::ROUTE_PREFIX.'merge_view');
            Route::post('merge', [ImetV1\Controller::class, 'merge'])->name(ImetV1\Controller::ROUTE_PREFIX.'merge');

            // create/destroy
            Route::delete('{item}', [ImetV1\Controller::class, 'destroy']);

            // edit/show
            Route::group(['prefix' => 'context'], function (): void {
                Route::get('{item}/show/{step?}', [ImetV1\ContextController::class, 'show'])->name(ImetV1\Controller::ROUTE_PREFIX.'context_show');
                Route::get('{item}/edit/{step?}', [ImetV1\ContextController::class, 'edit'])->name(ImetV1\Controller::ROUTE_PREFIX.'context_edit');
                Route::patch('{item}', [ImetV1\ContextController::class, 'update']);
                Route::get('raw_export/{item}/{slug}', [ImetV1\ContextController::class, 'raw_export']);
            });
            Route::group(['prefix' => 'evaluation'], function (): void {
                Route::get('{item}/show/{step?}', [ImetV1\EvalController::class, 'show'])->name(ImetV1\Controller::ROUTE_PREFIX.'evaluation_show');
                Route::get('{item}/edit/{step?}', [ImetV1\EvalController::class, 'edit'])->name(ImetV1\Controller::ROUTE_PREFIX.'evaluation_edit');
                Route::patch('{item}', [ImetV1\EvalController::class, 'update']);
                Route::get('raw_export/{item}/{slug}', [ImetV1\EvalController::class, 'raw_export']);
            });
            Route::group(['prefix' => 'report'], function (): void {
                Route::get('{item}/edit', [ImetV1\ReportController::class, 'report'])->name(ImetV1\Controller::ROUTE_PREFIX.'report_edit');
                Route::get('{item}/show', [ImetV1\ReportController::class, 'report_show'])->name(ImetV1\Controller::ROUTE_PREFIX.'report_show');
                Route::patch('{item}', [ImetV1\ReportController::class, 'report_update'])->name(ImetV1\Controller::ROUTE_PREFIX.'report_update');
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function (): void {

            Route::match(['get', 'post'], '/', [ImetV2\Controller::class, 'index'])->name(ImetV2\Controller::ROUTE_PREFIX.'index');    // alias

            // import/export
            Route::match(['get', 'post'], 'export_view', [ImetV2\Controller::class, 'export_view'])->name(ImetV2\Controller::ROUTE_PREFIX.'export_view');
            Route::get('{item}/print', [ImetV2\Controller::class, 'print']);
            Route::get('{item}/export', [ImetV2\Controller::class, 'export']);
            Route::get('{item}/export_no_attachments', [ImetV2\Controller::class, 'export_no_attachments']);
            Route::post('export_batch', [ImetV2\Controller::class, 'export_batch'])->name(ImetV2\Controller::ROUTE_PREFIX.'export_batch');
            Route::get('import', [ImetV2\Controller::class, 'import_view'])->name(ImetV2\Controller::ROUTE_PREFIX.'import_view');    // alias
            Route::post('import', [ImetV2\Controller::class, 'import'])->name(ImetV2\Controller::ROUTE_PREFIX.'import');    // alias
            Route::post('ajax/upload', [ImetV2\Controller::class, 'upload'])->name(ImetV2\Controller::ROUTE_PREFIX.'upload_json');    // alias

            // merge
            Route::get('{item}/merge', [ImetV2\Controller::class, 'merge_view'])->name(ImetV2\Controller::ROUTE_PREFIX.'merge_view');
            Route::post('merge', [ImetV2\Controller::class, 'merge'])->name(ImetV2\Controller::ROUTE_PREFIX.'merge');

            // create/destroy
            Route::delete('{item}', [ImetV2\Controller::class, 'destroy']);
            Route::get('create', [ImetV2\Controller::class, 'create'])->name(ImetV2\Controller::ROUTE_PREFIX.'create');
            Route::get('create_non_wdpa', [ImetV2\Controller::class, 'create_non_wdpa'])->name(ImetV2\Controller::ROUTE_PREFIX.'create_non_wdpa');
            Route::post('store', [ImetV2\ContextController::class, 'store']);
            Route::post('prev_years', [ImetV2\Controller::class, 'retrieve_prev_years'])->name(ImetV2\Controller::ROUTE_PREFIX.'retrieve_prev_years');

            // edit/show
            Route::group(['prefix' => 'context'], function (): void {
                Route::get('{item}/edit/{step?}', [ImetV2\ContextController::class, 'edit'])->name(ImetV2\Controller::ROUTE_PREFIX.'context_edit');
                Route::get('{item}/show/{step?}', [ImetV2\ContextController::class, 'show'])->name(ImetV2\Controller::ROUTE_PREFIX.'context_show');
                Route::patch('{item}', [ImetV2\ContextController::class, 'update']);
                Route::get('raw_export/{item}/{slug}', [ImetV2\ContextController::class, 'raw_export']);
            });
            Route::group(['prefix' => 'evaluation'], function (): void {
                Route::get('{item}/edit/{step?}', [ImetV2\EvalController::class, 'edit'])->name(ImetV2\Controller::ROUTE_PREFIX.'evaluation_edit');
                Route::get('{item}/show/{step?}', [ImetV2\EvalController::class, 'show'])->name(ImetV2\Controller::ROUTE_PREFIX.'evaluation_show');
                Route::get('{item}/print', [ImetV2\EvalController::class, 'print']);
                Route::patch('{item}', [ImetV2\EvalController::class, 'update']);
                Route::get('raw_export/{item}/{slug}', [ImetV2\EvalController::class, 'raw_export']);
            });
            Route::group(['prefix' => 'report'], function (): void {
                Route::get('{item}/edit', [ImetV2\ReportController::class, 'edit'])->name(ImetV2\Controller::ROUTE_PREFIX.'report_edit');
                Route::get('{item}/show', [ImetV2\ReportController::class, 'show'])->name(ImetV2\Controller::ROUTE_PREFIX.'report_show');
                Route::patch('{item}', [ImetV2\ReportController::class, 'report_update'])->name(ImetV2\Controller::ROUTE_PREFIX.'report_update');
                Route::get('{item}/print', [ImetV2\ReportController::class, 'print']);
                Route::patch('{item}', [ImetV2\ReportController::class, 'update']);
                Route::get('raw_export/{item}/{slug}', [ImetV2\ReportController::class, 'raw_export']);
            });

        });

        // #### Scaling Up Analysis ####
        Route::group(['prefix' => 'scaling_up'], function (): void {

            Route::match(['get', 'post'], '/', [ScalingUpAnalysisController::class, 'index'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_index');
            Route::post('analysis', [ScalingUpAnalysisController::class, 'analysis'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_analysis');
            Route::match(['get', 'post'], '/{items}', [ScalingUpAnalysisController::class, 'data_handle'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_report');
            Route::get('download/{scaling_id}', [ScalingUpAnalysisController::class, 'download_zip_file'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_download');
            Route::get('preview/{id}', [ScalingUpAnalysisController::class, 'preview_template'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_preview');

            Route::group(['prefix' => 'basket'], function (): void {
                Route::post('add', [ScalingUpBasketController::class, 'save'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_basket_add');
                Route::post('get', [ScalingUpBasketController::class, 'retrieve'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_basket_get');
                Route::post('all', [ScalingUpBasketController::class, 'all'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_basket_all');
                Route::delete('delete/{id}', [ScalingUpBasketController::class, 'delete'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_basket_delete');
                Route::post('clear', [ScalingUpBasketController::class, 'clear'])->name(Imet\Controller::ROUTE_PREFIX.'scaling_up_basket_clear');
            });

        });

        Route::group(['prefix' => 'tools'], function (): void {
            Route::get('export_csv', [ImetV2\Controller::class, 'exportListCSV'])->name(Imet\Controller::ROUTE_PREFIX.'csv_list');
            Route::get('export_csv/{ids}/{slug}', [ImetV2\Controller::class, 'exportModuleToCsv'])->name(Imet\Controller::ROUTE_PREFIX.'csv');
        });

        // ###### Selectors ######
        Route::group(['prefix' => 'selector'], function (): void {

            Route::group(['prefix' => 'species'], function (): void {
                Route::post('search', [SpeciesController::class, 'search'])->name(Imet\Controller::ROUTE_PREFIX.'selector.species.search');
                Route::post('info', [SpeciesController::class, 'info'])->name(Imet\Controller::ROUTE_PREFIX.'selector.species.info');
            });

            Route::group(['prefix' => 'pas'], function (): void {
                Route::post('search', [ProtectedAreaController::class, 'search'])->name(Imet\Controller::ROUTE_PREFIX.'selector.pas.search');
                Route::post('labels', [ProtectedAreaController::class, 'get_labels'])->name(Imet\Controller::ROUTE_PREFIX.'selector.pas.labels');
            });

            Route::group(['prefix' => 'users'], function () {
                Route::post('search', [UsersController::class, 'search'])->name(Imet\Controller::ROUTE_PREFIX . 'selector.users.search');
                Route::post('labels', [UsersController::class, 'get_labels'])->name(Imet\Controller::ROUTE_PREFIX .'selector.users.labels');
            });
        });

    });

    /*
    |--------------------------------------------------------------------------
    | IMET OECM Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'oecm', 'middleware' => 'auth'], function (): void {

        Route::match(['get', 'post'], '/', [ImetOecm\Controller::class, 'index'])->name(ImetOecm\Controller::ROUTE_PREFIX.'index');

        Route::delete('{item}', [ImetOecm\Controller::class, 'destroy']);
        Route::get('{item}/print', [ImetOecm\Controller::class, 'print']);
        Route::get('{item}/export', [ImetOecm\Controller::class, 'export']);
        Route::get('{item}/export_no_attachments', [ImetOecm\Controller::class, 'export_no_attachments']);
        Route::match(['get', 'post'], 'export_view', [ImetOecm\Controller::class, 'export_view'])->name(ImetOecm\Controller::ROUTE_PREFIX.'export_view');
        Route::post('export_batch', [ImetOecm\Controller::class, 'export_batch'])->name(ImetOecm\Controller::ROUTE_PREFIX.'export_batch');
        Route::get('{item}/merge', [ImetOecm\Controller::class, 'merge_view'])->name(ImetOecm\Controller::ROUTE_PREFIX.'merge_view');
        Route::post('merge', [ImetOecm\Controller::class, 'merge'])->name(ImetOecm\Controller::ROUTE_PREFIX.'merge');
        Route::get('import', [ImetOecm\Controller::class, 'import_view'])->name(ImetOecm\Controller::ROUTE_PREFIX.'import_view');
        Route::post('import', [ImetOecm\Controller::class, 'import'])->name(ImetOecm\Controller::ROUTE_PREFIX.'import');
        Route::post('ajax/upload', [ImetOecm\Controller::class, 'upload'])->name(ImetOecm\Controller::ROUTE_PREFIX.'upload_json');

        Route::get('create', [ImetOecm\Controller::class, 'create'])->name(ImetOecm\Controller::ROUTE_PREFIX.'create');
        Route::get('create_non_wdpa', [ImetOecm\Controller::class, 'create_non_wdpa'])->name(ImetOecm\Controller::ROUTE_PREFIX.'create_non_wdpa');
        Route::post('store', [ImetOecm\ContextController::class, 'store']);
        Route::post('prev_years', [ImetOecm\Controller::class, 'retrieve_prev_years'])->name(ImetOecm\Controller::ROUTE_PREFIX.'retrieve_prev_years');

        Route::group(['prefix' => 'context'], function (): void {
            Route::get('{item}/edit/{step?}', [ImetOecm\ContextController::class, 'edit'])->name(ImetOecm\Controller::ROUTE_PREFIX.'context_edit');
            Route::get('{item}/show/{step?}', [ImetOecm\ContextController::class, 'show'])->name(ImetOecm\Controller::ROUTE_PREFIX.'context_show');
            Route::patch('{item}', [ImetOecm\ContextController::class, 'update']);
            Route::get('{item}/print_sa', [ImetOecm\ContextController::class, 'print_sa'])->name(ImetOecm\Controller::ROUTE_PREFIX.'print_sa');
            Route::get('raw_export/{item}/{slug}', [ImetOecm\ContextController::class, 'raw_export']);
        });
        Route::group(['prefix' => 'evaluation'], function (): void {
            Route::get('{item}/edit/{step?}', [ImetOecm\EvalController::class, 'edit'])->name(ImetOecm\Controller::ROUTE_PREFIX.'evaluation_edit');
            Route::get('{item}/show/{step?}', [ImetOecm\EvalController::class, 'show'])->name(ImetOecm\Controller::ROUTE_PREFIX.'evaluation_show');
            Route::get('{item}/print', [ImetOecm\EvalController::class, 'print']);
            Route::patch('{item}', [ImetOecm\EvalController::class, 'update']);
            Route::get('raw_export/{item}/{slug}', [ImetOecm\EvalController::class, 'raw_export']);
        });
        Route::group(['prefix' => 'report'], function (): void {
            Route::get('{item}/edit', [ImetOecm\ReportController::class, 'report'])->name(ImetOecm\Controller::ROUTE_PREFIX.'report_edit');
            Route::get('{item}/show', [ImetOecm\ReportController::class, 'report_show'])->name(ImetOecm\Controller::ROUTE_PREFIX.'report_show');
            Route::patch('{item}', [ImetOecm\ReportController::class, 'report_update'])->name(ImetOecm\Controller::ROUTE_PREFIX.'report_update');
            Route::get('objectives/{form_id}', [ImetOecm\ReportController::class, 'get_objectives'])->name(ImetOecm\Controller::ROUTE_PREFIX.'report_objectives');
        });

    });

});
