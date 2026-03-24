<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV1\Imet;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\ProtectedAreaNonWdpa;

$imet = Imet::query()->find($module->vueData['form_id']);

if (ProtectedAreaNonWdpa::isNonWdpa($imet->wdpa_id)) {
    $pa = ProtectedAreaNonWdpa::query()->find($imet->wdpa_id);
} else {
    $pa = ProtectedArea::getByWdpa($imet->wdpa_id);
}

if ($pa !== null) {
    $module->vueData['records'][0]['CompleteName'] ??= $pa->name;
    $module->vueData['records'][0]['WDPA'] ??= $pa->wdpa_id;
    $module->vueData['records'][0]['IUCNCategory1'] ??= $pa->iucn_category;
    $module->vueData['records'][0]['Country'] ??= $pa->country;
    $module->vueData['records'][0]['CreationYear'] ??= $pa->creation_date !== null ? substr($pa->creation_date, 0, 4) : null;
}

?>

@include('modular-forms::module.show.type.simple', ['definitions' => $definitions, 'records' => $records])
