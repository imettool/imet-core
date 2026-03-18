<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

?>

@if($definitions['module_subTitle']!==null)
    <div class="module-bar module_subTitle">
        <div class="message">
            {!! ucfirst($definitions['module_subTitle']) !!}
        </div>
    </div>
@endif

@if($definitions['module_info']!==null)
    <div class="module-bar info-bar">
        <div class="icon">
            {!! \ModularForms\Helpers\Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $definitions['module_info'] !!}
        </div>
    </div>
@endif

@if($definitions['module_info_EvaluationQuestion']!==null || $definitions['module_info_Rating']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \ModularForms\Helpers\Template::icon('file-alt', '', '1.4em') !!}
        </div>
        <div class="message">
            {{-- Methodology --}}
            <b class="blue">@lang('imet-core::common.methodology')</b>
            @if(is_array($definitions['module_info_EvaluationQuestion']))
                <ul>
                    @foreach($definitions['module_info_EvaluationQuestion'] as $method)
                        <li>{!! $method !!}</li>
                    @endforeach
                </ul>
            @else
                <ul>
                    <li>{!! $definitions['module_info_EvaluationQuestion'] !!}</li>
                </ul>
            @endif
            {{-- Criteria --}}
            @if($definitions['module_info_Rating']!==null)
                <b class="blue">@lang('imet-core::common.criteria')</b>
                @if(is_array($definitions['module_info_Rating']))
                    <ul>
                        @foreach($definitions['module_info_Rating'] as $criteria)
                            <li>{!! $criteria !!}</li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li>{!! $definitions['module_info_Rating'] !!}</li>
                    </ul>
                @endif
            @endif
        </div>
    </div>
@endif


@if($definitions['ratingLegend']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \ModularForms\Helpers\Template::icon('star', '', '1.4em') !!}
        </div>
        <div class="message flex flex-row gap-5">
            @foreach($definitions['ratingLegend'] as $field_name => $ratingLegend)
                <div class="rating-container flex-col">
                    @foreach ($definitions['fields'] as $field)
                        @if($field_name === $field['name'])
                            <div class="blue">{{ $field['label'] }}</div>
                        @endif
                    @endforeach
                    @foreach ($definitions['common_fields'] as $field)
                        @if($field_name === $field['name'])
                            <div class="blue">{{ $field['label'] }}</div>:
                        @endif
                    @endforeach
                    @foreach($ratingLegend as $rating=>$label)
                        <div class="flex flex-row gap-2">
                            <div class="rating field-edit @if(\Illuminate\Support\Str::contains($rating, 'N')) ratingNa @else ratingNum @endif !w-fit !px-1.5">{{ $rating }}</div>
                            <div class="font-normal">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif

{{-- Fields definitions (defined in Analysis Report) --}}
@if(array_key_exists('fieldsDefinitions', $definitions) && $definitions['fieldsDefinitions']!==null)
    <div class="module-bar info-black-bar">
        <div class="w-3"></div>
        <div>
            <div>@lang('imet-core::v2_report.definitions')</div>
            <ul class="message ml-6">
                @foreach($definitions['fieldsDefinitions'] as $field_name => $field_definition)
                    <li class="font-normal">{!! $field_definition !!}</li>
              @endforeach
            </ul>
        </div>
    </div>
@endif
