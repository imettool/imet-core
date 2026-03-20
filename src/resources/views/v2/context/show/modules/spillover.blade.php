<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

?>

@foreach($definitions['fields'] as $i => $field)

    <!-- Add section titles -->
    @if($field['name']==='SupportingEvidence')
        <h3>@lang('imet-core::v2_context.Spillover.other_labels.SupportingTitle')</h3>
        <p class="mb-6">@lang('imet-core::v2_context.Spillover.other_labels.SupportingSubTitle')</p>
    @elseif($field['name']==='ProvisioningEvidence')
        <h3>@lang('imet-core::v2_context.Spillover.other_labels.ProvisioningTitle')</h3>
        <p class="mb-6">@lang('imet-core::v2_context.Spillover.other_labels.ProvisioningSubTitle')</p>
    @endif

    @if(($field['name']==='SupportingOtherObservation' && $records[0]['SupportingKeyObservations']==='other')
        || ($field['name']==='ProvisioningOtherObservation' && $records[0]['ProvisioningKeyObservations']==='other')
        || ($field['name']!=='SupportingOtherObservation' && $field['name']!=='ProvisioningOtherObservation'))

        <div class="module-row !mb-4">

            {{-- label  --}}
            <div class="module-row__label !w-2/5">
                <label for="{{ $field['name'] }}">{!! ucfirst( $field['label']) !!}</label>
                @if(!Str::contains($field['name'], 'Comments') && !Str::contains($field['name'], 'OtherObservation'))
                    <div class="italic">@lang('imet-core::v2_context.Spillover.sub_titles.' . $field['name'])</div>
                @endif
            </div>

            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$records[0][$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>

        </div>
    @endif

@endforeach



@push('scripts')
    <style lang="postcss">
        #module_imet__v2__context__spillover .info-bar .message{
            color: oklch(21% 0.034 264.665);    /* tailwind text-gray-900; */
            .blue {
                color: oklch(48.8% 0.243 264.376);
            }
            ol{
                margin-left: 20px;
                ul{
                    margin-left: 20px;
                }
            }
        }
    </style>

@endpush
