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

// This script generates a NOTICE file based on the dependencies of the project.
// It requires the dependencies to be installed first, as it relies on the 'vendor' and 'node_modules' directories (in
// the root folder of the project - not in dev/) to parse the dependencies and their licenses.

if (! is_dir(__DIR__.'/vendor/')) {
    echo "\033[31mPlease run 'composer install' before running this script.\033[0m \n\n";
    exit();
}
if (! is_dir(__DIR__.'/node_modules/')) {
    echo "\033[31mPlease run 'npm install' before running this script.\033[0m \n\n";
    exit();
}

include_once __DIR__.'/vendor/autoload.php';

use ImetCore\Helpers\DependencyParser;

const WITH_DEV = false;

try {
    DependencyParser::generateNoticeFile(WITH_DEV);
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
