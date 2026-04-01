
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
    <div v-html="group_label({{ $id }})"></div>
    <div v-html="percentage_stakeholder_label({{ $id }})"></div>
</div>
