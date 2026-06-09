<heatmap-rating
    legend="{{ json_encode(trans('imet-core::v2_report.ThreatsAffectingKCEs.ratingLegend.impact')) }}"
    {!! $vue_attributes !!} data-{!! $class_attribute !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></heatmap-rating>
