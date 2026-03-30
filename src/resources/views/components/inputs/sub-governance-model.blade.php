<dropdown
    :data-values=sub_gov_options
    v-show="records[0].GovernanceModel!==null && records[0].GovernanceModel!=='not_reported'"
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></dropdown>
