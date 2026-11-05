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

use ImetCore\Helpers\Seeders\ImetFieldFaker;
use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Imet;
use ModularForms\Seeders\FieldContext;

/**
 * @param  class-string  $module
 * @param  array<string, mixed>  $record
 * @return list<mixed>
 */
function fakeImetField(string $type, string $name, string $module, array $record = [], int $times = 50): array
{
    $faker = new ImetFieldFaker;
    $values = [];
    for ($i = 0; $i < $times; $i++) {
        $values[] = $faker->fake(new FieldContext($type, $name, $module, 1, null, $record));
    }

    return $values;
}

test('ImetFieldFaker picks a v2 protected area type as the v2 radio input does', function (): void {
    $values = fakeImetField('custom::v2-ctx11-type', 'Type', Imet\ImetV2\Modules\Context\GeneralInfo::class);

    expect($values)->each->toBeIn(array_keys(trans('imet-core::v2_lists.PaType')));
});

test('ImetFieldFaker picks an OECM protected area type as the OECM radio input does', function (): void {
    $values = fakeImetField('custom::oecm-ctx11-type', 'Type', Imet\ImetOecm\Modules\Context\GeneralInfo::class);

    expect($values)->each->toBeIn(array_keys(SelectionList::getList('Imet_PaType')));
});

test('ImetFieldFaker picks a key of the list named after radio- for custom radio inputs', function (string $listType): void {
    $values = fakeImetField('custom::radio-'.$listType, 'Field', Imet\ImetV2\Modules\Context\Spillover::class);

    expect($values)->each->toBeIn(array_keys(SelectionList::getList($listType)));
})->with([
    'ImetV2_ConnectivityIntegrationInManagementPlan',
    'ImetV2_SupportingEvidence',
    'ImetV2_ProvisioningPerceivedCatchChange',
]);
