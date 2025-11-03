<?php
use ModularForms\Helpers\Input\DropDown;
use ModularForms\Helpers\Input\Input;

/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */

?>

{!! Input::label('search', trans('modular-forms::common.search')) !!}
{!! Input::text('search', $request->input('search')) !!}

{!! Input::label('country', trans('imet-core::common.country')) !!}
{!! DropDown::simple('country', $request->input('country'), $countries) !!}

{!! Input::label('year', trans('imet-core::common.year')) !!}
{!! DropDown::simple('year', $request->input('year'), $years) !!}
