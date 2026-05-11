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

namespace ImetCore\Controllers\Imet\ImetV2;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use ImetCore\Models\Imet\CrossAnalysis\CrossAnalysis;
use ImetCore\Models\Imet\ImetV1\Imet;
use ImetCore\Models\Imet\ImetV2\Imet_Eval;

use function view;

final class EvalController extends BaseEvalController
{
    protected static ?string $form_class = Imet_Eval::class;

    protected static ?string $form_view_prefix = 'imet-core::v2.evaluation';

    /**
     * add extra step for cross analysis before the last one
     */
    public static function steps($form): array
    {
        $steps = array_keys($form->modules());
        $last_step = array_splice($steps, -1);

        return array_merge($steps, ['cross_analysis'], $last_step);
    }

    /**
     * Override edit route
     *
     * @throws AuthorizationException
     */
    #[\Override]
    public function edit($item, $step = null): Application|View|Factory
    {
        $imet = (self::$form_class)::find($item);
        $this->authorize('edit', $imet);

        $step = $step == null ? 'context' : $step;
        $cross_analysis_warnings = CrossAnalysis::getIndicators($imet);

        return view(self::$form_view_prefix.'.edit', [
            'controller' => self::class,
            'item' => $imet,
            'step' => $step,
            'cross_analysis_warnings' => $cross_analysis_warnings,
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
        $imet = (self::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;
        $cross_analysis_warnings = CrossAnalysis::getIndicators($imet);

        return view(self::$form_view_prefix.'.show', [
            'controller' => self::class,
            'item' => $imet,
            'step' => $step,
            'cross_analysis_warnings' => $cross_analysis_warnings,
        ]);
    }
}
