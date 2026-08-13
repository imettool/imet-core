<?php
/** @var Imet $item */
/** @var string $mode */
/** @var array $cross_analysis_warnings */

use Illuminate\Support\Facades\App;
use ImetCore\Controllers\Imet\ImetV2\Controller;
use ImetCore\Models\Imet\ImetV2\Imet;
use ModularForms\Enums\ModuleViewModes;

$route = $mode === ModuleViewModes::EDIT
    ? Controller::ROUTE_PREFIX . 'evaluation_edit'
    : Controller::ROUTE_PREFIX . 'evaluation_show';

// Force Language
if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}
$i = 0;
?>
<div class="module-container">
    <div class="module-bar info-bar mt-2 mb-2 guidance">
        <div class="icon blue"><span class="fas fa-fw fa-info-circle" style="font-size: 1.4em;"></span>
        </div>
        <div class="message">
            <div>
                <span>{{trans('imet-core::common.cross_analysis_info')}}</span>
            </div>
        </div>
    </div>
</div>

<div class="imet_modules">
    @if(count($cross_analysis_warnings) > 0)
        @foreach($cross_analysis_warnings as $k => $w)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-code text-center">
                        {{$i + 1}}
                    </div>
                </div>
                <div class="module-body">
                    <table id="short_names" class="table module-table ">
                        <tbody>
                        @foreach($w as $warning)
                            <tr>
                                <td class="col-1 pr-2">{{ $warning['code'] }}</td>
                                <td class="col-11">
                                    <strong> <a
                                            href="{{ route($route, [$item->getKey(), $warning['step']]) }}#{{$warning['key']}}"
                                        >{!! $warning['question'] !!}</a>
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <?php
                $i++; ?>
        @endforeach
    @else
        <div class="text-center">{{trans('imet-core::common.nothing_found')}}</div>
    @endif
</div>

