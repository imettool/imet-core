<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\ConvertStaticToSelfRector;
use Rector\CodingStyle\Rector\String_\SymplifyQuoteEscapeRector;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use RectorLaravel\Rector\Class_\UseForwardsCallsTraitRector;
use RectorLaravel\Rector\ClassMethod\MakeModelAttributesAndScopesProtectedRector;
use RectorLaravel\Rector\Empty_\EmptyToBlankAndFilledFuncRector;
use RectorLaravel\Rector\MethodCall\ResponseHelperCallToJsonResponseRector;
use RectorLaravel\Set\LaravelSetList;
use RectorLaravel\Set\LaravelSetProvider;

const PATH_TO_DEV = __DIR__;
const PATH_TO_PACKAGE = __DIR__.'/package/imet-core/src';

return RectorConfig::configure()
    ->withPaths([

        // Development environment folders
        //        __DIR__ . '/app',
        //        __DIR__ . '/bootstrap',
        //        __DIR__ . '/config',
        //        __DIR__ . '/public',
        //        __DIR__ . '/resources',
        //        __DIR__ . '/routes',

        // imet-core package folders
        PATH_TO_PACKAGE,

    ])
    ->withSkip([
        PATH_TO_DEV.'/bootstrap/cache',
        PATH_TO_PACKAGE.'/Models/Utils/Country.php',      // abstract class, cannot add Override attribute
        ConvertStaticToSelfRector::class,                       // Need to review all changes
        FirstClassCallableRector::class => [
            PATH_TO_DEV.'/routes',                            // do not convert to first class callable in routes
            PATH_TO_PACKAGE.'/Routes',
        ],
        MakeModelAttributesAndScopesProtectedRector::class,
        SymplifyQuoteEscapeRector::class => [
            PATH_TO_PACKAGE.'/Lang',                      // Keep always same quote style in lang files
        ],
    ])
//    ->withPhpSets(php84: true)
    ->withSetProviders(LaravelSetProvider::class)
    ->withComposerBased(laravel: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        //        privatization: true,
        // //        naming: true,                 // not necessary, and sometimes harmful
        //        instanceOf: true,
        //        earlyReturn: true,
        //        strictBooleans: true,
        //        carbon: true,
        // //        rectorPreset: true,           // To be decided: introduce strict type declaration
    )
    ->withSets([
        LaravelSetList::LARAVEL_ARRAYACCESS_TO_METHOD_CALL,
        LaravelSetList::LARAVEL_ARRAY_STR_FUNCTION_TO_STATIC_CALL,
        LaravelSetList::LARAVEL_CODE_QUALITY,
        LaravelSetList::LARAVEL_COLLECTION,
        LaravelSetList::LARAVEL_CONTAINER_STRING_TO_FULLY_QUALIFIED_NAME,
        LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER,
        LaravelSetList::LARAVEL_FACADE_ALIASES_TO_FULL_NAMES,
        //        LaravelSetList::LARAVEL_FACTORIES,  // Not using model factories
        LaravelSetList::LARAVEL_IF_HELPERS,
        LaravelSetList::LARAVEL_LEGACY_FACTORIES_TO_CLASSES,
        // LaravelSetList::LARAVEL_STATIC_TO_INJECTION      // No, not this one!! What's wrong with Laravel's Facades??
    ])
    ->withRules([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        EmptyToBlankAndFilledFuncRector::class,
        ResponseHelperCallToJsonResponseRector::class,
        UseForwardsCallsTraitRector::class,
    ]);
