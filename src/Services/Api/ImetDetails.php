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

namespace ImetCore\Services\Api;

use ModularForms\Helpers\ModuleKey;
use ImetCore\Models\Animal;

class ImetDetails
{

    private static array $exclude_types = [
        'upload',
        'hidden',
        'file_BYTEA',
        'file'
    ];

    public static function getImetDetails(string $slug, int $form_id): array
    {
        $model = ModuleKey::KeyToClassName($slug);
        $items = $model::where('FormID', $form_id)->get()->makeHidden(['UpdateBy', 'UpdateDate', 'id', 'FormID', 'upload', 'hidden', 'file_BYTEA', 'file']);
        $accepted_fields = [];
        $labels = [];

        if (count($items) > 0) {
            foreach ($items as $field) {
                $filtered_fields = [];
                foreach ($field->module_fields as $value) {
                    if (isset($value['type']) && !in_array($value['type'],
                        static::$exclude_types)) {
                        if (is_string($field[$value['name']])) {
                            $values = static::animalScientificName($field[$value['name']]);
                        }
                        $filtered_fields[$value['name']] = $values;
                        $labels[$value['name']] = $value['label'];
                    }
                }
                $accepted_fields[] = $filtered_fields;
            }
        }

        return ['data' => $accepted_fields, 'labels' => $labels];
    }

    /**
     * Converts a given value to the scientific name format (genus and species) if it is recognized as taxonomy.
     *
     * @param string $value The input value to be checked and converted if it matches taxonomy format.
     * @return string Returns the scientific name (genus and species) if the input is recognized as taxonomy; otherwise, returns the original value.
     */
    private static function animalScientificName(string $value): string
    {
        if (Animal::isTaxonomy($value)) {
            $taxonomy = Animal::parseTaxonomy($value);
            return $taxonomy['genus'] . ' ' . $taxonomy['species'];
        }
        return $value;
    }

    public static function getImetDetailsCsv(string $slug, int $form_id, bool $download = true): string
    {
        $items = static::getImetDetails($slug, $form_id);
        $labels = $items['labels'];
        $data = $items['data'];

        $header = implode(',', array_values($labels)) . "\n";

        $rows = [];
        foreach ($data as $row) {
            $rows[] = implode(',', array_map(function ($value) {
                return '"' . str_replace('"', '""', $value) . '"'; // Escape double quotes
            }, $row));
        }

        return $header . implode("\n", $rows);
    }
}