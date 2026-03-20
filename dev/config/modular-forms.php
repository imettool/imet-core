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

return [

    // IMET views and models from module keys
    'model_view_by_key_custom_method' => \ImetCore\Helpers\ModuleKey::class.'::KeyToView',
    'model_class_by_key_custom_method' => \ImetCore\Helpers\ModuleKey::class.'::KeyToClassName',

    // CustomInput Component Class: extend with custom input types
    'custom_inputs_view' => \ImetCore\View\CustomInput::class,
    'custom_inputs-preview_view' => \ImetCore\View\CustomInputPreview::class,

];
