<?php
use \Illuminate\Support\Str;

?>

@extends('modular-forms::layouts.forms')

@section('content')

    <div class="flex flex-col items-center">

        <!-- Start buttons -->
        <div class="flex flex-row gap-4">

            <!-- IMET -->
            <a href="{{ route('imet-core::index') }}" class="btn-nav big mt-4 !font-bold !px-5">
                {!! Str::upper(trans('imet-core::common.imet_short')) !!}
            </a>

            <!-- OECM -->
            <a href="{{ route('imet-core::oecm.index') }}" class="btn-nav big mt-4 !font-bold !px-5">
                {!! Str::upper(trans('imet-core::oecm_common.oecm_short')) !!}
            </a>

        </div>

    </div>

    <style>
        .content{
            min-width: 850px !important;
            max-width: 1050px !important;
        }
    </style>


@endsection
