<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Imet\v2\Imet;
use ModularForms\Enums\ModuleViewModes;

$module->vueData['SubGovernanceModel_SelectionList'] = SelectionList::getList('ImetOECM_SubGovernanceModel');

?>
<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.governance')</div>
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.partnership')</div>
@include('modular-forms::module.edit.type.accordion', ['definitions' => $definitions])


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.Governance(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
