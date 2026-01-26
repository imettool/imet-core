<div class="horizontal mt-1">
    <div class="sub-title {{$subClass}}" :id="'{{$idPrefix}}-'+section+'-'+tableValue['name']">
        <span v-html="tableValue['menu']['{{$menuKey}}']"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>{{ trans('imet-core::analysis_report.guidance.info.'.$tooltipKey) }}</tooltip>
    </div>
</div>

