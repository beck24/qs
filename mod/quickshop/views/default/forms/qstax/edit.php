<?php

$group = $vars['group'];
$tax = $vars['entity'];

echo '<label>' . elgg_echo('qs:tax:label:admin:title') . '</label>';
echo elgg_view('input/text', array(
    'name' => 'title',
    'value' => $tax ? $tax->title : ''
));

echo '<br><br>';

echo '<label>' . elgg_echo('qs:tax:label:description') . '</label>';
echo elgg_view('input/text', array(
    'name' => 'description',
    'value' => $tax ? $tax->description : ''
));

