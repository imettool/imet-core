<selector-wdpa
    search-url="{{ route('imet-core::selector.pas.search') }}"
    label-url="{{ route('imet-core::selector.pas.labels') }}"
    :multiple=true
    {!! $vue_attributes !!}
></selector-wdpa>
