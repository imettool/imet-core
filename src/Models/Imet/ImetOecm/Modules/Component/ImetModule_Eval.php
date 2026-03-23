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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Component;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Dependencies;
use ImetCore\Models\Imet\Components\Modules\ImetModule_Eval as BaseImetEvalModule;
use ImetCore\Models\Imet\Components\Upgrade;
use ImetCore\Models\Imet\ImetOecm\Imet;

class ImetModule_Eval extends BaseImetEvalModule
{
    use Dependencies;
    use Upgrade;

    public const ?string MODULE_SCOPE = null;

    protected static ?string $schema = Database::OECM_SCHEMA;

    protected static ?string $form_class = Imet::class;
}
