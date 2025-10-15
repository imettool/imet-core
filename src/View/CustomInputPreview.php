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
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use ModularForms\View\Module\Components\Field\InputPreview;

class CustomInputPreview extends InputPreview
{
    #[\Override]
    public function render(): View
    {

        // ### imet-core custom inputs ###
        if (Str::startsWith($this->type, 'imet-core::')) {
            // Wdpa selector
            if (Str::contains($this->type, 'selector-wdpa_multiple')) {
                $list = '';
                if (filled($this->value)) {
                    $list = array_map(function ($v) {
                        return ProtectedArea::getByWdpa($v)->name;
                    }, explode(',', $this->value));
                    $list = implode(', ', $list);
                }

                return view('imet-core::components.inputs-preview.selector-wdpa', ['list' => $list]);
            }
            // Wdpa selector
            if (Str::contains($this->type, 'selector-species')) {
                $name = null;
                if (filled($this->value)) {
                    $name = Species::getPlainNameByTaxonomy($this->value);
                }

                return view('imet-core::components.inputs-preview.selector-species', ['name' => $name]);
            }
        }

        return parent::render();
    }
}
