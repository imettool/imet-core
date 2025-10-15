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

namespace ImetCore\Models\Imet;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HigherOrderCollectionProxy;
use Illuminate\Support\Str;
use ImetCore\Controllers\Imet\Controller;
use ImetCore\Helpers\Database;
use ImetCore\Models\Country;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Models\User\Role;
use ImetCore\Services\Scores\ImetScores;
use ModularForms\Helpers\Type\Chars;
use ModularForms\Models\Form;

use function session;

/**
 * Class Imet
 *
 * @property string $Country
 * @property string $FormID
 * @property string $language
 * @property string $name
 * @property string $version
 * @property string $wdpa_id
 * @property string $Year
 */
abstract class Imet extends Form
{
    const IMET_V1 = 'v1';

    const IMET_V2 = 'v2';

    const IMET_OECM = 'oecm';

    protected static ?string $schema = null;

    protected $table = 'forms';

    protected $primaryKey = 'FormID';

    public const CREATED_AT = 'UpdateDate';

    public const UPDATED_AT = 'UpdateDate';

    public const UPDATED_BY = 'UpdateBy';

    public static $sortBy = 'Year';

    public static $sortDirection = 'desc';

    public static ?array $modules = [];

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, $this->table);
    }

    /**
     * Relation to Country
     */
    public function country(): hasOne
    {
        return $this->hasOne(Country::class, 'iso3', 'Country');
    }

    /**
     * Mutator: ensure to retrieve in lowercase
     */
    public function getLanguageAttribute($value): string
    {
        return strtolower($value);
    }

    /**
     * Retrieve the IMET assessments list (clean, without statistics):  V1 & v2 merged
     */
    public static function get_assessments_list(Request $request, array $relations = [], bool $only_allowed_wdpas = false, array $countries = []): Collection
    {
        $allowed_wdpas = $only_allowed_wdpas
            ? Role::allowedWdpas()
            : null;

        $list_v1 = v1\Imet::query()
            ->filterList($request->all())
            ->with($relations)
            ->where(function ($query) use ($allowed_wdpas, $countries): void {
                if ($allowed_wdpas !== null) {
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }

                if ($countries !== []) {
                    $query->whereIn('Country', $countries);
                }
            })
            ->get()
            // Replacement for PostgreSQL unaccent() function
            ->filter(function (v1\Imet $item) use ($request): bool {
                if ($request->filled('search')) {
                    if (Chars::case_and_accent_insensitive_contains($item['name'], $request->input('search'))) {
                        return true;
                    }

                    return Str::contains($item['wdpa_id'], $request->input('search'));
                }

                return true;
            });

        $list_v2 = v2\Imet::query()
            ->filterList($request->all())
            ->with($relations)
            ->where(function ($query) use ($allowed_wdpas, $countries): void {
                if ($allowed_wdpas !== null) {
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }

                if ($countries !== []) {
                    $query->whereIn('Country', $countries);
                }
            })
            ->get()
            // Replacement for PostgreSQL unaccent() function
            ->filter(function (v2\Imet $item) use ($request): bool {
                if ($request->filled('search')) {
                    if (Chars::case_and_accent_insensitive_contains($item['name'], $request->input('search'))) {
                        return true;
                    }

                    return Str::contains($item['wdpa_id'], $request->input('search'));
                }

                return true;
            });

        return $list_v1->merge($list_v2);
    }

    /**
     * Retrieve the IMET assessments list with extra information (ex. responsible, statistics, and duplicates) for INDEX controller
     *
     * @return mixed
     */
    public static function get_assessments_list_with_extras(Request $request)
    {
        $hasDuplicates = static::foundDuplicates();

        return static::get_assessments_list($request, ['country', 'encoder', 'responsible_interviewees', 'responsible_interviewers'], true)
            ->map(function ($item) use ($hasDuplicates): \Illuminate\Database\Eloquent\Model {

                // Add encoders
                $item->encoders_responsibles = [
                    'encoders' => array_values($item->encoder->flatten()->unique()->toArray()),
                    'internal' => array_values($item->responsible_interviewers->flatten()->unique()->toArray()),
                    'external' => array_values($item->responsible_interviewees->flatten()->unique()->toArray()),
                ];

                // Add radar
                $item['assessment_radar'] = ImetScores::get_radar($item, true);

                // Non WDPA
                if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
                    $item->wdpa_id = null;
                }

                // Last IMET update
                $item['last_update'] = $item->getLastUpdate();

                // has duplicates
                $item['has_duplicates'] = in_array($item->getKey(), $hasDuplicates);

                return $item;
            })
            ->makeHidden(['encoder', 'responsible_interviewees', 'responsible_interviewers']);
    }

    /**
     * Common search filters with wdpa
     *
     * @param  Builder<static>  $query
     * @param  array<string, scalar>  $params
     */
    #[Scope]
    public function commonSearchWithWdpa(Builder $query, array $params): void
    {
        $this->commonFilters($query, $params);
        if (array_key_exists('wdpa', $params) && $params['wdpa'] !== null) {
            $query->where('wdpa_id', $params['wdpa']);
        }
    }

    /**
     * Common method to use it in various searches queries
     *
     * @param  Builder<static>  $query
     * @param  array<string, scalar>  $params
     */
    #[Scope]
    private function commonFilters(Builder $query, array $params): void
    {
        if (array_key_exists('country', $params) && $params['country'] !== null) {
            $query->where('Country', $params['country']);
        }

        if (array_key_exists('year', $params) && $params['year'] !== null) {
            $query->where('Year', $params['year']);
        }

        if (array_key_exists('wdpa_id', $params) && $params['wdpa_id'] !== null) {
            $query->where('wdpa_id', $params['wdpa_id']);
        }
    }

    /**
     * Override filterList()
     *
     * @
     */
    #[Scope]
    public function filterList(Builder $query, array $params): void
    {
        // filters
        $this->commonFilters($query, $params);
        $query->where('version', static::version);

        // sort
        $query->orderBy(static::$sortBy, static::$sortDirection)
            ->orderBy('name', 'desc');
    }

    /**
     * Check and add missing Pa data (country, wdpa_id, pa_name) to form
     */
    public static function checkMissingPaData(): void
    {
        static::query()->where('Country', null)
            ->orWhere('wdpa_id', null)
            ->orWhere('name', null)
            ->get()
            ->map(function ($imet): void {
                /** @var Imet $imet */
                $pa = ProtectedAreaNonWdpa::isNonWdpa($imet->wdpa_id)
                    ? \ImetCore\Models\ProtectedAreaNonWdpa::query()->find($imet->wdpa_id)
                    : ProtectedArea::getByWdpa($imet->wdpa_id);
                $imet->Country = $pa->country;
                $imet->name = $pa->name;
                $imet->save();
            });
    }

    /**
     * Retrieve form language
     *
     * @return mixed
     */
    public static function getLanguage(string $form_id)
    {
        $session_key = 'imet_language_'.$form_id;
        $language = session($session_key, null);
        if ($language === null || $language === '') {
            $language = strtolower(static::query()->find($form_id)->language);
            session([$session_key => $language]);
        }

        return $language;
    }

    /**
     * Retrieve the IMET responsible
     */
    public static function getResponsibles($form_id, $version): array
    {
        $internal = $version === static::IMET_V1
            ? v1\Modules\Context\ResponsablesInterviewers::getNames($form_id)
            : v2\Modules\Context\ResponsablesInterviewers::getNames($form_id);
        $external = $version === static::IMET_V1
            ? v1\Modules\Context\ResponsablesInterviewees::getNames($form_id)
            : v2\Modules\Context\ResponsablesInterviewees::getNames($form_id);
        $encoders = $version === static::IMET_V1
            ? v1\Encoder::getNames($form_id)
            : v2\Encoder::getNames($form_id);

        return [
            'encoders' => $encoders,
            'internal' => $internal,
            'external' => $external,
        ];
    }

    /**
     * Retrieve the IMET version
     *
     * @return HigherOrderCollectionProxy|mixed|string|null
     */
    public static function getVersion($form_id)
    {
        $form = static::query()->find($form_id);

        return $form ? $form->version : null;
    }

    /**
     * Retrieve specific fields and return them in different arrays in an array
     *
     * @param  string[]  $fields
     */
    public static function getFieldsSplitToArrays(array $fields = ['Country', 'Year', 'wdpa_id', 'FormID']): array
    {

        $getRecords = static::query()->select($fields)
            ->distinct()
            ->get()
            ->toArray();

        $records = [];
        foreach ($getRecords as $field) {
            foreach ($fields as $f) {
                $records[$f][$field[$f]] = $field[$f];
            }
        }

        return $records;
    }

    /**
     * Retrieve an array of distinct values for the given field
     */
    private static function getDistinctField(string $field): array
    {
        return static::query()->select($field)
            ->distinct()
            ->orderBy($field)
            ->get()
            ->pluck($field)
            ->toArray();
    }

    /**
     * @deprecated
     * Retrieve years for existing IMETs
     */
    public static function getAvailableYears(): array
    {
        return static::getDistinctField('Year');
    }

    /**
     * Retrieve protected area data
     *
     * @return ProtectedAreaNonWdpa|ProtectedArea
     */
    public static function getProtectedArea($wdpa_id)
    {
        if (ProtectedAreaNonWdpa::isNonWdpa($wdpa_id)) {
            $pa = \ImetCore\Models\ProtectedAreaNonWdpa::query()->find($wdpa_id);
            $pa->wdpa_id = $pa->id;
            $pa->Type = null;
            $pa->iucn_category = null;
            $pa->creation_date = $pa->creation_date ?? null;
        } else {
            $pa = ProtectedArea::getByWdpa($wdpa_id);
        }

        return $pa;
    }

    /**
     * Import form from array
     *
     * @return array
     */
    public static function importForm(array $data): int
    {
        if (! array_key_exists('wdpa_id', $data) || $data['wdpa_id'] === null) {
            $pa = ProtectedArea::getByGlobalId($data['protected_area_global_id']);
        } else {
            $pa = static::getProtectedArea($data['wdpa_id']);
        }

        unset($data['Type']);
        unset($data['protected_area_global_id']);
        unset($data['imet_version']);
        unset($data['db_version']);
        unset($data['region']);
        unset($data['FormID']);

        $form = new static($data);
        $form->fill($data);
        $form->name = $pa->name;
        $form->wdpa_id = $pa->wdpa_id;
        $form->Country = $pa->country;
        $form->save();

        return $form->getKey();
    }

    /**
     * Import all modules from records array
     *
     * @throws FileNotFoundException
     */
    #[\Override]
    public static function importModules($records, $formID, $imet_version = null): array
    {
        $records = static::upgradeModules($records, $imet_version);
        $modules_imported = [];
        /** @var v2\Modules\Component\ImetModule|v2\Modules\Component\ImetModule_Eval $module_class */
        foreach (static::allModules() as $module_class) {
            if (array_key_exists($module_class::getShortClassName(), $records)) {
                $modules_imported[] = $module_class::getShortClassName();
                foreach ($records[$module_class::getShortClassName()] as $record) {
                    $module_class::importModule($formID, $record);
                }
            }
        }

        return $modules_imported;
    }

    /**
     * Upgrade modules from previous versions
     */
    public static function upgradeModules(array $data, $imet_version = null): array
    {
        $upgraded_data = [];
        /** @var v2\Modules\Component\ImetModule|v2\Modules\Component\ImetModule_Eval $module_class */
        foreach (static::allModules() as $module_class) {
            if (array_key_exists($module_class::getShortClassName(), $data)) {
                $upgraded_data[$module_class::getShortClassName()]
                    = $module_class::upgradeModuleRecords($data[$module_class::getShortClassName()], $imet_version);
            }
        }

        return $upgraded_data;
    }

    /**
     * Generate a filename for exporting form
     */
    public function filename(string $extension): string
    {
        $name = Chars::clean(Chars::replaceAccents($this->name));
        $now = Date::now()->format('Y-m-d');

        $wdpa_id = ProtectedAreaNonWdpa::isNonWdpa($this->wdpa_id) ? '' : '_'.$this->wdpa_id;

        return 'IMET'.
            $wdpa_id.
            '-'.$this->Year.
            '-'.$name.
            '-'.$this->FormID.
            '_'.$now.
            '.'.$extension;
    }

    /**
     * Get the list of duplicates IMETs (same PA and year)
     */
    public function getDuplicates(): array
    {
        $query = static::query()->select('FormID')
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->where('version', $this->version)
            ->where('Year', $this->Year)
            ->where('wdpa_id', $this->wdpa_id);

        return $query->get()->pluck('FormID')->toArray();
    }

    /**
     *  Get the list of IMET ids which have duplicates (same PA and year)
     */
    public static function foundDuplicates(): array
    {
        $table = (new static)->getTable();

        $duplicates_query = static::query()->select('Year', 'wdpa_id', 'version', DB::raw('COUNT(*) as count'))
            ->groupBy('Year', 'wdpa_id', 'version')
            ->having(DB::raw('COUNT(*)'), '>', 1);

        return static::query()->joinSub($duplicates_query, 'dp', function (JoinClause $join) use ($table): void {
            $join->on($table.'.Year', '=', 'dp.Year')
                ->on($table.'.wdpa_id', '=', 'dp.wdpa_id')
                ->on($table.'.version', '=', 'dp.version');
        })
            ->pluck($table.'.FormID')
            ->toArray();
    }

    /**
     * Return array keys of modules
     */
    public static function getModulesKeys(): array
    {
        return array_keys(static::$modules);
    }

    /**
     * @deprecated Replace with get_assessments_list()
     *
     * @return mixed
     */
    protected static function retrieve_list(Request $request, array $relations = [])
    {
        return static::get_assessments_list($request, $relations);
    }

    /**
     * @deprecated Replace with get_assessments_list_with_extras()
     *
     * @return mixed
     */
    protected static function get_list(Request $request)
    {
        return static::get_assessments_list_with_extras($request);
    }
}
