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

use ImetCore\Controllers\Imet\Controller as BaseController;
use ImetCore\Controllers\Imet\Traits\CreateAndStoreNonWdpa;
use ImetCore\Controllers\Imet\Traits\Prefill;
use ImetCore\Models\Imet\ImetV2\Imet;

class Controller extends BaseController
{
    use CreateAndStoreNonWdpa;
    use Prefill;

    public const ROUTE_PREFIX = 'imet-core::v2.';

    protected static ?string $form_class = Imet::class;

    protected static ?string $form_view_prefix = 'imet-core::v2';
}
