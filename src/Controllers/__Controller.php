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

namespace ImetCore\Controllers;

use ImetCore\Services\Api\ImetDetails;
use ModularForms\Controllers\FormController as BaseFormController;

/**
 * Class FormController
 *
 * @package ImetCore\Controllers
 */
class __Controller extends BaseFormController
{
    public const AUTHORIZE_BY_POLICY = true;

    public function get_csv(int $imet, string $slug)
    {
        $csv_content = ImetDetails::getImetDetailsCsv($slug, $imet);
        $filename = 'imet_' . $slug . '_' . $imet . '_' . date('Y-m-d') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $csv_content;
        exit;
    }
}
