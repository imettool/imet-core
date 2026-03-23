<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ImetCore\Helpers\ScalingUp\Common as ModelCommon;
use ImetCore\Models\Imet\Imet as ImetAlias;
use ImetCore\Models\Imet\ScalingUp\Analysis\DigitalInformationAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\GroupingAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ComparisonProtectedAreaAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ManagementContextAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\GeneralInfoAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\MapViewAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\OverallManagementEffectivenessAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ManagementCycleAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ProtectedAreaAnalysis;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Services\Scores\ImetScores;

final class ReportScalingUp
{
    use Common;

    /**
     * @return array[]
     */
    private static function templates(): array
    {
        return [
            ['name' => ProtectedAreaAnalysis::$template, 'title' => trans(ProtectedAreaAnalysis::$title), 'exclude_elements' => ProtectedAreaAnalysis::$exclude_elements, 'code' => ProtectedAreaAnalysis::$code, 'info_label' => ProtectedAreaAnalysis::$info_label],
            ['name' => MapViewAnalysis::$template, 'title' => trans(MapViewAnalysis::$title), 'exclude_elements' => MapViewAnalysis::$exclude_elements, 'code' => MapViewAnalysis::$code, 'info_label' => MapViewAnalysis::$info_label],
            ['name' => GeneralInfoAnalysis::$template, 'title' => trans(GeneralInfoAnalysis::$title), 'exclude_elements' => GeneralInfoAnalysis::$exclude_elements, 'code' => GeneralInfoAnalysis::$code, 'info_label' => GeneralInfoAnalysis::$info_label],
            ['name' => ManagementContextAnalysis::$template, 'title' => trans(ManagementContextAnalysis::$title), 'exclude_elements' => ManagementContextAnalysis::$exclude_elements, 'code' => ManagementContextAnalysis::$code, 'info_label' => ManagementContextAnalysis::$info_label],
            ['name' => OverallManagementEffectivenessAnalysis::$template, 'title' => trans(OverallManagementEffectivenessAnalysis::$title), 'exclude_elements' => OverallManagementEffectivenessAnalysis::$exclude_elements, 'code' => OverallManagementEffectivenessAnalysis::$code, 'info_label' => OverallManagementEffectivenessAnalysis::$info_label],
            ['name' => GroupingAnalysis::$template, 'title' => trans(GroupingAnalysis::$title), 'exclude_elements' => GroupingAnalysis::$exclude_elements, 'code' => GroupingAnalysis::$code, 'info_label' => GroupingAnalysis::$info_label],
            ['name' => ManagementCycleAnalysis::$template, 'title' => trans(ManagementCycleAnalysis::$title), 'exclude_elements' => ManagementCycleAnalysis::$exclude_elements, 'code' => ManagementCycleAnalysis::$code, 'info_label' => ManagementCycleAnalysis::$info_label],
            ['name' => ComparisonProtectedAreaAnalysis::$template, 'title' => trans(ComparisonProtectedAreaAnalysis::$title), 'exclude_elements' => ComparisonProtectedAreaAnalysis::$exclude_elements, 'code' => ComparisonProtectedAreaAnalysis::$code, 'info_label' => ComparisonProtectedAreaAnalysis::$info_label],
            ['name' => DigitalInformationAnalysis::$template, 'title' => trans(DigitalInformationAnalysis::$title), 'exclude_elements' => DigitalInformationAnalysis::$exclude_elements, 'code' => DigitalInformationAnalysis::$code, 'info_label' => DigitalInformationAnalysis::$info_label],
        ];
    }

    /**
     * @param Request $request
     * @param string $items
     * @param int $scaling_up_id
     * @return void
     */
    private static function update_custom_names(Request $request, string $items, int $scaling_up_id): void
    {
        $ids = explode(',', $items);
        foreach ($ids as $id) {
            if ($request->input($id)) {
                ScalingUpWdpa::update_item($scaling_up_id, $id, $request->input($id), $request->input('color-'.$id));
            }
        }
    }

    /**
     * @param int $scaling_up_id
     * @param array $areas
     * @return void
     */
    private static function save_default_names(int $scaling_up_id, array $areas): void
    {
        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        if (count($isScalingUpInit) === 0) {
            ModelCommon::reset_areas_ids();
            ScalingUpWdpa::save_pas($scaling_up_id, $areas);
        }
    }

