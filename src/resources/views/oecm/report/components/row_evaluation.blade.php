<?php
/** @var string $assessment_value */
/** @var string $assessment_label */
/** @var ?string $additional_classes [optional] */
/** @var ?boolean $threats [optional] */

use ImetCore\Services\Scores\AssessmentsScores;

$additional_classes = $additional_classes ?? null;
$threats            = $threats ?? false;

$colspan            = isset($colspan) ? "colspan=".$colspan : "";
$color_scores       = $color_scores ?? true;
$constraints = $constraints ?? false;

$classes = '';
if ($color_scores) {
    if ($threats) {
        $classes = AssessmentsScores::score_class_threats($assessment_value);
    } elseif ($constraints) {
        $classes = AssessmentsScores::score_class_threats($assessment_value, 'score_constraints_success');
    } else {
        $classes = AssessmentsScores::score_class($assessment_value);
    }
}


?>

<td class="{!! $classes . ' ' . $additional_classes !!}" {!! $colspan !!}>{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
