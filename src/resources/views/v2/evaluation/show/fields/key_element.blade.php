<?php
/** @var String $value */

use \ModularForms\Helpers\Input\SelectionList;
use \ImetCore\Models\Species;

if (Species::isTaxonomy($value)) {
    $taxonomy = Species::parseTaxonomy($value);
    $value = $taxonomy['genus'] . ' ' . $taxonomy['species'];
} else if (array_key_exists($value, SelectionList::getList('ImetV2_Habitats'))) {
    $value = SelectionList::getLabel('ImetV2_Habitats', $value);
}

?>

<div class="field-preview">
    {!! $value ?? '&nbsp;' !!}
</div>
