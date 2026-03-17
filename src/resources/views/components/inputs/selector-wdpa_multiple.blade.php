<selector-wdpa
    {!! $vue_attributes !!}
    search-url="{{ route('imet-core::selector.pas.search') }}"
    label-url="{{ route('imet-core::selector.pas.labels') }}"
    :data-countries='@json($countries, JSON_HEX_APOS)'
    :multiple=true
></selector-wdpa>
