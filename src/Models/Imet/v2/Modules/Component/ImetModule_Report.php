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

namespace ImetCore\Models\Imet\v2\Modules\Component;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\v2\Imet_Report;
use ImetCore\Models\User\Role;

class ImetModule_Report extends ImetModule
{
    protected static ?string $schema = Database::IMET_SCHEMA;

    protected static ?string $form_class = Imet_Report::class;

    public const ?string MODULE_SCOPE = null;


    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public ?array $fieldsDefinitions;

    public static function getDefinitions(?int $form_id = null): array
    {
        $definitions = parent::getDefinitions($form_id);
        $model = new (static::class);
        $definitions['fieldsDefinitions'] = $model->fieldsDefinitions ?? null;

        return $definitions;
    }
}
