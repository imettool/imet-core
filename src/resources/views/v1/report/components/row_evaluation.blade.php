<?php
/** @var string $assessment_value */
/** @var string $assessment_label */
/** @var ?string $additional_classes [optional] */
/** @var ?boolean $threats [optional] */

use ImetCore\Services\Scores\AssessmentsScores;

$threats ??= false;
$constraints ??= false;

$classes = match(true) {
    $threats => AssessmentsScores::score_class_threats($assessment_value),
    $constraints => AssessmentsScores::score_class_contraints($assessment_value),
    default => AssessmentsScores::score_class($assessment_value)
};

?>

<td class="{!! $classes . ' ' . $additional_classes !!}">{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
