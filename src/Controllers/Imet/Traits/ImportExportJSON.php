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

namespace ImetCore\Controllers\Imet\Traits;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ImetCore\Controllers;
use ImetCore\Exceptions\UnrecognizedVersionException;
use ImetCore\Helpers\ImetEnv;
use ImetCore\Models\Country;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Services\Scores\ImetScores;
use ImetCore\Services\Scores\OecmScores;
use ModularForms\Helpers\File\File;
use ModularForms\Helpers\File\Zip;
use ModularForms\Helpers\HTTP;
use ModularForms\Helpers\Module;
use ModularForms\Helpers\ModuleKey;
use ModularForms\Models\Traits\Upload;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

use function report;
use function trans;

trait ImportExportJSON
{
    use Upload;

    /**
     * Upload a JSON file and import the IMET
     *
     * @throws Throwable
     */
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $ext = $file->extension();
        $files = [];

        try {
            // upload file
            $uploaded = static::uploadFile($file);
            // and then check if is zip or json
            if ($ext == 'zip') {
                $uploaded_path = Storage::disk(File::TEMP_STORAGE)->path($uploaded['temp_filename']);
                $extractFiles = Zip::extract($uploaded_path);
                $num_extracted = 0;
                foreach ($extractFiles as $item) {
                    if (Str::endsWith($item, '.json') && $num_extracted < 10) {
                        $json = json_decode(static::getUploadFileContent($item), true);
                        $files[] = (new (static::class))->import(new Request, $json, false);
                        Storage::disk(File::TEMP_STORAGE)->delete($item);
                        $num_extracted++;
                    }
                }
            } else {
                $json = json_decode(static::getUploadFileContent($uploaded['temp_filename']), true);
                $files[] = (new (static::class))->import(new Request, $json, false);
                Storage::disk(File::TEMP_STORAGE)->delete($uploaded['temp_filename']);
            }

            if ($files === [] || (count($files) === 1 && isset($files[0]) && $files[0]['status'] === 'error')) {
                return new JsonResponse(['message' => trans('modular-forms::common.upload.no_files_found')], 500);
            }
        } catch (Exception $exception) {
            report($exception);

            return new JsonResponse(['message' => $exception->getMessage()], 500);
        }

