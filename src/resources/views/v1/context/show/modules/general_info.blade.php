<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */
/** @var mixed $item */

use ImetCore\Models\Imet\v1\Imet;

    if(\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)){
        $pa = \ImetCore\Models\ProtectedAreaNonWdpa::query()->find($item->wdpa_id);
    } else {
        $pa = \ImetCore\Models\ProtectedArea::getByWdpa($item->wdpa_id);
    }

    if($pa!==null){
        $module->vueData['records'][0]['CompleteName'] ??= $pa->name;
        $module->vueData['records'][0]['WDPA'] ??= $pa->wdpa_id;
        $module->vueData['records'][0]['IUCNCategory1'] ??= $pa->iucn_category;
        $module->vueData['records'][0]['Country'] ??= $pa->country;
        $module->vueData['records'][0]['CreationYear'] ??= $pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null;
    }

?>

@include('modular-forms::module.show.type.simple', ['definitions' => $definitions, 'records' => $records])
