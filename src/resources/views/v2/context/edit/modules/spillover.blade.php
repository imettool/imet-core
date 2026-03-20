<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use ImetCore\Models\Imet\v2\Imet;

?>

@foreach($definitions['fields'] as $field)

    <!-- Add section titles -->
    @if($field['name']==='SupportingEvidence')
        <h3>@lang('imet-core::v2_context.Spillover.other_labels.SupportingTitle')</h3>
        <p class="mb-6">@lang('imet-core::v2_context.Spillover.other_labels.SupportingSubTitle')</p>
    @elseif($field['name']==='ProvisioningEvidence')
        <h3>@lang('imet-core::v2_context.Spillover.other_labels.ProvisioningTitle')</h3>
        <p class="mb-6">@lang('imet-core::v2_context.Spillover.other_labels.ProvisioningSubTitle')</p>
    @endif

    @if($field['name']==='SupportingOtherObservation')
        <div class="module-row !mb-4" v-if="show_other_obs_supporting">
            @elseif($field['name']==='ProvisioningOtherObservation')
                <div class="module-row !mb-4" v-if="show_other_obs_provisioning">
                    @else
                        <div class="module-row !mb-4">
                            @endif

                            {{-- label  --}}
                            <div class="module-row__label !w-2/5">
                                <label for="{{ $field['name'] }}">{!! ucfirst( $field['label']) !!}</label>
                                @if(!Str::contains($field['name'], 'Comments') && !Str::contains($field['name'], 'OtherObservation'))
                                    <div
                                        class="italic">@lang('imet-core::v2_context.Spillover.sub_titles.' . $field['name'])</div>
                                @endif
                            </div>

                            {{-- input field --}}
                            @include('modular-forms::module.edit.field.module-to-vue', [
                                'definitions' => $definitions,
                                'field' => $field,
                                'vue_record_index' => 0
                            ])

                        </div>


                        @endforeach


                        @push('scripts')
                            <style lang="postcss">
                                #module_imet__v2__context__spillover .info-bar .message {
                                    color: oklch(21% 0.034 264.665); /* tailwind text-gray-900; */

                                    .blue {
                                        color: oklch(48.8% 0.243 264.376);
                                    }

                                    ol {
                                        margin-left: 20px;

                                        ul {
                                            margin-left: 20px;
                                        }
                                    }
                                }
                            </style>

                            <script type="module">
                                (new window.ImetCore.Apps.Modules.ImetV2.context.Spillover(@json($module->vueData)))
                                    .mount('#module_{{ $definitions['slug'] }}');
                            </script>
        @endpush

