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

namespace ImetCore\Controllers\Imet;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use ImetCore\Controllers\__Controller;

class EvalController extends __Controller
{
    /**
     * Override edit route
     *
     * @throws AuthorizationException
     */
    #[\Override]
    public function edit($item, $step = null): Application|View|Factory
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;

        return view(static::$form_view_prefix.'.edit', [
            'controller' => static::class,
            'item' => $imet,
            'step' => $step,
        ]);
    }

    /**
     * Override show route
     *
     * @throws AuthorizationException
     */
    #[\Override]
    public function show($item, $step = null): Application|View|Factory
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;

        return view(static::$form_view_prefix.'.show', [
            'controller' => static::class,
            'item' => $imet,
            'step' => $step,
        ]);
    }
}
