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

namespace ImetCore;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use ImetCore\Commands\CalculateScores;
use ImetCore\Commands\ConvertSQLite;
use ImetCore\Commands\Export;
use ImetCore\Commands\Import;
use ImetCore\Models\Imet\Imet;
use ImetCore\Policies\ImetPolicy;

class ServiceProvider extends BaseServiceProvider
{
    const BASE_PATH = __DIR__.'/';

    /**
     * Register services.
     */
    #[\Override]
    public function register(): void
    {
        $this->mergeConfigFrom(static::BASE_PATH.'config/config.php', 'imet-core');
        Gate::policy(Imet::class, ImetPolicy::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Migrations
        $this->loadMigrationsFrom([
            static::BASE_PATH.'database/migrations/public',
            static::BASE_PATH.'database/migrations/imet',
            static::BASE_PATH.'database/migrations/oecm',
        ]);

        // Views
        $this->loadViewsFrom(static::BASE_PATH.'resources/views', 'imet-core');
        $this->publishes([
            static::BASE_PATH.'resources/views/vendor/modular-forms' => resource_path('views/vendor/modular-forms'), // Override ModularForms views
        ], 'imet-core');

        // View components
        Blade::componentNamespace('ImetCore\View', 'imet-core');

        // Routes
        Route::group($this->routeConfiguration('web'), function (): void {
            $this->loadRoutesFrom(static::BASE_PATH.'Routes/web.php');
        });
        Route::group($this->routeConfiguration('api'), function (): void {
            $this->loadRoutesFrom(static::BASE_PATH.'Routes/api.php');
        });

        // Config
        $this->publishes([
            static::BASE_PATH.'config/config.php' => config_path('imet-core.php'),
        ], 'imet-core');

        // Lang
        $this->loadTranslationsFrom(static::BASE_PATH.'Lang', 'imet-core');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                CalculateScores::class,
                ConvertSQLite::class,
                Export::class,
                Import::class,
            ]);
        }
    }

    private function routeConfiguration(string $route_file): array
    {
        if ($route_file === 'web' && config('imet-core.web_routes_prefix') !== null) {
            return [
                'prefix' => config('imet-core.web_routes_prefix'),
            ];
        }

        if ($route_file === 'api' && config('imet-core.api_routes_prefix') !== null) {
            return [
                'prefix' => config('imet-core.api_routes_prefix'),
            ];
        }

        return [];
    }
}
