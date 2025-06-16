<?php


namespace ImetCore\Models\Imet\ScalingUp\Sections;

use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Services\Scores\Functions\V2Scores;
use ImetCore\Helpers\ScalingUp\Common;

class Thematic
{
    public static function getClimateChange(int $form_id, int $scalingUpId): array
    {
        $items = Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->select(['Aspect', 'Comments', 'EvaluationScore'])
            ->toArray();

        $result = ['id' => 0, 'name' => '', 'items' => []];
        foreach ($items as $id => $item) {
            $protected_area = Common::get_pa_name($form_id, $scalingUpId);
            $result['id'] = $id;
            $result['name'] = $protected_area->name;
            $result['colors'] = $protected_area->color;
            $result['score'] = V2Scores::scores_context($form_id)['C14'] ?? 0;
            $result['items'][] = ['aspect' => $item['Aspect'] ?? '', 'comments' => $item['Comments'] ?? '-', 'score' => $item['EvaluationScore']];
        }

        return $result;
    }

    public static function getEcosystemServices(int $form_id, int $scalingUpId): array
    {
        $predefined = Modules\Evaluation\ImportanceEcosystemServices::getPredefined($form_id);
        $ori_records = Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->select(['id', 'Aspect', 'Comments', 'EvaluationScore'])
            ->toArray();

        $items = Modules\Context\EcosystemServices::getModule($form_id)
            ->filter(function ($item) {
                return $item['Importance'] !== null;
            })
            ->map(function ($item) {
                $item['_rank'] = (floatval($item['Importance'])
                        + ($item['ImportanceRegional'] / 3)
                        + ((2 - $item['ImportanceGlobal']) / 4)) / 3 * 100;
                return $item;
            })
            ->sortByDesc('_rank');

        $loop = $items->values()->toArray();
        foreach ($loop as $index => $record) {
//            echo $record['Element'] . "//" . $index . "\n" . "//";
            $ori_records[$index]['_rank'] = $record['_rank'];
            $ori_records[$index]['_Importance'] = $record['Importance'];
            $ori_records[$index]['_ImportanceRegional'] = $record['ImportanceRegional'];
            $ori_records[$index]['_ImportanceGlobal'] = $record['ImportanceGlobal'];
        }


//        dd($form_id,$predefined, $ori_records, count($ori_records), $items, count($items));
//dd($ori_records);
        $result = ['id' => 0, 'name' => '', 'items' => [], 'ranks'];
        foreach ($ori_records as $id => $item) {
            $protected_area = Common::get_pa_name($form_id, $scalingUpId);
            $result['id'] = $id;
            $result['name'] = $protected_area->name;
            $result['colors'] = $protected_area->color;
            $result['score'] = V2Scores::scores_context($form_id)['C15'];
            if (isset($item['Aspect'])) {
                $result['items'][] = ['aspect' => $item['Aspect'], 'comments' => $item['Comments'] ?? '-', 'score' => $item['EvaluationScore'], 'rank' => $item['_rank'] ?? ""];
            }
        }

        $ranks = [];
        foreach ($result['items'] as $id => $item) {
            $ranks[$item['aspect']] = round((float)$item['rank'], 2);
        }
        $result['ranks'] = $ranks;

        return $result;
    }
}
