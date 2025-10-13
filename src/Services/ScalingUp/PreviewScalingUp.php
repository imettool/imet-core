<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Auth\Access\AuthorizationException;
use ImetCore\Models\Imet\Imet as ImetAlias;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ImetCore\Services\Scores\ImetScores;

class PreviewScalingUp
{
    use Common;

    /**
     * @throws AuthorizationException
     */
    public static function preview(int $id): array
    {
        $areas_names_concat = '';
        $records = ModelScalingUpAnalysis::query()->where('id', $id)->first();
        $labels = ImetScores::indicators_labels(ImetAlias::IMET_V2);
        if ($records) {
            $wdpas = explode(',', $records->wdpas);
            static::checkAuthorization($wdpas);
            ModelScalingUpAnalysis::$scaling_id = $id;

            $protected_areas = ModelScalingUpAnalysis::get_wdpas_by_form_id($wdpas);
            foreach ($protected_areas as $k => $protected_area) {
                $areas_names[$k] = $protected_area->name;
            }

            asort($areas_names);

            $areas_names_concat = implode(', ', $areas_names);
        }

        return [
            'scaling_up_id' => $id,
            'labels' => $labels,
            'protected_areas' => $areas_names_concat,
        ];
    }
}
