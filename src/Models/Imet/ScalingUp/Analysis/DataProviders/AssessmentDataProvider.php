<?php
namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Helpers\ScalingUp\Common;

final class AssessmentDataProvider
{
    public function __construct(
        private int $scalingId
    ) {}

    public function getAssessments(array $formIds): array
    {
        $assessments = Common::get_assessments($formIds, $this->scalingId);
        unset($assessments['data']['assessments']);
        return $assessments;
    }
}
