<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\BoundaryLevel;
use Illuminate\Support\Facades\View;

$module->vueData['marine_predefined'] = BoundaryLevel::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', ['definitions' => $definitions])->render();

// Inject marine icon on criteria
$view = $module::injectIconToPredefinedCriteriaWithVue($module::MARINE, $view, "is_marine(item['Adequacy'])");
?>

@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<br/>

{!! $view !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.BoundaryLevel(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