    /**
     * @param int $scaling_up_id
     * @return array
     */
    private static function retrieve_custom_names(int $scaling_up_id): array
    {
        $custom_names = [];
        $items = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        foreach ($items as $item) {
            $custom_names[$item->FormID] = $item;
        }

        return $custom_names;
    }

    /**
     * @param string $items
     * @return array
     */
    private static function loadItemsAndScalingUpID(string $items): array
    {
        $item = ModelScalingUpAnalysis::get_scaling_up_by_wdpas($items);

        if ($item->count() === 0) {
            $item = ModelScalingUpAnalysis::query()->create(['wdpas' => $items]);
            $areas = $item['wdpas'];
            $scaling_up_id = $item['id'];
        } else {
            $areas = $item[0]['wdpas'];
            $scaling_up_id = $item[0]['id'];
        }

        return [$areas, $scaling_up_id];
    }

    /**
     * @param Request $request
     * @param string $items
     * @return array
     * @throws AuthorizationException
     * @throws \Throwable
     */
    public static function report(Request $request, string $items): array
    {
        $locale = App::getLocale();

        self::validateAndPrepareItems($items);
        [$areas, $scalingUpId] = self::loadItemsAndScalingUpID($items);

        $protectedAreas = self::processProtectedAreas($request, $areas, $scalingUpId);
        $customData = self::protectedAreaNames($scalingUpId);

        App::setLocale($locale);

        return self::buildReportData($protectedAreas, $customData, $scalingUpId);
    }

    /**
     * @param string $items
     * @throws AuthorizationException
     * @throws \Throwable
     *
     */
    private static function validateAndPrepareItems(string $items): void
    {
        $itemsArray = explode(',', $items);
        sort($itemsArray);

        static::checkAuthorization($itemsArray);

        $validItems = array_filter(
            $itemsArray,
            fn($value): bool => is_numeric($value) && Imet::query()->where('FormID', $value)->exists()
        );

        abort_if(empty($itemsArray) || count($validItems) !== count($itemsArray), 404);

    }

    /**
     * @param Request $request
     * @param string $areas
     * @param int $scalingUpId
     * @return array
     */
    private static function processProtectedAreas(Request $request, string $areas, int $scalingUpId): array
    {
        $protectedAreas = ModelScalingUpAnalysis::get_protected_area(explode(',', $areas), true);

        self::saveForm($request, $areas, $scalingUpId);
        self::save_default_names($scalingUpId, $protectedAreas['models']);

        uasort($protectedAreas['models'], fn(ImetAlias $a, ImetAlias $b): int => $a['name'] <=> $b['name']);

        return $protectedAreas;
    }

    /**
     * @param array $protectedAreas
     * @param array $customData
     * @param int $scalingUpId
     * @return array
     */
    private static function buildReportData(array $protectedAreas, array $customData, int $scalingUpId): array
    {
        [$customColors, $customItems, $customNames, $protectedAreasNames] = $customData;

        return [
            'templates' => self::templates(),
            'labels' => ImetScores::indicators_labels(ImetAlias::IMET_V2),
            'pa_ids' => implode(',', array_keys($protectedAreas['models'])),
            'protected_areas_names' => $protectedAreasNames,
            'scaling_up_id' => $scalingUpId,
            'protected_areas' => $protectedAreas,
            'custom_names' => $customNames,
            'custom_colors' => $customColors,
            'custom_items' => $customItems,
        ];
    }

    /**
     * @param Request $request
     * @param string $items
     * @param int $scaling_up_id
     * @return void
     */
    private static function saveForm(Request $request, string $items, int $scaling_up_id): void
    {
        if ($request->input('save_form')) {
            ModelCommon::reset_areas_ids();
            self::update_custom_names($request, $items, $scaling_up_id);
        }
    }

    /**
     * @param int $scaling_up_id
     * @return array
     */
    private static function protectedAreaNames(int $scaling_up_id): array
    {
        $custom_items = self::retrieve_custom_names($scaling_up_id);

        $custom_names = array_map(fn ($v) => $v->name, $custom_items);

        $custom_colors = array_map(fn ($v) => $v->color, $custom_items);

        $protected_areas_names = implode(', ', $custom_names);

        return [$custom_colors, $custom_items, $custom_names, $protected_areas_names];
    }
}
