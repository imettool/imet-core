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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ImetCore\Helpers\SelectionList as ImetSelectionList;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use Log;
use ModularForms\Helpers\Input\SelectionList;
use ModularForms\Models\Module;

class FormSeeder
{

    /**
     * Create a new form (IMETV 2) for the given (or random) protected area and populate it with fake data
     * @throws Exception
     */
    public static function seedFormImetV2(ProtectedArea $protected_area, string $language): void
    {
        $form_id = Imet\v2\Imet::insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years', 'now')->format('Y'),
            'version' => Imet\v2\Imet::version,
            'language' => $language,
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);

        $modules = array_merge(
            Imet\v2\Imet::allModules(),
            Imet\v2\Imet_Eval::allModules()
        );

        static::seedFormModules($form_id, $modules);
    }

    /**
     * Create a new form (IMET OECM) for the given (or random) protected area and populate it with fake data
     * @throws Exception
     */
    public static function seedFormImetOecm(ProtectedArea $protected_area, string $language): void
    {
        $form_id = Imet\oecm\Imet::insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years', 'now')->format('Y'),
            'version' => Imet\oecm\Imet::version,
            'language' => $language,
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);

        $modules = array_merge(
            Imet\oecm\Imet::allModules(),
            Imet\oecm\Imet_Eval::allModules()
        );

        static::seedFormModules($form_id, $modules);
    }

    /**
     * Populate all the form's modules with fake data
     * @throws Exception
     */
    private static function seedFormModules(int $form_id, array $modules): void
    {
        foreach ($modules as $module){
            $module_type = (new $module)->module_type;
            $num_records = (Str::contains($module_type, 'TABLE') || Str::contains($module_type, 'ACCORDION'))
                ? 4
                : 1;

            $records = [];

            if (Str::contains($module_type, 'GROUP')) {
                foreach (collect((new $module)->module_groups)->keys() as $group_key) {
                    for ($y = 1; $y <= $num_records; $y++) {
                        $records[] = static::createRecord($module, $form_id, $group_key);
                    }
                }
            } else {
                for ($y = 1; $y <= $num_records; $y++) {
                    $records[] = static::createRecord($module, $form_id);
                }
            }

            try {

                DB::table((new $module)->getTable())->insert($records);

            } catch (Exception $e){
                dump($records);
                Log::critical('Seed failed at module: ' . $module, ['module' => $module, 'records' => $records]);
                throw $e;
            }

        }
    }

    /**
     * Insert a record in the given module
     * @throws Exception
     */
    private static function createRecord(string $module, int $form_id, ?string $group_key = null): array
    {
        $values = [
            'FormID' => $form_id,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ];

        // Inject predefined values
        /** @var $module Module */
        $predefined = $module::getPredefined($form_id);
        if($predefined!==null){
            $values[$predefined['field']] = null;
            if($predefined['values']!==null && count($predefined['values']) > 0){
                if(Str::contains((new $module)->module_type, 'GROUP')){
                    $random_predefined_value
                        = array_key_exists($group_key, $predefined['values'])
                            && count($predefined['values'][$group_key])>0
                        ? collect($predefined['values'][$group_key])->random()
                        : null;
                } else {
                    $random_predefined_value = collect($predefined['values'])->random();
                }
                if($random_predefined_value !== null){
                    $values[$predefined['field']] = $random_predefined_value;
                }
            }
        }

        // Generate fake values (fields)
        foreach((new $module)->module_fields as $field){
            if(!array_key_exists($field['name'], $values)){
                $values[$field['name']] = self::fakeValueByType($field['type'], $field['name'], $module, $form_id, $group_key);
            }
        }

        // Generate fake values (common_fields)
        if((new $module)->module_common_fields!==null) {
            foreach ((new $module)->module_common_fields as $field) {
                if (!array_key_exists($field['name'], $values)) {
                    $values[$field['name']] = self::fakeValueByType($field['type'], $field['name'], $module, $form_id, $group_key);
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

        return $values;
    }

    /**
     * Generate a fake value for a given field type
     * @throws Exception
     */
    private static function fakeValueByType(string $type, string $name, string $module, int $form_id, ?string $group_key): mixed
    {
        // CUSTOM
        if(Str::contains($type, 'ctx11_type')){
            return array_rand(ImetSelectionList::getCustomList('Imet_PaType'));
        } else
        if(Str::contains($type, '_EcosystemServicesImportance')){
            return collect([0, 1])->random();
        }
        else if (Str::contains($type, '.SubGovernanceModel')
            && Str::contains(Str::lower($type), 'oecm')) {
            $list = SelectionList::getList('ImetOECM_SubGovernanceModel');
            $random_group = collect($list)->random();
            return collect($random_group)->random();
        }
        else if(Str::contains($type, 'ImetOECM_AnalysisStakeholders')) {
            $group_key = array_rand(trans('imet-core::oecm_context.AnalysisStakeholders.lists'));
            $list = trans('imet-core::oecm_context.AnalysisStakeholders.lists.' . $group_key);
            $list = array_combine($list, $list);
            return collect($list)->random();
        }
        else if($name === 'Stakeholder' && $type === 'hidden' && Str::contains($module, 'AnalysisStakeholder')){
            $list = Imet\oecm\Modules\Context\Stakeholders::getStakeholders($form_id);
            return collect($list)->random();
        }
        else if(Str::contains($module, 'SupportsAndConstraintsIntegration') && $name === 'Stakeholder'){
            if($group_key === 'group0'){
                return collect(Imet\oecm\Modules\Context\Stakeholders::getStakeholders($form_id, Imet\oecm\Modules\Context\Stakeholders::ONLY_DIRECT))
                    ->random();
            } elseif($group_key === 'group1'){
                return collect(Imet\oecm\Modules\Context\Stakeholders::getStakeholders($form_id, Imet\oecm\Modules\Context\Stakeholders::ONLY_INDIRECT))
                    ->random();
            }
        }
        else if(Str::contains($module, 'KeyElements') && $name === 'Aspect'){
            if($group_key === 'group0'){
                $key_elements = collect(Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id))
                    ->keyBy('element');
                return $key_elements->keys()->random();
            } elseif($group_key === 'group1'){
                $biodiversity_key_elements =  collect(Imet\oecm\Modules\Evaluation\ThreatsBiodiversity::calculateRanking($form_id))
                    ->sortBy('_score');
                return $biodiversity_key_elements->pluck('Criteria')->random();
            }
        }

        // Standard
        if ($type === 'text') {
            return fake()->words(3, true);
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
