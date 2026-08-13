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
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use ModularForms\View\Module\Components\Field\InputPreview;

class CustomInputPreview extends InputPreview
{
    #[\Override]
    public function render(): View
    {
        if (Str::startsWith($this->type, 'custom::')) {

            $type = Str::replace('custom::', '', $this->type);

            //  #########  Common inputs  #########

            // Wdpa selector
            if (Str::contains($type, 'selector-wdpa_multiple')) {
                $list = '';
                if (filled($this->value)) {
                    $list = array_map(fn (string $v) => ProtectedArea::getByWdpa($v)->name, explode(',', $this->value));
                    $list = implode(', ', $list);
                }

                return view('imet-core::components.inputs-preview.selector-wdpa', ['list' => $list]);
            }

            // Species selector
            if (Str::contains($type, 'selector-species')) {
                $name = null;
                if (filled($this->value)) {
                    $name = Species::getPlainNameByTaxonomy($this->value);
                }

                return view('imet-core::components.inputs-preview.selector-species', ['name' => $name]);
            }

            // Radio button
            if (Str::contains($type, 'radio')) {
                $list_type = Str::replace('radio-', '', $type);
                $list = SelectionList::getList($list_type);

                return view('imet-core::components.inputs-preview.radio', ['list' => $list, 'value' => $this->value]);
            }

            // Heatmap rating
            if (Str::contains($type, 'heatmapRating')) {
                return view('imet-core::components.inputs-preview.heatmap-rating');
            }

            // ######### IMET or OECM specific inputs #########

            // Version
            if (Str::startsWith($type, 'version-')) {
                return view('imet-core::components.inputs-preview.version-'.Str::replaceFirst('version-', '', $type));
            }

            // V2 key element preview
            if ($type === 'v2-key-element') {
                return view('imet-core::components.inputs-preview.v2-key-element');
            }

            // V2 ctx11 type preview
            if ($type === 'v2-ctx11-type') {
                return view('imet-core::components.inputs-preview.v2-ctx11-type');
            }

            // OECM ctx11 type preview
            if ($type === 'oecm-ctx11-type') {
                return view('imet-core::components.inputs-preview.oecm-ctx11-type');
            }

            // Fallback to parent in case a custom input for EDIT exists but not necessary in SHOW
            if (in_array($type, [
                'sub-governance-model',
                'management-equipment-adequacy-equipment',
                'management-equipment-adequacy-score',
                'v2-importance-ecosystem-services-aspect',
                'v2-menaces-aspect',
                'v2-ecosystem-services-intervention',
                'oecm-support-integration-stakeholder-with-ranking',
                'oecm-threat-with-ranking',
                'oecm-key-elements-element',
                'heatmapRating'
            ])) {
                return parent::render();
            }

            // Custom input not recognized
            throw new UnrecognizedInputType($type);
        }

        return parent::render();
    }
}
