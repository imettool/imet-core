<?php

switch ($value) {
    case null:
    case '':
        $color = '#efeff2';
        break;
    case 0:
        $color = '#FFFFFF';
        break;
    case 1:
        $color = '#FFE25A';
        break;
    case 2:
        $color = '#FBA63C';
        break;
    case 3:
        $color = '#E5483B';
        break;
    case 4:
        $color = '#7C1D2E';
        break;
}


?>

<div class="field-preview" style="background-color: {{ $color }}">
    {!! $value !!}
</div>
