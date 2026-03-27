<?php

namespace ImetCore\Helpers\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use ImetCore\Helpers\SelectionList;
use ImetCore\Helpers\SelectionList as ImetSelectionList;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\Species;
use ModularForms\Models\Module;
use Throwable;

class FormSeeder extends Seeder
{
    use WithoutModelEvents;

    const int NUM_FORMS = 5;

    /**
     * Run the database seeders.
     *
     * @throws Throwable
     */
    public function run(string $version, ?int $num = self::NUM_FORMS): void
    {
        for ($i = 1; $i <= $num; $i++) {
            $language = collect(['en', 'fr', 'sp', 'pt'])->random();
            $pa = ProtectedArea::query()->inRandomOrder()->first();
            App::setLocale($language);
            if ($version === Imet\Imet::IMET_V1) {
                static::seedFormImetV1($pa, $language);
            } elseif ($version === Imet\Imet::IMET_V2) {
                static::seedFormImetV2($pa, $language);
            } elseif ($version === Imet\Imet::IMET_OECM) {
                static::seedFormImetOecm($pa, $language);
            }
        }
    }

    /**
     * Create a new form (IMETV 1) for the given (or random) protected area and populate it with fake data
     *
     * @throws Throwable
     */
    public static function seedFormImetV1(ProtectedArea $protected_area, string $language): void
    {
        $form_id = Imet\ImetV1\Imet::query()->insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years')->format('Y'),
            'version' => Imet\ImetV1\Imet::$version,
            'language' => $language,
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);

        $modules = array_merge(
            Imet\ImetV1\Imet::allModules(),
            Imet\ImetV1\Imet_Eval::allModules()
        );

