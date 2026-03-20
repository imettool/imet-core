<?php
/** @var Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_definitions = $definitions;

// First group: nothing to change
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$first_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Second groups: hidden importance rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][1]['type'] = 'hidden';
$second_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');
?>

{!! $dom->saveHTML() !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.evaluation.KeyElements(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
