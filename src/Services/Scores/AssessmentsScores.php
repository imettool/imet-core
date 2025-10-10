<?php

namespace ImetCore\Services\Scores;

use ImetCore\Services\Assessment\ImetAssessment;
use ImetCore\Services\Assessment\OecmAssessment;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Models\Imet\v1\Imet as ImetV1;
use ImetCore\Models\Imet\v2\Imet as ImetV2;
use Illuminate\Http\JsonResponse;

use function response;

class AssessmentsScores
{

    /**
     * @param ImetV1|ImetV2 $item
     * @param bool $responseTypeJson
     * @return JsonResponse|array
     */
    public static function scores(ImetV1|ImetV2 $item, bool $responseTypeJson = true): JsonResponse|array
    {
        $stats = ImetAssessment::getAssessment($item, _Scores::ALL_SCORES, false);
        return $responseTypeJson ? response()->json($stats) : $stats;
    }

    /**
     * @param ImetV1|ImetV2 $item
     * @param bool $responseTypeJson
     * @return JsonResponse|array
     */
    public static function scores_oecm(ImetV1|ImetV2 $item, bool $responseTypeJson = true): JsonResponse|array
    {
        $stats = OecmAssessment::getAssessment($item, _Scores::ALL_SCORES, false);
        return $responseTypeJson ? response()->json($stats) : $stats;
    }

    /**
     * @param int|null $value
     * @return string
     */
    public static function score_class(int|null $value): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value <= -51){
            $class='score_danger_alert';
        } elseif($value < -33 && $value > -51){
            $class='score_danger_warning';
        } elseif($value <= 0){
            $class = 'score_danger';
        } elseif($value < 34){
            $class = 'score_alert';
        } elseif($value<51){
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return $class;
    }

    /**
     * @param int|null $value
     * @param string $score_success_color
     * @return string
     */
    public static function score_class_threats(int|null $value, string $score_success_color = 'score_success'): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value<-51){
            $class = 'score_threat_danger';
        } elseif($value<-1){
            $class = 'score_threat_medium_danger';
        } else {
            $class = $score_success_color;
        }
        return $class;
    }
}
