<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;

return RectorConfig::configure()
    ->withPaths([

        # Development environment folders
        __DIR__ . '/app',
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/package',
        __DIR__ . '/public',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
//        __DIR__ . '/tests',

        # imet-core package folders
        __DIR__ . '/package/imet-core/src',

    ])
//    ->withPhpSets(php84: true)
//    ->withTypeCoverageLevel(0)
//    ->withDeadCodeLevel(0)
//    ->withCodeQualityLevel(0)
    ;
