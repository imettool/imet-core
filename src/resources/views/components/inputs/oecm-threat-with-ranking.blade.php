
<x-imet-core::custom-input
    type="disabled"
    :value="$value"
    :id="$id"
    :class="$class"
    :rules="$rules"
    :other="$other"
    :slug="$slug"
></x-imet-core::custom-input>

<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div v-if=records[index]['__score']!==null>
        <b>@lang('imet-core::oecm_evaluation.ThreatsIntegration.ranking')</b>
        <span>@{{ parseFloat(records[index]['__score']).toFixed(2) }}</span>
    </div>
</div>
