<?php

$scrollButtons = [
    'ar1' => 'AR.1',
    'ar2' => 'AR.2',
    'ar3' => 'AR.3',
    'ar4' => 'AR.4',
    'ar5' => 'AR.5',
    'ar6' => 'AR.6'
];

?>

<div class="sideButtons collapsible">
    <div class="text-base" onclick="window.ModularForms.Helpers.Animation.scrollPageTo(0)">{!! ModularForms\Helpers\Template::icon('arrow-up') !!}</div>
    <div class="hiddenOnHover" style="height: 40px"></div>
        @foreach($scrollButtons as $anchor => $label)
            <div class="text-base hiddenByDefault" onclick="window.ModularForms.Helpers.Animation.scrollPageToAnchor('{{ $anchor }}')">{{ $label }}</div>
        @endforeach
    <div class="text-base" onclick="window.ModularForms.Helpers.Animation.scrollPageTo(document.body.scrollHeight)">{!! ModularForms\Helpers\Template::icon('arrow-down') !!}</div>
</div>