        return new JsonResponse($files);
    }

    /**
     * return a list of Imet's for export in json/zip
     *
     * @throws AuthorizationException|Throwable
     */
    public function export_view(Request $request): View
    {
        $this->authorize('exportAll', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        /** @var class-string<Imet\Imet> $form_class */
        $form_class = static::$form_class;

        // retrieve IMET list
        $filtered_list = $form_class::get_assessments_list_with_extras($request);
        $full_list = $form_class::get_assessments_list(new Request, ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix.'.export', [
            'controller' => static::class,
            'route_prefix' => static::ROUTE_PREFIX,
            'list' => $filtered_list,
            'request' => $request,
            'countries' => $countries,
            'years' => $years,
        ]);
    }

    /**
     * export records for specific module to csv format
     */
    public function exportModuleToCsv(string $ids, string $module_key): BinaryFileResponse|string|null
    {
        $model = ModuleKey::KeyToClassName($module_key);

        $query = $model::where(function ($query) use ($ids): void {
            if ($ids !== '' && $ids !== '0') {
                $query->whereIn('FormID', explode(',', $ids));
            }
        })
            ->whereHas('imet', function ($q): void {
                $q->where('version', Imet\Imet::IMET_V2);
            })
            ->get();

        $records = $query->makeHidden(['UpdateBy', 'UpdateDate', 'id'])->toArray();

        if (count($records) === 0) {
            return trans('modular-forms::common.no_record_found');
        }

        $title = str_replace(' ', '_', $query->pluck('module_code')->first());

        return File::exportToCSV($title.'.csv', $records);
    }

    /**
     * return modules list for export
     */
    public function exportListCSV(Request $request): View
    {
        $wdpa_list = [];
        $modules_final_list = [];
        $temp_array = [];

        // retrieve all form records and manipulate array result
        $results = Imet\Imet::query()
            ->select('FormID')
            ->distinct()
            ->commonSearchWithWdpa($request)->get();

        // add this to check if a filter is applied in order to return the ids or return 0 (all records)
        if ($request->filled('country') || $request->filled('year') || $request->filled('wdpa')) {
            $results = $results->implode('FormID', ',');
        } else {
            $results = 0;
        }

        // retrieve all data for filters countries, years, wdpa
        $filters = Imet\Imet::getFieldsSplitToArrays();

        // retrieve wdpa labels and ids in an array for selections
        $wdpas = ProtectedArea::getRecordsArrayByFieldIds($filters['wdpa_id'], ['wdpa_id', 'name'], 'wdpa_id');
        foreach ($wdpas as $a) {
            $wdpa_list[$a['wdpa_id']] = $a['name'];
        }

        // retrieve countries labels and ids in an array for selections
        $countries = Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray();
        $countries = array_map(fn (array $item) => $item['name'], $countries);

        $imet_keys = Imet\v2\Imet::getModulesKeys();
        $imet_eval_keys = Imet\v2\Imet_Eval::getModulesKeys();
        $modules = array_merge(Imet\v2\Imet::$modules, Imet\v1\Imet_Eval::$modules);

        foreach ($modules as $key => $module) {
            $temp_array[$key] = $module;
            $modules_final_list[$key] = Module::getModulesList($temp_array);
            unset($temp_array[$key]);
        }

        return view(static::$form_view_prefix.'.tools.export_csv',
            [
                'modules' => $modules_final_list,
                'imet_keys' => $imet_keys,
                'imet_eval_keys' => $imet_eval_keys,
                'countries' => $countries,
                'years' => $filters['Year'],
                'wdpa' => $wdpa_list,
                'request' => $request,
                'method' => 'GET',
                'results' => $results,
            ]
        );
    }

    /**
     * Export IMET json in batch (zip file) or if only one is selected as json file
     *
     * @throws UnrecognizedVersionException
     */
    public function export_batch(Request $request): BinaryFileResponse
    {
        $imetIds = explode(',', $request->input('selection'));

        $files = [];
        foreach ($imetIds as $imet) {
            $files[] = $this->export($imet, false, true, false);
        }

        $path = $files[0];
        if (count($files) > 1) {
            $fileName = 'IMETS_'.count($files).'_'.Date::now()->format('m-d-Y_hisu').'.zip';
            $path = Zip::compress($files, $fileName);
        }

        return File::download($path);
    }

    /**
     * Export the IMET form in json
     *
     * @throws UnrecognizedVersionException
     */
    public function export($item, bool $exclude_attachments = false, bool $to_file = true, bool $download = true): BinaryFileResponse|array|string
    {
        if ($item instanceof Imet\Imet) {
            $imet_id = $item->getKey();
            $imet = $item;
        } else {
            $imet_id = $item;
            $imet = (static::$form_class)::find($item);
        }

        $this->authorize('export', $imet);

        $imet_form = $imet
            ->makeHidden(['FormID', 'UpdateDate', 'UpdateBy', 'protected_area_global_id', 'sync_unique_id', 'synced'])
            ->toArray();

        $imet_form['imet_version'] = function_exists('imet_offline_tool_version')
            ? imet_offline_tool_version()
            : 'online';

        // #####  IMET V1  #####
        if ($imet_form['version'] === Imet\Imet::IMET_V1) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\v1\Encoder::exportModule($imet_id),
                'Context' => Imet\v1\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\v1\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\v1\Report::export($imet_id),
            ];
        } // #####  IMET V2  #####
        elseif ($imet_form['version'] === Imet\Imet::IMET_V2) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\v2\Encoder::exportModule($imet_id),
                'Context' => Imet\v2\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\v2\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\v2\Report::export($imet_id),
            ];
        } // #####  IMET OECM  #####
        elseif ($imet_form['version'] === Imet\Imet::IMET_OECM) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\oecm\Encoder::exportModule($imet_id),
                'Context' => Imet\oecm\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\oecm\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\oecm\Report::export($imet_id),
            ];
        } else {
            throw new UnrecognizedVersionException($imet_form['version']);
        }

        if (ProtectedAreaNonWdpa::isNonWdpa($imet_form['wdpa_id'])) {
            $json['NonWdpaProtectedArea'] = ProtectedAreaNonWdpa::export($imet_form['wdpa_id']);
        }

        if ($to_file) {
            $fileName = $imet->filename('json');

            return File::exportToJSON(
                $fileName,
                $json,
                $download
            );
        }

        return $json;
    }

    /**
     * @throws UnrecognizedVersionException
     */
    public function export_no_attachments($item): BinaryFileResponse|array
    {
        return $this->export($item, true);
    }

    /**
     * View for importing an IMET from json file
     *
     * @throws AuthorizationException
     */
    public function import_view(): View
    {
        $this->authorize('viewAny', static::$form_class);

        return view(static::$form_view_prefix.'.import', [
            'controller' => static::class,
        ]);
    }

    /**
     * Import a full IMET from json file
     *
     * @throws Throwable
     */
    public function import(Request $request, $json = null, bool $returnJson = true): array|JsonResponse
    {
        try {
            if ($json === null) {
                $fileContent = static::getUploadFileContent($request->get('json_file')['temp_filename']);
                $json = json_decode($fileContent, true);
            }

            $response = ['status' => 'success', 'modules' => []];
            $version = $json['Imet']['version'];

            DB::beginTransaction();

            // Non-Wdpa protected area
            if (array_key_exists('NonWdpaProtectedArea', $json)) {
                $wdpa_id = ProtectedAreaNonWdpa::import($json['NonWdpaProtectedArea']);
                $json['Imet']['wdpa_id'] = $wdpa_id;
            }

            // Import modules
            [$formID, $modules_imported] = static::import_modules($json);

            DB::commit();

            // Force refresh scores && backup
            if ($version === Imet\Imet::IMET_V1) {
                ImetScores::refresh_scores($formID);
                (new Controllers\Imet\v1\Controller)->backup($formID, $version);
            } elseif ($version === Imet\Imet::IMET_V2) {
                ImetScores::refresh_scores($formID);
                (new Controllers\Imet\v2\Controller)->backup($formID, $version);
            } elseif ($version === Imet\Imet::IMET_OECM) {
                OecmScores::refresh_scores($formID);
                (new Controllers\Imet\oecm\Controller)->backup($formID, $version);
            } else {
                throw new UnrecognizedVersionException($version);
            }

            $response['modules'] = $modules_imported;
        } catch (Exception $exception) {
            DB::rollback();
            $response = ['status' => 'error'];
            throw_if(! App::environment('production') || ImetEnv::isImetOfflineEnv(), $exception);
        }

        if (! $returnJson) {
            return $response;
        }

        return new JsonResponse($response);
    }

    /**
     * Import all the IMET modules
     *
     * @throws UnrecognizedVersionException
     */
    protected static function import_modules(array $json, bool $with_report = true): array
    {
        $modules_imported = [];
        $imet_version = $json['Imet']['imet_version'] ?? null;
        $version = $json['Imet']['version'];

        // #####  IMET V1  #####
        if ($version === Imet\Imet::IMET_V1) {
            $formID = Imet\v1\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\v1\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\v1\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\v1\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\v1\Report::import($formID, $json['Report'] ?? null);
            }
        } // #####  IMET V2  #####
        elseif ($version === Imet\Imet::IMET_V2) {
            $formID = Imet\v2\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\v2\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\v2\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\v2\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\v2\Report::import($formID, $json['Report'] ?? null);
            }
        } // #####  IMET OECM  #####
        elseif ($version === Imet\Imet::IMET_OECM) {
            $formID = Imet\oecm\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\oecm\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\oecm\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\oecm\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\oecm\Report::import($formID, $json['Report'] ?? null);
            }
        } else {
            throw new UnrecognizedVersionException($version);
        }

        return [$formID, $modules_imported];
    }
}
