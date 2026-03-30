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

namespace ImetCore\View;

use Illuminate\Support\Str;
use Illuminate\View\View;
use ImetCore\Exceptions\UnrecognizedInputType;
use ImetCore\Helpers\SelectionList;
use ModularForms\View\Module\Components\Field\Input;
use Throwable;

class CustomInput extends Input
{
    /**
     * @throws Throwable
     */
    #[\Override]
    public function render(): View
    {
        if (Str::startsWith($this->type, 'custom::')) {

            $type = Str::replace('custom::', '', $this->type);

            //  #########  Common inputs  #########

            // Wdpa selector
            if (Str::contains($type, 'selector-wdpa')) {
                $countries = SelectionList::CacheListInSession('ImetV2_PaCountry');
                if (Str::contains($type, '_multiple')) {
                    return view('imet-core::components.inputs.selector-wdpa_multiple', ['countries' => $countries]);
                }

                return view('imet-core::components.inputs.selector-wdpa', ['countries' => $countries]);
            }

            // Species selector
            if (Str::contains($type, 'selector-species')) {
                return view('imet-core::components.inputs.selector-species');
            }

            // Radio button
            if (Str::contains($type, 'radio')) {
                $list_type = Str::replace('radio-', '', $type);
                $list = SelectionList::getList($list_type);

                return view('imet-core::components.inputs.radio', ['list' => $list]);
            }

            // ######### IMET or OECM specific inputs #########

            // Version
            if (Str::startsWith($type, 'version-')) {
                return view('imet-core::components.inputs-preview.version-'.Str::replaceFirst('version-', '', $type));
            }

            // Designation (shared v2/oecm)
            if ($type === 'designation-eng') {
                return view('imet-core::components.inputs.designation-eng');
            }

            // Sub-governance model (shared v2/oecm)
            if ($type === 'sub-governance-model') {
                return view('imet-core::components.inputs.sub-governance-model');
            }

            // Management equipment adequacy - equipment (shared v2/oecm)
            if ($type === 'management-equipment-adequacy-equipment') {
                return view('imet-core::components.inputs.management-equipment-adequacy-equipment');
            }

            // Management equipment adequacy - score (shared v2/oecm)
            if ($type === 'management-equipment-adequacy-score') {
                return view('imet-core::components.inputs.management-equipment-adequacy-score');
            }

            // V2 key element
            if ($type === 'v2-key-element') {
                return view('imet-core::components.inputs.v2-key-element');
            }

            // V2 importance ecosystem services aspect
            if ($type === 'v2-importance-ecosystem-services-aspect') {
                return view('imet-core::components.inputs.v2-importance-ecosystem-services-aspect');
            }

            // V2 menaces aspect
            if ($type === 'v2-menaces-aspect') {
                return view('imet-core::components.inputs.v2-menaces-aspect');
            }

            // V2 ecosystem services intervention
            if ($type === 'v2-ecosystem-services-intervention') {
                return view('imet-core::components.inputs.v2-ecosystem-services-intervention');
            }

            // V2 ctx11 type
            if ($type === 'v2-ctx11-type') {
                return view('imet-core::components.inputs.v2-ctx11-type');
            }

            // OECM key elements element
            if ($type === 'oecm-key-elements-element') {
                return view('imet-core::components.inputs.oecm-key-elements-element');
            }

            // OECM threat with ranking
            if ($type === 'oecm-threat-with-ranking') {
                return view('imet-core::components.inputs.oecm-threat-with-ranking');
            }

            // OECM support integration stakeholder with ranking
            if ($type === 'oecm-support-integration-stakeholder-with-ranking') {
                return view('imet-core::components.inputs.oecm-support-integration-stakeholder-with-ranking');
            }

            // OECM ctx11 type
            if ($type === 'oecm-ctx11-type') {
                return view('imet-core::components.inputs.oecm-ctx11-type');
            }

            // Custom input not recognized
            throw new UnrecognizedInputType($type);
        }

        return parent::render();
    }
}
