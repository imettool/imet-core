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

namespace ImetCore\Helpers;

use ModularForms\Helpers\DependencyParser as BaseDependencyParser;
use Override;

class DependencyParser extends BaseDependencyParser
{
    protected const string COPYRIGHT = 'Copyright (C) 2025 European Union';

    /**
     * Override: exclude modular-forms from the list of NPM dependencies
     */
    #[Override]
    protected static function getNpmDirectDependencyList(bool $includeDev): array
    {
        $dependencies = parent::getNpmDirectDependencyList($includeDev);

        return array_filter($dependencies, fn (string $dependency): bool => $dependency !== 'modular-forms');
    }

    /**
     * Override: hardcode copyright for specific packages
     */
    #[Override]
    protected static function retrieveCopyright(array $packageInfo, string $mode): ?string
    {
        $copyright = parent::retrieveCopyright($packageInfo, $mode);
        // Hardcode copyright for specific packages
        if ($copyright === null && $packageInfo['name'] === 'vue3-colorpicker') {
            return 'Copyright (c) 2021-present vue3-colorpicker';
        }

        if ($packageInfo['name'] === 'echarts' && str_contains((string) $copyright, 'yyyy')) {
            return 'Copyright 2017-2025 The Apache Software Foundation';
        }

        // Hardcode copyright for specific packages
        if (str_contains($packageInfo['name'], 'modular-forms')) {
            return BaseDependencyParser::COPYRIGHT;
        }

        return $copyright;
    }

}
