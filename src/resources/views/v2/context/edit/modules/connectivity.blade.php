<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

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

        {{-- input field --}}
        @include('modular-forms::module.edit.field.module-to-vue', [
            'definitions' => $definitions,
            'field' => $field,
            'vue_record_index' => 0
        ])
    </div>

@endforeach

<x-modular-forms::module.components.script
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>

@push('scripts')
    <style lang="postcss">
        #module_{{ $definitions['slug'] }}  {

            ul {
                margin-left: 40px;
            }

            .info-bar .message {

                color: oklch(21% 0.034 264.665); /* tailwind text-gray-900; */

                ol {
                    margin-left: 20px;

                    ul {
                        margin-left: 20px;
                    }
                }

                .blue {
                    color: oklch(48.8% 0.243 264.376);
                }

            }
        }

    </style>
@endpush
