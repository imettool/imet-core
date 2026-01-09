<?php
namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Country;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;

final class ProtectedAreaDataProvider
{
    public function __construct(
        private int $scalingId
    ) {}

    /**
     * @param array $formIds
     * @return array
     * @throws \Exception
     */
    public function getProtectedAreasWithCountries(array $formIds): array
    {
        $items = array_map(function($formId) {
            $pa = ScalingUpWdpa::getCustomNames($formId, $this->scalingId);
            return [
                ...$pa->toArray(),
                'Country_name' => Country::getByISO($pa['Country'])
            ];
        }, $formIds);

        uasort($items, fn (array $a, array $b): int => strnatcmp((string) $a['name'], (string) $b['name']));

        return $items;
    }

    /**
     * @param array $form_ids
     * @param bool $show_original_names
     * @return array[]
     */
    public static function getProtectedArea(array $form_ids, bool $show_original_names = false): array
    {
        $protected_area = [];
        $categories = [];

        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = Common::protected_areas_duplicate_fixes($form_id, $show_original_names);
            $general_info = Modules\Context\GeneralInfo::getModuleRecords($form_id);
            $first_record = $protected_area[$form_id][0];
            if ($first_record) {
                $categories[$form_id] = Common::get_category_of_protected_area($first_record);
            }
        }

        return ['models' => $protected_area, 'categories' => $categories];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function getWdpasByFormId(array $form_ids): array
    {
        return array_map(
            fn($form_id) => ScalingUpWdpa::getByFormID(self::$scaling_id, $form_id),
            $form_ids
        );
    }
}
