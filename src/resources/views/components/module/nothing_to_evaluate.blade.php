<?php
/** @var ?string $num_cols  */
/** @var ?string $mode [optional]  */

use ModularForms\Enums\ModuleViewModes;

$num_cols ??= 3;
$mode ??= ModuleViewModes::EDIT;

?>

<tbody {{ $mode===ModuleViewModes::EDIT ? 'v-else' : '' }}>
    <tr>
        <td colspan="{{ $num_cols }}" class="py-4">
            <div class="nothing_to_evaluate">
                @lang('imet-core::common.nothing_to_evaluate')
            </div>
        </td>
    </tr>
</tbody>