        self::seedFormModules($form_id, $modules);
    }

    /**
     * Create a new form (IMETV 2) for the given (or random) protected area and populate it with fake data
     *
     * @throws Throwable
     */
    public static function seedFormImetV2(ProtectedArea $protected_area, string $language): void
    {
        $form_id = Imet\ImetV2\Imet::query()->insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years')->format('Y'),
            'version' => Imet\ImetV2\Imet::$version,
            'language' => $language,
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);

        $modules = array_merge(
            Imet\ImetV2\Imet::allModules(),
            Imet\ImetV2\Imet_Eval::allModules()
        );

        self::seedFormModules($form_id, $modules);
    }

    /**
     * Create a new form (IMET OECM) for the given (or random) protected area and populate it with fake data
     *
     * @throws Throwable
     */
    public static function seedFormImetOecm(ProtectedArea $protected_area, string $language): void
    {
        $form_id = Imet\ImetOecm\Imet::query()->insertGetId([
            'Country' => $protected_area->country,
            'Year' => fake()->dateTimeBetween('-4 years')->format('Y'),
            'version' => Imet\ImetOecm\Imet::$version,
            'language' => $language,
            'wdpa_id' => $protected_area->wdpa_id,
            'name' => $protected_area->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);

        $modules = array_merge(
            Imet\ImetOecm\Imet::allModules(),
            Imet\ImetOecm\Imet_Eval::allModules()
        );

        self::seedFormModules($form_id, $modules);
    }

    /**
     * Populate all the form's modules with fake data
     *
     * @throws Throwable
     */
    private static function seedFormModules(int $form_id, array $modules): void
    {
        foreach ($modules as $module) {
            $module_type = (new $module)->module_type;
            $num_records = (Str::contains($module_type, 'TABLE') || Str::contains($module_type, 'ACCORDION'))
                ? 4
                : 1;

            $records = [];

            if (Str::contains($module_type, 'GROUP')) {
                foreach (collect((new $module)->module_groups)->keys() as $group_key) {
                    for ($y = 1; $y <= $num_records; $y++) {
                        $records[] = self::createRecord($module, $form_id, $group_key);
                    }
                }
            } else {
                for ($y = 1; $y <= $num_records; $y++) {
                    $records[] = self::createRecord($module, $form_id);
                }
            }

            try {

                DB::table((new $module)->getTable())->insert($records);

            } catch (Exception $e) {
                dump($records);
                Log::critical('Seed failed at module: '.$module, ['module' => $module, 'records' => $records]);
                throw $e;
            }

        }
    }

    /**
     * Insert a record in the given module
     *
     * @param  class-string<Module>  $module
     *
     * @throws Throwable
     */
    private static function createRecord(string $module, int $form_id, ?string $group_key = null): array
    {
        $values = [
            'FormID' => $form_id,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ];

        // Inject predefined values
        $predefined = $module::getPredefined($form_id);
        if ($predefined !== null) {
            $values[$predefined['field']] = null;
            if ($predefined['values'] !== null && count($predefined['values']) > 0) {
                if (Str::contains((new $module)->module_type, 'GROUP')) {
                    $random_predefined_value
                        = array_key_exists($group_key, $predefined['values'])
                    && count($predefined['values'][$group_key]) > 0
                        ? collect($predefined['values'][$group_key])->random()
                        : null;
                } else {
                    $random_predefined_value = collect($predefined['values'])->random();
                }

                if ($random_predefined_value !== null) {
                    $values[$predefined['field']] = $random_predefined_value;
                }
            }
        }

        // Generate fake values (fields)
        foreach ((new $module)->module_fields as $field) {
            if (! array_key_exists($field['name'], $values)) {
                $values[$field['name']] = self::fakeValueByType($field['type'], $field['name'], $module, $form_id, $group_key);
            }
        }

        // Generate fake values (common_fields)
        if ((new $module)->module_common_fields !== null) {
            foreach ((new $module)->module_common_fields as $field) {
                if (! array_key_exists($field['name'], $values)) {
                    $values[$field['name']] = self::fakeValueByType($field['type'], $field['name'], $module, $form_id, $group_key);
                }
            }
        }

        // Add $group_key if required
        if ($group_key !== null) {
            $values[$module::$group_key_field] = $group_key;
        }

        // IMET: force IncludeInStatistics to true
        if (array_key_exists('IncludeInStatistics', $values)) {
            $values['IncludeInStatistics'] = '1';
        }

        return $values;
    }

    /**
     * Generate a fake value for a given field type
     *
     * @throws Throwable
     */
    private static function fakeValueByType(string $type, string $name, string $module, int $form_id, ?string $group_key): mixed
    {
        // CUSTOM

        if (Str::contains($type, 'ctx11_type')) {
            return array_rand(ImetSelectionList::getList('Imet_PaType'));
        }

        if (Str::contains($type, '_EcosystemServicesImportance')) {
            return collect([0, 1])->random();
        }

        if (Str::contains($type, '.SubGovernanceModel')
            && (Str::contains(Str::lower($type), 'v2')
                || Str::contains(Str::lower($type), 'oecm'))) {
            $list = Str::contains(Str::lower($type), 'v2')
                ? SelectionList::getList('ImetV2_SubGovernanceModel')
                : SelectionList::getList('ImetOECM_SubGovernanceModel');
            $random_group = collect($list)->random();

            return collect($random_group)->random();
        }

        if (Str::contains($type, 'ImetOECM_AnalysisStakeholders')) {
            $group_key = array_rand(trans('imet-core::oecm_context.AnalysisStakeholders.lists'));
            $list = trans('imet-core::oecm_context.AnalysisStakeholders.lists.'.$group_key);
            $list = array_combine($list, $list);

            return collect($list)->random();
        }

        if ($name === 'Stakeholder' && $type === 'hidden' && Str::contains($module, 'AnalysisStakeholder')) {
            $list = Imet\ImetOecm\Modules\Context\Stakeholders::getStakeholders($form_id);

            return collect($list)->random();
        }

        if (Str::contains($module, 'SupportsAndConstraintsIntegration') && $name === 'Stakeholder') {
            if ($group_key === 'group0') {
                return collect(Imet\ImetOecm\Modules\Context\Stakeholders::getStakeholders($form_id, Imet\ImetOecm\Modules\Context\Stakeholders::ONLY_DIRECT))
                    ->random();
            }

            if ($group_key === 'group1') {
                return collect(Imet\ImetOecm\Modules\Context\Stakeholders::getStakeholders($form_id, Imet\ImetOecm\Modules\Context\Stakeholders::ONLY_INDIRECT))
                    ->random();
            }
        } elseif (Str::contains($module, 'KeyElements') && $name === 'Aspect') {
            if ($group_key === 'group0') {
                $key_elements = collect(Imet\ImetOecm\Modules\Context\AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id))
                    ->keyBy('element');

                return $key_elements->keys()->random();
            }

            if ($group_key === 'group1') {
                $biodiversity_key_elements = collect(Imet\ImetOecm\Modules\Evaluation\ThreatsBiodiversity::calculateRanking($form_id))
                    ->sortBy('_score');

                return $biodiversity_key_elements->pluck('Criteria')->random();
            }
        }

        // Standard
        if ($type === 'text') {
            return fake()->words(3, true);
        }

        if ($type === 'textarea' || $type === 'text-area') {
            return fake()->words(4, true);
        }

        if ($type === 'url') {
            return fake()->url();
        }

        if ($type === 'email') {
            return fake()->email();
        }

        if ($type === 'password') {
            return fake()->password();
        }

        if (in_array($type, ['integer', 'code', 'numeric'], true)) {
            return fake()->randomNumber(4);
        }

        if ($type === 'float'
            || $type === 'currency') {
            return fake()->randomFloat(2);
        }

        if ($type === 'date') {
            return fake()->date();
        }

        if ($type === 'dateMaxToday') {
            return fake()->dateTimeBetween('-4 years');
        }

        if ($type === 'year') {
            return fake()->year();
        }

        if ($type === 'yearMaxCurrent'
            || $type === 'yearMaxPrev') {
            return fake()->dateTimeBetween('-4 years', '-1 year')->format('Y');
        }

        if (Str::contains($type, '-boolean')) {
            $values = Str::contains($type, 'numeric')
                ? [0, 1]
                : ['0', '1'];

            return collect($values)->random();
        }

        if (Str::contains($type, 'yes_no')) {
            return collect(['true', 'false'])->random();
        }

        if (Str::contains($type, 'dropdown')
            || Str::contains($type, 'suggestion')
            || Str::contains($type, 'toggle')
            || Str::contains($type, 'checkbox')
            || Str::contains($type, 'currency-unit')) {
            $list_type = SelectionList::getListType($type);
            $cached_list = SelectionList::CacheListInSession($list_type);

            return collect($cached_list)
                ->keys()
                ->random(Str::contains($type, 'multiple') ? random_int(2, 4) : null);
        }

        if (Str::contains($type, 'rating')) {
            $values = [];
            $rating_type = last(explode('-', $type));
            if (Str::contains($rating_type, 'WithNA')) {
                $values[] = '-99';
                $rating_type = Str::replace('WithNA', '', $rating_type);
            }

            [$min, $max] = explode('to', (string) $rating_type);
            if (Str::contains($min, 'Minus')) {
                $min = Str::replace('Minus', '-', $min);
            }

            $min = intval($min);
            $max = intval($max);
            $values = array_merge($values, range($min, $max));

            return collect($values)->random();
        }

        if (Str::contains($type, 'selector-species')) {
            $species = Species::query()->inRandomOrder()->first();

            return $species->phylum
                .'|'.$species->class
                .'|'.$species->order
                .'|'.$species->family
                .'|'.$species->genus
                .'|'.$species->species;
        }

        if (Str::contains($type, 'selector-wdpa')) {
            if (Str::contains($type, 'multiple')) {
                return implode(',', ProtectedArea::query()->inRandomOrder()->limit(random_int(2, 5))->get()->pluck('wdpa_id')->toArray());
            }

            return ProtectedArea::query()->inRandomOrder()->first()->wdpa_id;
        }

        return null;
    }
}
