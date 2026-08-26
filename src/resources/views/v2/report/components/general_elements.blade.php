<?php
/** @var Imet_Report $item */

use ImetCore\Models\Country;
use ImetCore\Models\Imet\ImetV2\Imet_Report;
use ImetCore\Models\Imet\ImetV2\Modules\Context\Areas;
use ImetCore\Models\Imet\ImetV2\Modules\Context\GeneralInfo;
use ImetCore\Models\Imet\ImetV2\Modules\Context\Missions;
use ImetCore\Models\ProtectedAreaNonWdpa;

$general_info = GeneralInfo::getModuleRecords($item->getKey())['records'][0] ?? null;
$area = Areas::getArea($item->getKey()) ?? null;
$vision_objectives = Missions::getModuleRecords($item->getKey())['records'][0] ?? null;

?>



<div class="module-container">
    <div class="module-header">
        <div class="module-title">@lang('imet-core::v2_report.general_elements')</div>
    </div>
    <div class="module-body">
        <div class="grid grid-flow-col grid-rows-4 gap-4">
            <div>
                <div class="strong">@lang('imet-core::v2_report.country')</div>
                <span class="italic">
                    {{ !empty($general_info['Country']) ? Country::getByISO($general_info['Country'])?->name : '-' }}
                </span></div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.name')</div>
                <span class="italic">{{ $general_info['CompleteName'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.category')</div>
                <span class="italic">{{ $general_info['NationalCategory'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.gazetting')</div>
                <span class="italic">{{ $general_info['CreationYear'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.surface'):</div>
                <span class="italic">{{ $area ?? '-' }} [km2]</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.agency')</div>
                <span class="italic">{{ $general_info['Institution'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.biome')</div>
                <span class="italic">{{ $general_info['Biome'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.main_values_protected')</div>
                <span class="italic">{{ $general_info['ReferenceTextValues'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.vision')</div>
                <span class="italic">{{ $vision_objectives['LocalVision'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.mission')</div>
                <span class="italic">{{ $vision_objectives['LocalMission'] ?? '-' }}</span>
            </div>
            <div>
                <div class="strong">@lang('imet-core::v2_report.objectives')</div>
                <span class="italic">{{ $vision_objectives['LocalObjective'] ?? '-' }}</span>
            </div>
        </div>
    </div>
</div>

