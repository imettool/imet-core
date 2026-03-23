<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetV1\Imet;

$imet = \ImetCore\Models\Imet\ImetV1\Imet::query()->find($module->vueData['form_id']);
if (\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa($imet->wdpa_id)) {
    $pa = \ImetCore\Models\ProtectedAreaNonWdpa::query()->find($imet->wdpa_id);
} else {
    $pa = \ImetCore\Models\ProtectedArea::getByWdpa($imet->wdpa_id);
}

if ($pa !== null) {
    $module->vueData['records'][0]['CompleteName'] ??= $pa->name;
    $module->vueData['records'][0]['WDPA'] ??= $pa->wdpa_id;
    $module->vueData['records'][0]['IUCNCategory1'] ??= $pa->iucn_category;
    $module->vueData['records'][0]['Country'] ??= $pa->country;
    $module->vueData['records'][0]['CreationYear'] ??= $pa->creation_date !== null ? substr($pa->creation_date, 0, 4) : null;
}

?>

@include('modular-forms::module.edit.type.simple', ['definitions' => $definitions])
