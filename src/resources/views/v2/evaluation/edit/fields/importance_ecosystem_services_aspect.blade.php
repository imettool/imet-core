<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class  */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */
/** @var string $module_key */

$vue_attributes = \ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

?>
<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div style="display:flex"><div class="text-left mr-2"><b>@{{ records[index]['_categories'] }}</b></div> <div class="text-left field-preview field-disabled"> @{{ {!! $v_value !!} }}</div></div>
<div class="field-preview field-disabled">@{{ {!! $v_value !!} }}</div>
<div class="text-left" style="padding: 4px;" v-if="'_rank' in records[index]">
    <b class="highlight">@{{ '_rank' in records[index] ? records[index]['_rank'].toFixed(2) : '' }}</b>&nbsp;&nbsp;
    <span style="font-size: 0.85em; font-style: italic; ">
        (@lang('imet-core::v2_context.EcosystemServices.fields.Importance'): <b>@{{ records[index]['_Importance'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.EcosystemServices.fields.ImportanceRegional'): <b>@{{ records[index]['_ImportanceRegional'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.EcosystemServices.fields.ImportanceGlobal'): <b>@{{ records[index]['_ImportanceGlobal'] }}</b>)
    </span>
</div>
