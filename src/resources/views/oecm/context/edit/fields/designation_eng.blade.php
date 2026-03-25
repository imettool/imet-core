<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class  */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */
/** @var string $slug */

?>

<x-modular-forms::module.components.field.input
    type="text-area"
    :value="$v_value"
    :id="$id"
    :class="$class"
    :rules="$rules"
    :other="$other"
    :slug="$slug"
></x-modular-forms::module.components.field.input>


<ul class="text-xs" style="margin-top: 10px; padding-inline-start: 30px;">
    <li style="padding-inline-start: 30px;">
        <b>@lang('imet-core::common.CreateNonWdpa.allowed_international')</b>:
        <ul>
            <li>Ramsar Site, Wetland of International Importance</li>
            <li>UNESCO-MAB Biosphere Reserve</li>
            <li>World Heritage Site (natural or mixed)</li>
        </ul>
    </li>
    <li style="padding-inline-start: 30px;">
        <b>@lang('imet-core::common.CreateNonWdpa.allowed_regional')</b>:
        <ul>
            <li>Baltic Sea Protected Area (HELCOM)</li>
            <li>Specially Protected Area (Cartagena Convention)</li>
            <li>Marine Protected Area (CCAMLR)</li>
            <li>Marine Protected Area (OSPAR)</li>
            <li>Site of Community Importance (Habitats Directive)</li>
            <li>Special Protection Area (Birds Directive)</li>
            <li>Specially Protected Areas of Mediterranean Importance (Barcelona Convention)</li>
        </ul>
    </li>
    <li>
        <b>@lang('imet-core::common.CreateNonWdpa.allowed_national')</b>
    </li>
</ul>

