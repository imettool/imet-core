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

namespace ImetCore\Helpers\Dev;

use Exception;
use Illuminate\Support\Str;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use ModularForms\Helpers\Input\SelectionList;
use ModularForms\Models\Module;

class FormSeeder
{

    /**
     * Create a new form for the given (or random) protected area and populate it with fake data
     * @throws Exception
     */
    public static function seedForm(?ProtectedArea $protected_area = null)
    {
        $protected_area = $protected_area ?? ProtectedArea::inRandomOrder()->first();

        $form_id = Imet\v2\Imet::insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years', 'now')->format('Y'),
            'version' => Imet\v2\Imet::version,
            'language' => collect(['en', 'fr', 'sp', 'pt'])->random(),
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now(),
            'UpdateBy' => 0,
        ]);

        static::seedFormModules($form_id);
    }

    /**
     * Populate all the form's modules with fake data
     * @throws Exception
     */
    private static function seedFormModules(int $form_id): void
    {
        $modules = array_merge(
            Imet\v2\Imet::allModules(),
            Imet\v2\Imet_Eval::allModules()
        );

        foreach ($modules as $module){
            $module_type = (new $module)->module_type;
            $num_records = (Str::contains($module_type, 'TABLE') || Str::contains($module_type, 'ACCORDION'))
                ? 4
                : 1;

            if(Str::contains($module_type, 'GROUP')){
                foreach (collect((new $module)->module_groups)->keys() as $group_key){
                    for($y=1; $y<=$num_records; $y++){
                        static::insertRecord($module, $form_id, $group_key);
                    }
                }
            } else {
                for($y=1; $y<=$num_records; $y++){
                    static::insertRecord($module, $form_id);
                }
            }

        }
    }

    /**
     * Insert a record in the given module
     * @throws Exception
     */
    private static function insertRecord(string $module, int $form_id, ?string $group_key = null): void
    {
        $values = [
            'FormID' => $form_id,
            'UpdateDate' => now(),
            'UpdateBy' => 0,
        ];

        // Inject predefined values
        /** @var $module Module */
        $predefined = $module::getPredefined($form_id);
        if($predefined!==null){
            $values[$predefined['field']] =
                $predefined['values']!==null && count($predefined['values']) > 0
                    ? (
                Str::contains((new $module)->module_type, 'GROUP')
                    ? collect(collect($predefined['values'])->random())->random()
                    : collect($predefined['values'])->random()
                )
                    : null;
        }

        // Generate fake values (fields)
        foreach((new $module)->module_fields as $field){
            if(!array_key_exists($field['name'], $values)){
                $values[$field['name']] = self::fakeValueByType($field['type']);
            }
        }

        // Generate fake values (common_fields)
        if((new $module)->module_common_fields!==null) {
            foreach ((new $module)->module_common_fields as $field) {
                if (!array_key_exists($field['name'], $values)) {
                    $values[$field['name']] = self::fakeValueByType($field['type']);
                }
            }
        }

        // Add $group_key if required
        if($group_key!==null){
            $values[$module::$group_key_field] = $group_key;
        }

        // IMET: force IncludeInStatistics to true
        if(array_key_exists('IncludeInStatistics', $values)){
            $values['IncludeInStatistics'] = '1';
        }

        $module::insert($values);
    }

    /**
     * Generate a fake value for a given field type
     * @throws Exception
     */
    private static function fakeValueByType(string $type): mixed
    {
        // CUSTOM
        if(Str::contains($type, '_EcosystemServicesImportance')){
            return collect([0, 1])->random();
        }

        // Standard
        if ($type === 'text') {
            return fake()->words(3);
        } elseif ($type === 'textarea' || $type === 'text-area') {
            return fake()->words(4, true);
        } elseif ($type === "url") {
            return fake()->url;
        } elseif ($type === "email") {
            return fake()->email;
        } elseif ($type === "password") {
            return fake()->password;
        } elseif ($type === "integer"
            || $type === "code"
            || $type === "numeric") {
            return fake()->randomNumber(4);
        } elseif ($type === "float"
            || $type === "currency") {
            return fake()->randomFloat(2);
        } elseif ($type === "date") {
            return fake()->date;
        } elseif ($type === "dateMaxToday") {
            return fake()->dateTimeBetween('-4 years', 'now');
        } elseif ($type === "year") {
            return fake()->year;
        } elseif ($type === "yearMaxCurrent"
            || $type === "yearMaxPrev") {
            return fake()->dateTimeBetween('-4 years', '-1 year')->format('Y');
        } elseif (Str::contains($type, '-boolean')) {
            $values = Str::contains($type, 'numeric')
                ? [0, 1]
                : ['0', '1'];
            return collect($values)->random();
        } elseif (Str::contains($type, 'yes_no')) {
            return collect(['true', 'false'])->random();
        } elseif (Str::contains($type, 'dropdown')
            || Str::contains($type, 'suggestion')
            || Str::contains($type, 'toggle')
            || Str::contains($type, 'checkbox')
            || Str::contains($type, 'currency-unit')
        ){
            $list_type = SelectionList::getListType($type);
            $cached_list = SelectionList::CacheListInSession($list_type);
            return collect($cached_list)
                ->keys()
                ->random(Str::contains($type, 'multiple') ? rand(2, 4) : null);
        } elseif (Str::contains($type, 'rating')){
            $values = [];
            $rating_type = last(explode('-', $type));
            if(Str::contains($rating_type, 'WithNA')){
                $values[] = '-99';
                $rating_type = Str::replace('WithNA', '', $rating_type);
            }
            [$min, $max] = explode('to', $rating_type);
            if(Str::contains($min, 'Minus')){
                $min = Str::replace('Minus', '-', $min);
            }
            $min = intval($min);
            $max = intval($max);
            $values = array_merge($values, range($min, $max));
            return collect($values)->random();
        }

        elseif (Str::contains($type, "selector-species")) {
            $species = Species::inRandomOrder()->first();
            return $species->phylum
                . '|' . $species->class
                . '|' . $species->order
                . '|' . $species->family
                . '|' . $species->genus
                . '|' . $species->species;

        } elseif (Str::contains($type, "selector-wdpa")){
            if(Str::contains($type, 'multiple')){
                return implode(',', ProtectedArea::inRandomOrder()->limit(rand(2,5))->get()->pluck('wdpa_id')->toArray());
            }
            return ProtectedArea::inRandomOrder()->first()->wdpa_id;
        }

        return null;
    }

}
