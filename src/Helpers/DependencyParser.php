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
    protected const COPYRIGHT = 'Copyright (C) 2025 European Union';

    /**
     * Override: exclude modular-forms from the list of NPM dependencies
     */
    #[Override]
    protected static function getNpmDirectDependencyList(bool $includeDev): array
    {
        $dependencies = parent::getNpmDirectDependencyList($includeDev);

        return array_filter($dependencies, function ($dependency) {
            return $dependency !== 'modular-forms';
        });
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
        } elseif ($packageInfo['name'] === 'echarts' && str_contains($copyright, 'yyyy')) {
            return 'Copyright 2017-2025 The Apache Software Foundation';
        } elseif (str_contains($packageInfo['name'], 'modular-forms')) {
            return BaseDependencyParser::COPYRIGHT;
        }

        return $copyright;
    }

    /**
     * Override: hardcode version for modular-forms
     */
    #[Override]
    protected static function retrieveVersion(array $packageInfo): string
    {
        $version = parent::retrieveVersion($packageInfo);

        // Hardcoded versions
        if ($packageInfo['name'] == 'modular-forms') {
            $details = self::getDetailsFromComposerLock(['andreamarelli/'.$packageInfo['name']], false);
            $version = $details[0]['version'];
        }

        return $version;
    }

    /**
     * Override: hardcode license for modular-forms
     */
    #[Override]
    protected static function retrieveLicense(array $packageInfo): array
    {
        $license = parent::retrieveLicense($packageInfo);

        // Hardcoded licenses
        if ($packageInfo['name'] == 'modular-forms') {
            $license[] = 'EUPL-1.2';
        }

        return $license;
    }

    /**
     * Override: hardcode URL for modular-forms
     */
    #[Override]
    protected static function retrievePackageUrl(array $packageInfo, string $mode): ?string
    {
        $url = parent::retrievePackageUrl($packageInfo, $mode);

        // Hardcoded URLs
        if ($packageInfo['name'] === 'modular-forms') {
            return BaseDependencyParser::COPYRIGHT;
        }

        return $url;
    }
}
