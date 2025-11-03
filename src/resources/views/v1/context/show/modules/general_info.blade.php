<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */
/** @var mixed $item */

    if(\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)){
        $pa = \ImetCore\Models\ProtectedAreaNonWdpa::query()->find($item->wdpa_id);
    } else {
        $pa = \ImetCore\Models\ProtectedArea::getByWdpa($item->wdpa_id);
    }

    if($pa!==null){
        $vueData['records'][0]['CompleteName'] ??= $pa->name;
        $vueData['records'][0]['WDPA'] ??= $pa->wdpa_id;
        $vueData['records'][0]['IUCNCategory1'] ??= $pa->iucn_category;
        $vueData['records'][0]['Country'] ??= $pa->country;
        $vueData['records'][0]['CreationYear'] ??= $pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null;
    }

?>
@include('modular-forms::module.show.body',  compact(['collection', 'definitions']))
