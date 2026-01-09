<div v-if="container.props.stores.BaseStore.is_visible(data_elements.props.scatter)"
     :name="'grouping'"
     class="mb-3">
    <scatter
        :label_axis_y="'@lang('imet-core::common.steps_eval.context') , @lang('imet-core::common.steps_eval.planning'), @lang('imet-core::common.steps_eval.inputs')'"
        :label_axis_x="'@lang('imet-core::common.steps_eval.process')'"
        :label_axis_y2="'@lang('imet-core::common.steps_eval.outcomes'), @lang('imet-core::common.steps_eval.outputs')'"
        :label_axis_y2_show="false"
        :values="data_elements.props.scatter">
    </scatter>
</div>

<div v-if="container.props.stores.BaseStore.is_visible(data_elements.props.scatter)">
    <datatable-interact-with-scatter
        :default_order="'name'"
        :values="data_elements.props.scatter"
        :columns="container.props.config.group_analysis_on_demand.scatter_columns">
    </datatable-interact-with-scatter>
</div>

