<?php

/*
 * Copyright (C) 2026 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

declare(strict_types=1);

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ImetCore\Helpers\Seeders\FormSeeder;
use ImetCore\Helpers\Seeders\ProtectedAreaSeeder;
use ImetCore\Helpers\Seeders\SpeciesSeeder;
use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Imet;
use ModularForms\Models\Module;

uses(RefreshDatabase::class);

/**
 * `custom::*` fields the seeder leaves NULL.
 */
const UNSEEDED_CUSTOM_FIELDS = [
    // management equipment adequacy score: display-only, computed from the context Equipments module (null by design)
    'ManagementEquipmentAdequacy.EvaluationScore (custom::management-equipment-adequacy-score)',
    'ManagementEquipmentAdequacy.Adequacy (custom::management-equipment-adequacy-score)',
];

/**
 * `custom::*` fields legitimately empty depending on another field: checked by dedicated tests, not by the
 * "is it ever filled" check (which would be random for them)
 */
const CONDITIONAL_CUSTOM_FIELDS = [
    // empty when GovernanceModel has no sub-models (e.g. "not_reported")
    'Governance.SubGovernanceModel (custom::sub-governance-model)',
];

/**
 * Return "<module short name>.<field> (<type>)" for every custom:: field of the given form classes
 *
 * @param  list<class-string<Imet\Imet>>  $formClasses
 * @return array<string, array{module: class-string<Module>, field: string}>
 */
function customFields(array $formClasses): array
{
    $fields = [];
    foreach ($formClasses as $formClass) {
        foreach ($formClass::allModules() as $module) {
            $instance = new $module;
            foreach (array_merge($instance->module_fields, $instance->module_common_fields) as $field) {
                if (Str::startsWith($field['type'], 'custom::')) {
                    $key = class_basename($module).'.'.$field['name'].' ('.$field['type'].')';
                    $fields[$key] = ['module' => $module, 'field' => $field['name']];
                }
            }
        }
    }

    return $fields;
}

/**
 * Return the custom:: fields that are NULL in every seeded record
 *
 * @param  array<string, array{module: class-string<Module>, field: string}>  $fields
 * @return list<string>
 */
function unseededFields(array $fields): array
{
    return collect($fields)
        ->except(CONDITIONAL_CUSTOM_FIELDS)
        ->filter(fn (array $field): bool => DB::table((new $field['module'])->getTable())
            ->whereNotNull($field['field'])
            ->doesntExist())
        ->keys()
        ->sort()
        ->values()
        ->all();
}

beforeEach(function (): void {
    (new UserSeeder)->run();
    (new ProtectedAreaSeeder)->run();
    (new SpeciesSeeder)->run();
});

test('every custom:: field is either seeded or listed as a known gap', function (string $version, array $formClasses): void {
    (new FormSeeder)->run($version, 1);

    $unseeded = unseededFields(customFields($formClasses));
    $expected = collect(UNSEEDED_CUSTOM_FIELDS)
        ->filter(fn (string $key): bool => array_key_exists($key, customFields($formClasses)))
        ->sort()
        ->values()
        ->all();

    expect($unseeded)->toBe($expected);
})->with([
    'IMET v1' => [Imet\Imet::IMET_V1, [Imet\ImetV1\Imet::class, Imet\ImetV1\Imet_Eval::class]],
    'IMET v2' => [Imet\Imet::IMET_V2, [Imet\ImetV2\Imet::class, Imet\ImetV2\Imet_Eval::class]],
    'IMET OECM' => [Imet\Imet::IMET_OECM, [Imet\ImetOecm\Imet::class, Imet\ImetOecm\Imet_Eval::class]],
]);

test('the sub-governance model is seeded exactly when the governance model has sub-models', function (string $version, string $module): void {
    (new FormSeeder)->run($version, 5);

    $groups = SelectionList::getList('ImetOECM_SubGovernanceModel');
    $records = DB::table((new $module)->getTable())->get(['GovernanceModel', 'SubGovernanceModel']);

    expect($records)->not->toBeEmpty();
    foreach ($records as $record) {
        $subModels = array_keys($groups[$record->GovernanceModel] ?? []);
        $subModels === []
            ? expect($record->SubGovernanceModel)->toBeNull()
            : expect($record->SubGovernanceModel)->toBeIn($subModels);
    }
})->with([
    'IMET v2' => [Imet\Imet::IMET_V2, Imet\ImetV2\Modules\Context\Governance::class],
    'IMET OECM' => [Imet\Imet::IMET_OECM, Imet\ImetOecm\Modules\Context\Governance::class],
]);
