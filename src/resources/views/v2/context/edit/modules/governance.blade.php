<?php
/** @var Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Helpers\SelectionList;
use ModularForms\Enums\ModuleViewModes;

$vueData['SubGovernanceModel_SelectionList'] = SelectionList::getCustomList('ImetOECM_SubGovernanceModel');

?>
<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.governance')</div>
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.partnership')</div>
@include('modular-forms::module.edit.type.accordion', compact(['collection', 'vueData', 'definitions']))


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.Governance(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
