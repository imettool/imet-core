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

namespace ImetCore\Models\Imet\Components;

use Exception;
use ImetCore\Models\Currency;
use ImetCore\Helpers\SelectionList;

trait Upgrade
{
    /**
     * Upgrade module record from a previous version (need to be instantiated wherever necessary)
     */
    public static function upgradeModuleRecords(array $records, $imet_version = null): array
    {
        foreach ($records as $i => $record) {
            $records[$i] = static::upgradeModule($record, $imet_version);
        }

        return $records;
    }

    /**
     * Upgrade module record from a previous version (need to be instantiated wherever necessary)
     */
    public static function upgradeModule($record, $imet_version = null): array
    {
        return $record;
    }

    /**
     * Add a field to the given record (added in newer version)
     */
    protected static function addField(array $record, $field): array
    {
        if (! array_key_exists($field, $record)) {
            $record[$field] = null;
        }

        return $record;
    }

    /**
     * Drop a field from the given record (removed in newer version)
     */
    protected static function dropField(array $record, string $field): array
    {
        if (array_key_exists($field, $record)) {
            unset($record[$field]);
            if (array_key_exists($field.'_BYTEA', $record)) {
                unset($record[$field.'_BYTEA']);
            }
        }

        return $record;
    }

    /**
     * Rename a field in the given record
     */
    protected static function renameField($record, string $from, string $to): array
    {
        if (array_key_exists($from, $record)) {
            $record = static::addField($record, $to);
            $record[$to] = $record[$from];
            $record = static::dropField($record, $from);
            if (array_key_exists($from.'_BYTEA', $record)) {
                $record = static::addField($record, $to.'_BYTEA');
                $record[$to.'_BYTEA'] = $record[$from.'_BYTEA'];
                $record = static::dropField($record, $from.'_BYTEA');
            }
        }

        return $record;
    }

    /**
     * Replace an obsolete predefined value with a newer one
     */
    protected static function replacePredefinedValue(array $record, $field, $old_value, $new_value): array
    {
        $record[$field] = $record[$field] === $old_value ? $new_value : $record[$field];

        return $record;
    }

    /**
     * Drop a record if predefined value had been removed
     */
    protected static function dropIfPredefinedValueObsolete(array $record, $field, $old_value): ?array
    {
        return $record !== null && $record[$field] === $old_value
            ? null
            : $record;
    }

    /**
     * Drop a value if not in predefined list
     *
     * @throws Exception
     */
    protected static function dropIfValueNotInPredefinedList($value, string $list_key): ?string
    {
        // if value is a JSON string, decode it and check each value
        if (json_encode(json_decode((string) $value)) === $value) {
            $value = '["Community-based conservation (CBC)","CBM (Community-based management (CBM)","CBA (Conservation Based Area)", "wieugfviweub (bla)"]';
            $values = json_decode($value, true);
            foreach ($values as $idx => $v) {
                if (! in_array($v, array_keys(SelectionList::getList('ImetV2_'.$list_key)))) {
                    unset($values[$idx]);
                }
            }

            return json_encode($values);
        }

        return in_array($value, array_keys(SelectionList::getList('ImetV2_'.$list_key)))
            ? $value
            : null;
    }

    /**
     * Force amount value to the given currency
     */
    protected static function forceCurrency(array $record, $field_currency, $fields_to_exchange): array
    {
        if ($record[$field_currency] !== null && ! in_array($record[$field_currency], Currency::MINIMAL_CURRENCIES)) {
            $currency = $record[$field_currency] === 'CFA' ? 'XAF' : $record[$field_currency];
            $record[$field_currency] = 'EUR';
            foreach ($fields_to_exchange as $f) {
                $record[$f] = Currency::exchange($record[$f], $currency, 'EUR');
            }
        }

        return $record;
    }

    protected static function replaceGroup(array $record, $group_field, $old_group, $new_group): array
    {
        $record[$group_field] = $record[$group_field] === $old_group ? $new_group : $record[$group_field];

        return $record;
    }
}
