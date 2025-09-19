
<x-modular-forms::module.components.field.input
    type="disabled"
    :value="$v_value"
    :id="$id"
    :class="$class"
    :rules="$rules"
    :other="$other"
    :module_key="$module_key"
></x-modular-forms::module.components.field.input>


<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div v-html="group_label({{ $id }})"></div>
    <div v-html="percentage_stakeholder_label({{ $id }})"></div>
</div>
