<?php
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */
?>

{!! \ModularForms\Helpers\Input\Input::label('search', trans('modular-forms::common.search')) !!}
{!! \ModularForms\Helpers\Input\Input::text('search', $request->input('search')) !!}

{!! \ModularForms\Helpers\Input\Input::label('country', trans('imet-core::common.country')) !!}
{!! \ModularForms\Helpers\Input\DropDown::simple('country', $request->input('country'), $countries) !!}

{!! \ModularForms\Helpers\Input\Input::label('year', trans('imet-core::common.year')) !!}
{!! \ModularForms\Helpers\Input\DropDown::simple('year', $request->input('year'), $years) !!}
