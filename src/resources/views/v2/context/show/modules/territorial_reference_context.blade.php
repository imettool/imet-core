<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

$definitions['label_width'] = 7;

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;

?>

@foreach($definitions['fields'] as $i => $field)

    @if($field['name']==='FunctionalKm2')

        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.FunctionalEcosystemArea')</h3>

        <div class="module-row">

            {{-- label  --}}
            <div class="module-row__label" style="width: {{ round(100/12*$definitions['label_width']) }}%;">
                <label for="FunctionalKm2">{!! ucfirst(trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalArea')) !!}</label>
            </div>

            {{-- input field --}}
            <div  class="module-row__input" style="display: flex; align-items: center;">
                <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][$i]['type']"
                    :value="$records[0][$definitions['fields'][$i]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                &nbsp;[km2]&nbsp;&nbsp;
                <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][$i+1]['type']"
                    :value="$records[0][$definitions['fields'][$i+1]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                &nbsp;[km]
            </div>

        </div>

    @elseif($field['name']==='BenefitKm2')

        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.BenefitsOfEcosystemServicesArea')</h3>

        <div class="module-row">

            {{-- label  --}}
            <div class="module-row__label" style="width: {{ round(100/12*$definitions['label_width']) }}%;">
                <label for="FunctionalKm2">{!! ucfirst(trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitArea')) !!}</label>
            </div>

            {{-- input field --}}
            <div  class="module-row__input" style="display: flex; align-items: center;">
                <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][$i]['type']"
                    :value="$records[0][$definitions['fields'][$i]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                &nbsp;[km2]&nbsp;&nbsp;
                <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][$i+1]['type']"
                    :value="$records[0][$definitions['fields'][$i+1]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                &nbsp;[km]
            </div>

        </div>

    @elseif($field['name'] === 'BenefitSocioEconomicAspects')

        <div class="font-weight-bold">{{ $field['label'] }}</div>
        <div class="BenefitSocioEconomicAspects">
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$records[0][$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        </div>

    @elseif($field['name'] === 'DocumentedConnectivity'
        || $field['name'] === 'EvidenceOfConnectivity'
        || $field['name'] === 'EvidencesListConnectivity'
        || $field['name'] === 'ConnectivityIntegrationInManagementPlan')

        @if($field['name'] === 'DocumentedConnectivity')
            <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.Connectivity')</h3>
            <div class="Connectivity">
                @lang('imet-core::v2_context.TerritorialReferenceContext.connectivity_info')
            </div>
        @endif

        <div class="module-row !mb-4">

            {{-- label  --}}
            <div class="module-row__label !w-2/5">
                <label for="{{ $field['name'] }}"
                       @if($field['name'] === 'EvidencesListConnectivity') class="!font-normal" @endif
                >{!! ucfirst( $field['label']) !!}</label>
            </div>

            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$records[0][$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>


        </div>

    @elseif($field['name']!=='FunctionalKm'
            and $field['name']!=='BenefitKm')

        @component('modular-forms::module.components.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$records[0][$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>

        @endcomponent

    @endif

@endforeach

@push('scripts')
    <style lang="postcss">
        #module_imet__v2__context__territorial_reference_context{
            .BenefitSocioEconomicAspects{
                padding: 10px 10px 40px 10px;
            }
            .BenefitSocioEconomicAspects span span{
                max-width: 100%;
            }
            .Connectivity {
                ul {
                    margin-left: 20px;
                    margin-bottom: 10px;
                }
            }
        }

    </style>
@endpush
