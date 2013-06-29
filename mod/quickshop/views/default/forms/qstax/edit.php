<?php

$group = $vars['group'];
$tax = $vars['entity'];

echo '<label>' . elgg_echo('qs:tax:label:admin:title') . '</label>';
echo elgg_view('input/text', array(
    'name' => 'title',
    'value' => $tax ? $tax->title : ''
));
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:title'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

echo '<label>' . elgg_echo('qs:tax:label:description') . '</label>';
echo elgg_view('input/text', array(
    'name' => 'description',
    'value' => $tax ? $tax->description : ''
));
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:description'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

echo '<label>' . elgg_echo('qs:tax:label:taxtype') . '</label>:&nbsp;&nbsp;';
echo elgg_view('input/dropdown', array(
    'name' => 'taxtype',
    'value' => $tax ? $tax->taxtype : 'percentage',
    'options_values' => array(
        'flat' => elgg_echo('qs:tax:option:taxtype:flat'),
        'percentage' => elgg_echo('qs:tax:option:taxtype:percentage')
    )
));
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:taxtype'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

echo '<label>' . elgg_echo('qs:tax:label:rate') . '</label>';
echo elgg_view('input/text', array(
    'name' => 'rate',
    'value' => $tax ? $tax->rate : ''
));
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:rate'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

echo elgg_view('input/checkbox', array(
    'name' => 'all_products',
    'value' => 1
));
echo '<label>' . elgg_echo('qs:tax:label:all_products') . '</label>';
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:all_products'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

$options = array(
    'name' => 'default_tax',
    'value' => 1
);
if ($tax && $tax->default_tax) {
    $options['checked'] = 'checked';
}
echo elgg_view('input/checkbox', $options);
echo '<label>' . elgg_echo('qs:tax:label:default_tax') . '</label>';
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:tax:help:default_tax'),
    'class' => 'elgg-subtext'
));

if ($tax) {
    echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $tax->guid));
}

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $group->guid));

echo elgg_view('input/submit', array('value' => elgg_echo('submit')));