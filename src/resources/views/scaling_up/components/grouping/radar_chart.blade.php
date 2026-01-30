<div v-if="container.props.stores.BaseStore.is_visible(data_elements.props.radar)"
     :name="'grouping'"
     class="mb-3">
    <scaling-radar
        :width="1128"
        :height="700"
        :event_key="'grouping'"
        :single="false"
        :unselect_legends_on_load="false"
        :show_legends="true"
        :values="data_elements.props.radar"
        :indicators="container.props.config.indicators">
    </scaling-radar>

    <datatable-interact-with-radar
        :default_order="'name'"
        :event_key="'grouping'"
        :values_with_indicators_keys="true"
        :values="data_elements.props.radar"
        :columns="container.props.config.group_analysis_on_demand.columns">
    </datatable-interact-with-radar>
</div>

