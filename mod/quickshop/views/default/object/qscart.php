<?php
$group = elgg_get_page_owner_entity();

// checkout
$cart = $vars['entity'];

echo elgg_view('output/longtext', array(
    'value' => elgg_echo('qs:view:cart:help'),
    'class' => 'elgg-subtext'
));

echo elgg_view_form('cart/update', array(), $vars);


echo '<hr>';

echo elgg_view('output/url', array(
    'text' => elgg_echo('qs:proceed:to:checkout'),
    'href' => elgg_get_site_url() . "groups/{$group->identifier}/checkout"
));