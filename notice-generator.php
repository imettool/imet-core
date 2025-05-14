<?php

include_once __DIR__ . '/vendor/autoload.php';

use ModularForms\Helpers\DependencyParser as BaseDependencyParser;

class DependencyParser extends BaseDependencyParser
{
    /**
     * Override: exclude modular-forms from the list of NPM dependencies
     */
    protected static function getNpmDirectDependencyList(bool $includeDev): array
    {
        $dependencies = parent::getNpmDirectDependencyList($includeDev);
        return array_filter($dependencies, function ($dependency) {
            return $dependency != 'modular-forms';
        });
    }

    /**
     * Override: hardcode copyright for specific packages
     */
    protected static function retrieveCopyright(array $packageInfo, string $mode): ?string
    {
        $copyright = parent::retrieveCopyright($packageInfo, $mode);

        // Hardcode copyright for specific packages
        if($copyright===null && $packageInfo['name'] === 'vue3-colorpicker') {
            return 'Copyright (c) 2021-present vue3-colorpicker';
        } else if($packageInfo['name'] === 'echarts' && str_contains($copyright, 'yyyy')) {
            return 'Copyright 2017-2025 The Apache Software Foundation';
        } else if(str_contains($packageInfo['name'], 'modular-forms')) {
            return self::COPYRIGHT;
        }

        return $copyright;
    }

    /**
     * Override: hardcode version for modular-forms
     */
    protected static function retrieveVersion(array $packageInfo): string
    {
        $version = parent::retrieveVersion($packageInfo);

        // Hardcoded versions
        if($packageInfo['name'] == 'modular-forms') {
            $details = self::getDetailsFromComposerLock(['andreamarelli/'.$packageInfo['name']], false);
            $version = $details[0]['version'];
        }

        return $version;
    }

    /**
     * Override: hardcode license for modular-forms
     */
    protected static function retrieveLicense(array $packageInfo): array
    {
        $license = parent::retrieveLicense($packageInfo);

        // Hardcoded licenses
        if($packageInfo['name'] == 'modular-forms') {
            $license[] = 'EUPL-1.2';
        }

        return $license;
    }

    /**
     * Override: hardcode URL for modular-forms
     */
    protected static function retrievePackageUrl(array $packageInfo, string $mode): ?string
    {
        $url = parent::retrievePackageUrl($packageInfo, $mode);

        // Hardcoded URLs
        if($packageInfo['name'] === 'modular-forms') {
            return self::COPYRIGHT;
        }

        return $url;
    }

}

const WITH_DEV = false;

try {
    DependencyParser::generateNoticeFile(WITH_DEV);
} catch (Exception $e) {
    print($e->getMessage());
    die();
}