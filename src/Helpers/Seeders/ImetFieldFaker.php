<?php

/*
 * Copyright (C) 2026 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

declare(strict_types=1);

namespace ImetCore\Helpers\Seeders;

use Illuminate\Support\Str;
use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\AnalysisStakeholderDirectUsers;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\Stakeholders;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ThreatsBiodiversity;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use ModularForms\Seeders\FieldContext;
use ModularForms\Seeders\FieldFaker;
use ModularForms\Seeders\Unhandled;
use Override;
use Throwable;

/**
 * IMET-specific fake values.
 *
 * custom() runs before the modular-forms standard types; fallback() runs after them
 * (same position as the species / wdpa selectors had in the original seeder).
 */
class ImetFieldFaker extends FieldFaker
{
    /**
     * @throws Throwable
     */
    #[Override]
    protected function custom(FieldContext $field): mixed
    {
        if (Str::contains($field->type, 'ctx11_type')) {
            return array_rand(SelectionList::getList('Imet_PaType'));
        }

        if (Str::contains($field->type, '_EcosystemServicesImportance')) {
            return collect([0, 1])->random();
        }

        if (Str::contains($field->type, '.SubGovernanceModel')
            && (Str::contains(Str::lower($field->type), 'v2')
                || Str::contains(Str::lower($field->type), 'oecm'))) {
            return $this->subGovernanceModel($field);
        }

        if (Str::contains($field->type, 'ImetOECM_AnalysisStakeholders')) {
            return $this->analysisStakeholder();
        }

        if ($field->name === 'Stakeholder' && $field->type === 'hidden' && Str::contains($field->module, 'AnalysisStakeholder')) {
            return collect(Stakeholders::getStakeholders($field->formId))->random();
        }

        if (Str::contains($field->module, 'SupportsAndConstraintsIntegration') && $field->name === 'Stakeholder') {
            return $this->supportsAndConstraintsStakeholder($field);
        }

        if (Str::contains($field->module, 'KeyElements') && $field->name === 'Aspect') {
            return $this->keyElementAspect($field);
        }

        return Unhandled::Value;
    }

    /**
     * @throws Throwable
     */
    #[Override]
    protected function fallback(FieldContext $field): mixed
    {
        if (Str::contains($field->type, 'selector-species')) {
            return $this->species();
        }

        if (Str::contains($field->type, 'selector-wdpa')) {
            return $this->wdpa($field);
        }

        return parent::fallback($field);
    }

    /**
     * @throws Throwable
     */
    private function subGovernanceModel(FieldContext $field): mixed
    {
        $list = Str::contains(Str::lower($field->type), 'v2')
            ? SelectionList::getList('ImetV2_SubGovernanceModel')
            : SelectionList::getList('ImetOECM_SubGovernanceModel');
        $random_group = collect($list)->random();

        return collect($random_group)->random();
    }

    private function analysisStakeholder(): mixed
    {
        $group_key = array_rand(trans('imet-core::oecm_context.AnalysisStakeholders.lists'));
        $list = trans('imet-core::oecm_context.AnalysisStakeholders.lists.'.$group_key);
        $list = array_combine($list, $list);

        return collect($list)->random();
    }

    private function supportsAndConstraintsStakeholder(FieldContext $field): mixed
    {
        if ($field->groupKey === 'group0') {
            return collect(Stakeholders::getStakeholders($field->formId, Stakeholders::ONLY_DIRECT))
                ->random();
        }

        if ($field->groupKey === 'group1') {
            return collect(Stakeholders::getStakeholders($field->formId, Stakeholders::ONLY_INDIRECT))
                ->random();
        }

        return Unhandled::Value;
    }

    private function keyElementAspect(FieldContext $field): mixed
    {
        if ($field->groupKey === 'group0') {
            $key_elements = collect(AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($field->formId))
                ->keyBy('element');

            return $key_elements->keys()->random();
        }

        if ($field->groupKey === 'group1') {
            $biodiversity_key_elements = collect(ThreatsBiodiversity::calculateRanking($field->formId))
                ->sortBy('_score');

            return $biodiversity_key_elements->pluck('Criteria')->random();
        }

        return Unhandled::Value;
    }

    private function species(): string
    {
        $species = Species::query()->inRandomOrder()->first();

        return $species->phylum
            .'|'.$species->class
            .'|'.$species->order
            .'|'.$species->family
            .'|'.$species->genus
            .'|'.$species->species;
    }

    private function wdpa(FieldContext $field): mixed
    {
        if (Str::contains($field->type, 'multiple')) {
            return implode(',', ProtectedArea::query()->inRandomOrder()->limit(random_int(2, 5))->get()->pluck('wdpa_id')->toArray());
        }

        return ProtectedArea::query()->inRandomOrder()->first()->wdpa_id;
    }
}
