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

namespace ImetCore\View\Module;

use ImetCore\Models\Imet\ImetV1\Modules\Component\ImetModule as ImetModuleV1;
use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule as ImetModuleV2;
use ImetCore\Models\Imet\ImetOecm\Modules\Component\ImetModule as ImetOecmModule;
use ImetCore\Models\Imet\ImetV1\Modules\Component\ImetModule_Eval as ImetModuleEvalV1;
use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule_Eval as ImetModuleEvalV2;
use ImetCore\Models\Imet\ImetOecm\Modules\Component\ImetModule_Eval as ImetOecmModuleEval;
use ModularForms\View\Module\Container as ModuleContainer;

class Container extends ModuleContainer
{
    public function __construct(string $controller, string $module, ?int $formId, string $mode)
    {
        // Force locale to IMET language in order to retrieve correct labels and predefined values
        /** @var class-string<ImetModuleV1|ImetModuleV2|ImetOecmModule|ImetModuleEvalV1|ImetModuleEvalV2|ImetOecmModuleEval> $module */
        $module::forceLanguage($formId);

        parent::__construct($controller, $module, $formId, $mode);
    }
}
