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
use ImetCore\Models\Imet;
use ModularForms\Models\Module;

uses(RefreshDatabase::class);

/**
 * `custom::*` fields the seeder does not fill yet (always NULL).
 * Remove an entry when the corresponding seeding gap is fixed.
 */
const UNSEEDED_CUSTOM_FIELDS = [
    // sub-governance model: the seeder checks ".SubGovernanceModel"
    'Governance.SubGovernanceModel (custom::sub-governance-model)',
    // management equipment adequacy score: not handled
    'ManagementEquipmentAdequacy.EvaluationScore (custom::management-equipment-adequacy-score)',
    'ManagementEquipmentAdequacy.Adequacy (custom::management-equipment-adequacy-score)',
    // radio-* lists: not handled
    'Connectivity.ConnectivityIntegrationInManagementPlan (custom::radio-ImetV2_ConnectivityIntegrationInManagementPlan)',
    'Connectivity.DocumentedConnectivity (custom::radio-ImetV2_DocumentedConnectivity)',
    'Connectivity.EvidenceOfConnectivity (custom::radio-ImetV2_EvidenceOfConnectivity)',
    'Spillover.ProvisioningEvidence (custom::radio-ImetV2_ProvisioningEvidence)',
    'Spillover.ProvisioningKeyObservations (custom::radio-ImetV2_ProvisioningKeyObservations)',
    'Spillover.ProvisioningPerceivedCatchChange (custom::radio-ImetV2_ProvisioningPerceivedCatchChange)',
    'Spillover.ProvisioningPerceivedSpillover (custom::radio-ImetV2_ProvisioningPerceivedSpillover)',
    'Spillover.SupportingEvidence (custom::radio-ImetV2_SupportingEvidence)',
    'Spillover.SupportingKeyObservations (custom::radio-ImetV2_SupportingKeyObservations)',
    'Spillover.SupportingPerceivedSizeChange (custom::radio-ImetV2_SupportingPerceivedSizeChange)',
    'Spillover.SupportingPerceivedSpeciesChange (custom::radio-ImetV2_SupportingPerceivedSpeciesChange)',
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
