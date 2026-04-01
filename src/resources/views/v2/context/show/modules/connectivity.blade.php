<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\Components\Modules\ImetModule;

$definitions['label_width'] = 7;

?>

<h5>@lang('imet-core::v2_context.Connectivity.connectivity_title')</h5>

@foreach($definitions['fields'] as $i => $field)

    <div class="module-row !mb-4">

        {{-- label  --}}
        <div class="module-row__label !w-2/5">
            <label for="{{ $field['name'] }}">{!! ucfirst( $field['label'] ?? '') !!}</label>
            <div class="italic">@lang('imet-core::v2_context.Connectivity.sub_titles.' . $field['name'])</div>
        </div>

        <x-imet-core::custom-input-preview
                :type="$field['type']"
                :value="$records[0][$field['name']]"
        ></x-imet-core::custom-input-preview>

    </div>

@endforeach

<div class="module-row !mb-4">
    <div class="module-row__label !w-2/5">
        <div class="font-bold">@lang('imet-core::v2_context.Connectivity.link_to_me')</div>
    </div>
    <div>
        @lang('imet-core::v2_context.Connectivity.link_to_me_details')
    </div>
</div>

@push('scripts')
    <style lang="postcss">
        #module_{{ $definitions['slug'] }}  {

            ul {
                margin-left: 40px;
            }

            .info-bar .message {

                color: oklch(21% 0.034 264.665); /* tailwind text-gray-900; */

                .blue {
                    color: oklch(48.8% 0.243 264.376);
                }

            }
        }
    </style>
@endpush
