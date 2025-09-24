<selector-species
    {!! $vue_attributes !!}
    search-url="{{ route('imet-core::selector.species.search') }}"
    :with-insert={{ Str::contains($type, 'withInsert') ? 'true' : 'false' }}
></selector-species>
