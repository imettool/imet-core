<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\AssistanceActivities;
use Illuminate\Support\Facades\View;

$module->vueData['marine_predefined'] = AssistanceActivities::get_marine_predefined();
$module->vueData['terrestrial_predefined'] = AssistanceActivities::get_terrestrial_predefined();

$view = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::TERRESTRIAL, $view, "is_terrestrial(item['Activity'])");
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Activity'])");

?>

{!! $view !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.AssistanceActivities(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
