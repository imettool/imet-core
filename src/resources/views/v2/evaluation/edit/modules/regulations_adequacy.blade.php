<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\RegulationsAdequacy;
use Illuminate\Support\Facades\View;

$module->vueData['marine_predefined'] = RegulationsAdequacy::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', ['definitions' => $definitions])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Regulation'])");

?>

{!! $view !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.RegulationsAdequacy(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
