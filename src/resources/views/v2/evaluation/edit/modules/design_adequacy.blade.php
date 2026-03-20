<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v2\Imet_Eval;
use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\DesignAdequacy;
use Illuminate\Support\Facades\View;

$module->vueData['marine_predefined'] = DesignAdequacy::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', ['definitions' => $definitions])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Values'])");

?>

{!! $view !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.DesignAdequacy(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
