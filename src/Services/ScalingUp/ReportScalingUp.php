<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ImetCore\Helpers\ScalingUp\Common as ModelCommon;
use ImetCore\Models\Imet\Imet as ImetAlias;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Services\Scores\ImetScores;

class ReportScalingUp
{
    use Common;

    /**
     * @return array[]
     */
    private static function templates(): array
    {
        return [
            ['name' => 'protected_areas', 'title' => trans('imet-core::analysis_report.sections.list_of_names'), 'snapshot_id' => 'protected_areas', 'exclude_elements' => '', 'code' => '0'],
            ['name' => 'map_view', 'title' => trans('imet-core::analysis_report.sections.first'), 'snapshot_id' => 'map_view', 'exclude_elements' => '', 'code' => '1'],
            ['name' => 'general_elements', 'title' => trans('imet-core::analysis_report.sections.second'), 'snapshot_id' => 'general_elements', 'exclude_elements' => '', 'code' => '2'],
            ['name' => 'key_elements_of_conservation', 'title' => trans('imet-core::analysis_report.sections.third'), 'snapshot_id' => 'management_context', 'exclude_elements' => '', 'code' => '3'],
            ['name' => 'overall_management_effectiveness_scores', 'title' => trans('imet-core::analysis_report.sections.fourth'), 'snapshot_id' => 'evaluation_of_protected_area_management_cycle', 'exclude_elements' => '', 'code' => '4'],
            ['name' => 'grouping_analysis_on_demand', 'title' => trans('imet-core::analysis_report.sections.fifth'), 'snapshot_id' => 'grouping_analysis_on_demand', 'exclude_elements' => 'js-grouping-action-buttons,start-zone,js-render-buttons', 'code' => '5'],
            ['name' => 'analysis_per_element_of_them_management_cycle', 'title' => trans('imet-core::analysis_report.sections.sixth'), 'snapshot_id' => 'elements_diagrams', 'exclude_elements' => '', 'code' => '6'],
            ['name' => 'relative_performance_effectiveness_intervals', 'title' => trans('imet-core::analysis_report.sections.seventh'), 'snapshot_id' => 'relative_performance_effectiveness_intervals', 'exclude_elements' => 'smallMenu', 'code' => '7'],
            ['name' => 'additional_option_digital_information_per_pa', 'title' => trans('imet-core::analysis_report.sections.eighth'), 'snapshot_id' => 'additional_option_digital_information_per_pa', 'exclude_elements' => '', 'code' => '8'],
        ];
    }

    private static function update_custom_names(Request $request, string $items, int $scaling_up_id): void
    {
        $ids = explode(',', $items);
        foreach ($ids as $id) {
            if ($request->input($id)) {
                ScalingUpWdpa::update_item($scaling_up_id, $id, $request->input($id), $request->input('color-'.$id));
            }
        }
    }

    private static function save_default_names(int $scaling_up_id, array $areas): void
    {

        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        if (count($isScalingUpInit) === 0) {
            ModelCommon::reset_areas_ids();
            ScalingUpWdpa::save_pas($scaling_up_id, $areas);
        }
    }

    private static function retrieve_custom_names(int $scaling_up_id): array
    {
        $custom_names = [];
        $items = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        foreach ($items as $item) {
            $custom_names[$item->FormID] = $item;
        }

        return $custom_names;
    }

    private static function loadItemsAndScalingUpID(string $items): array
    {
        $areas = [];
        $scaling_up_id = null;
        $item = ModelScalingUpAnalysis::get_scaling_up_by_wdpas($items);

        if ($item->count() === 0) {
            $item = ModelScalingUpAnalysis::query()->create(['wdpas' => $items]);
            if (isset($item)) {
                $areas = $item['wdpas'];
                $scaling_up_id = $item['id'];
            }
        } else {
            $areas = $item[0]['wdpas'];
            $scaling_up_id = $item[0]['id'];
        }

        return [$areas, $scaling_up_id];
    }

    /**
     * @throws AuthorizationException
     */
    public static function report(Request $request, string $items): array
    {
        // keep the current locale to restore it at the end
        $locale = App::getLocale();

        // create an  array with the pa ids sorted and then return it as a string
        $items_array = explode(',', $items);
        sort($items_array);

        // check authorizations
        static::checkAuthorization($items_array);

        // check if the parameters are an array of numbers and pa exist in the db
        $filtered_array = array_filter($items_array, function ($value): bool {
            return is_numeric($value) && Imet::query()->where('FormID', $value)->exists();
        });

        // if not return 404
        abort_if($items_array === [] || (count($filtered_array) !== count($items_array)), 404);

        [$areas, $scaling_up_id] = static::loadItemsAndScalingUpID($items);

        $protected_areas = ModelScalingUpAnalysis::get_protected_area(explode(',', $areas), true);

        static::saveForm($request, $items, $scaling_up_id);

        static::save_default_names($scaling_up_id, $protected_areas['models']);

        $pa_ids = implode(',', array_keys($protected_areas['models']));

        uasort($protected_areas['models'], function (array $a, array $b): bool {
            return $a['name'] > $b['name'];
        });

        [$custom_colors, $custom_items, $custom_names, $protected_areas_names] = static::protectedAreaNames($scaling_up_id);

        App::setLocale($locale);

        $labels = ImetScores::indicators_labels(ImetAlias::IMET_V2);

        return [
            'templates' => static::templates(),
            'labels' => $labels,
            'pa_ids' => $pa_ids,
            'protected_areas_names' => $protected_areas_names,
            'scaling_up_id' => $scaling_up_id,
            'protected_areas' => $protected_areas,
            'custom_names' => $custom_names,
            'custom_colors' => $custom_colors,
            'request' => $request,
            'custom_items' => $custom_items,
        ];
    }

    private static function saveForm(Request $request, string $items, int $scaling_up_id): void
    {
        if ($request->input('save_form')) {
            ModelCommon::reset_areas_ids();
            static::update_custom_names($request, $items, $scaling_up_id);
        }
    }

    private static function protectedAreaNames(int $scaling_up_id): array
    {
        $custom_items = static::retrieve_custom_names($scaling_up_id);

        $custom_names = array_map(function ($v) {
            return $v->name;
        }, $custom_items);

        $custom_colors = array_map(function ($v) {
            return $v->color;
        }, $custom_items);

        $protected_areas_names = implode(', ', $custom_names);

        return [$custom_colors, $custom_items, $custom_names, $protected_areas_names];
    }
}
