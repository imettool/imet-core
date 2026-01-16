<div v-if="tableValue['menu']['radar'] !== ''">
    @if (!$dontShowTitle)
        <div v-if="tableValue['menu']['title']"
             :id="'menu-title-'+section+'-'+tableValue['name']"
             class="horizontal">
            <div class="sub-title" v-html="tableValue['menu']['title']"></div>
        </div>
    @endif
    <div>
        <guidance :text="'imet-core::analysis_report.guidance.context.'+tableValue['key']"></guidance>
    </div>
</div>

