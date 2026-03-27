<?php
/** @phpstan-var string $value  */

use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Species;

if (Species::isTaxonomy($value)) {
    $taxonomy = Species::parseTaxonomy($value);
    $value = $taxonomy['genus'] . ' ' . $taxonomy['species'];
} elseif (array_key_exists($value, SelectionList::getList('ImetV2_Habitats'))) {
    $value = SelectionList::getLabel('ImetV2_Habitats', $value);
}

?>

<div class="field-preview">
    {!! $value ?? '&nbsp;' !!}
</div>
