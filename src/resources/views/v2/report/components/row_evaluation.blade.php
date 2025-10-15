<?php
/** @var string $assessment_value */
/** @var string $assessment_label */
/** @var ?string $additional_classes [optional] */
/** @var ?boolean $threats [optional] */

use ImetCore\Controllers\Imet\ApiController;

$additional_classes ??= null;
$threats ??= false;
$constraints ??= false;

$classes = match(true) {
    $threats => ApiController::score_class_threats($assessment_value),
    $constraints => ApiController::score_class_threats($assessment_value, 'score_constraints_success'),
    default => ApiController::score_class($assessment_value)
};

?>

<td class="{!! $classes . ' ' . $additional_classes !!}">{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
