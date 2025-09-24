<selector-wdpa
    {!! $vue_attributes !!}
    search-url="{{ route('imet-core::selector.pas.search') }}"
    label-url="{{ route('imet-core::selector.pas.labels') }}"
    :data-countries='@json(\ImetCore\Models\ProtectedArea::getCountries()
                ->sortBy('name_'.\ModularForms\Helpers\Locale::lower())
                ->pluck('name_'.\ModularForms\Helpers\Locale::lower(), 'iso3')
                ->toArray(), JSON_HEX_APOS)'
></selector-wdpa>
