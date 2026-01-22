<selector-species
    {!! $vue_attributes !!}
    search-url="{{ route('imet-core::selector.species.search') }}"
    info-url="{{ route('imet-core::selector.species.info') }}"
    :with-insert={{ Str::contains($type, 'withInsert') ? 'true' : 'false' }}
></selector-species>
