<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.{{$menuKey}}"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>{{ trans('imet-core::analysis_report.guidance.info.'.$tooltipKey) }}</tooltip>
    </div>
</div>

