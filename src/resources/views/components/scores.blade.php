<?php
use ImetCore\Models\Imet;
use ImetCore\Services\Assessment;
use ImetCore\Models\Imet\Scores\AssessmentsScores;

/** @var ?string $step */
/** @var Imet\v1\Imet|Imet\v2\Imet|Imet\oecm\Imet $item */
/** @var string $version */

$step = $step ?? null;

if($version === Imet\Imet::IMET_OECM){
    $scores = AssessmentsScores::scores_oecm($item->getKey())->getData();
    $labels = Assessment\OecmAssessment::get_scores_labels($item->version, $item->language);
} else {
    $scores = AssessmentsScores::scores($item->getKey())->getData();
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
