<?php
use ModularForms\Helpers\ModuleKey;

$field_name = rtrim(last(explode('_', $id)), "'");
$module_class = ModuleKey::KeyToClassName($slug);
$legend = new $module_class()->ratingLegend[$field_name] ?? null;
?>

<rating
    rating-type="{{ str_replace('rating-', '', $type) }}"
    :legend='@json(array_values($legend))'
    {!! $vue_attributes !!} data-{!! $class_attribute !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></rating>
