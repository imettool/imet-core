
<?php
$processElements = [
    ['id' => 'process', 'type' => 'process'],
    ['id' => 'process_PRA', 'type' => 'process_PRA'],
    ['id' => 'process_PRB', 'type' => 'process_PRB'],
    ['id' => 'process_PRC', 'type' => 'process_PRC'],
    ['id' => 'process_PRD', 'type' => 'process_PRD'],
    ['id' => 'process_PRE', 'type' => 'process_PRE'],
    ['id' => 'process_PRF', 'type' => 'process_PRF'],
];
?>

@foreach($processElements as $element)
    @include('imet-core::scaling_up.components.process.process_sub_element', [
        'id' => $element['id'],
        'type' => $element['type'],
        'name' => $name,
        'custom_names' => $custom_names,
        'url' => $url
    ])
@endforeach

