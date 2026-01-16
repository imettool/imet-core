<div v-if="tableValue['menu']['radar'] !== ''">
    @php
        $scalingRadarId = "'{$name}-'+section+'-'+tableValue['name']+'-'+index+'scaling-radar'";
        $radarDatatableId = "'{$name}-'+section+'-'+tableValue['name']+'-'+index+'scaling-datatable-radar'";
    @endphp

    {{-- Radar Header --}}
    <div class="horizontal">
        <div class="sub-title {{$subClass}}" :id="'menu-radar-'+section+'-'+tableValue['name']">
            <span v-html="tableValue['menu']['radar']"></span>
            <button class="btn-nav small blue ml-1">
                <span class="fas fa-fw fa-info-circle"></span>
            </button>
            <tooltip>{{ trans('imet-core::analysis_report.guidance.info.radar') }}</tooltip>
        </div>
    </div>

    {{-- Radar Chart --}}
    <div :id="{{$scalingRadarId}}">
        <container_actions :data="section_data"
                           :name="{{$scalingRadarId}}"
                           :event_image="'save_entire_block_as_image'">
            <template v-slot:default="data_elements">
                <scaling_radar
                    class="sm"
                    :height="750"
                    :title="tableValue['menu']['radar']"
                    :single="false"
                    :radar_indicators_for_negative="data_elements.props[tableValue['name']].radar.radar_indicators_for_negative"
                    :radar_indicators_for_zero_negative="data_elements.props[tableValue['name']].radar.radar_indicators_zero_negative"
                    :unselect_legends_on_load="true"
                    :show_legends="true"
                    :event_key="'analysis_'+tableValue['name']"
                    :indicators="data_elements.props[tableValue['name']].radar.indicators"
                    :values="data_elements.props[tableValue['name']].radar.values">
                </scaling_radar>
                <div style="font-size: 12px">
                    {{ trans("imet-core::analysis_report.average_protected_areas") }}
                </div>
            </template>
        </container_actions>
    </div>

    {{-- Radar Datatable --}}
    <div :id="{{$radarDatatableId}}">
        <container_actions :data="section_data"
                           :name="{{$radarDatatableId}}"
                           :event_image="'save_entire_block_as_image'">
            <template v-slot:default="data_elements">
                <datatable_interact_with_radar
                    class="col-sm"
                    :event_key="'analysis_'+tableValue['name']"
                    :values="data_elements.props[tableValue['name']].radar.values"
                    :columns="container.props.stores.BaseStore.find_config_by_name(container.props.config.element_diagrams[section], tableValue['name']).columns.slice(0,-1)">
                </datatable_interact_with_radar>
            </template>
        </container_actions>
    </div>
</div>

