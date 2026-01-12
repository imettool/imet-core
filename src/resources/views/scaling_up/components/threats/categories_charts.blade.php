<div v-for="(value, index) in values.props.values" class="align-items-center">
    <div :id="'{{$name}}-x-'+index">
        <container_actions :data="value"
                           :name="'{{$name}}-x-'+index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{$exclude_elements}}'">
            <template v-slot:default="v">
                <bar_reverse
                    :title_data="'{{ucfirst(trans('imet-core::v2_common.steps.threats'))}}'"
                    :title="(index+1)+'. '+ container.props.stores.BaseStore.localization(`imet-core::v2_context.MenacesPressions.categories.title${index+1}`)"
                    :show_legends="true"
                    :rotate="0"
                    :values="value.map(item => item.value)"
                    :colors="['5C7BD9']"
                    :fields="value.map(item => item.name)">
                </bar_reverse>
            </template>
        </container_actions>
    </div>
</div>

