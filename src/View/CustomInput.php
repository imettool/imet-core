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

        // Wdpa selector
        if (Str::contains($this->type, 'selector-wdpa')) {
            $countries = SelectionList::CacheListInSession('ImetV2_PaCountry');
            if(Str::contains($this->type, '_multiple')) {
                return view('imet-core::components.inputs.selector-wdpa_multiple', ['countries' => $countries]);
            } else {
                return view('imet-core::components.inputs.selector-wdpa', ['countries' => $countries]);
            }
        }

        // Species selector
        if (Str::contains($this->type, 'selector-species')) {
            return view('imet-core::components.inputs.selector-species');
        }

        // Radio button
        if (Str::contains($this->type, 'radio')) {
            return view('imet-core::components.inputs.radio');
        }

        return parent::render();
    }
}
