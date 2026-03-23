<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet;

?>

<h3>@lang('imet-core::v2_context.Governance.governance')</h3>
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])

<h3>@lang('imet-core::v2_context.Governance.partnership')</h3>
@include('modular-forms::module.show.type.accordion', ['definitions' => $definitions, 'records' => $records])
