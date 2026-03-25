<?php

use ImetCore\Models\Imet;
use ImetCore\Services\Assessment;
use ImetCore\Services\Scores\AssessmentsScores;

/** @var ?string $step */
/** @var Imet\ImetV1\Imet|Imet\ImetV2\Imet|Imet\ImetOecm\Imet $item */
/** @var string $version */

$step ??= null;

if ($version === Imet\Imet::IMET_OECM) {
    $scores = AssessmentsScores::scores_oecm($item->getKey());
    $labels = Assessment\OecmAssessment::get_scores_labels($item->version, $item->language);
} else {
    $scores = AssessmentsScores::scores($item->getKey());
    $labels = Assessment\ImetAssessment::get_scores_labels($item->version, $item->language);
}

?>

<div id="assessment_scores">
    <imet_scores
            current_step="{{ $step }}"
            :labels='@json($labels)'
            :store=store
            version="{{ $version }}"
    ></imet_scores>
</div>

@push('scripts')
    <script type="module">
        window.AssessmentScores = (new window.ImetCore.Apps.AssessmentScores({
            api_data: @json($scores),
        }))
            .mount('#assessment_scores');
    </script>
@endpush
