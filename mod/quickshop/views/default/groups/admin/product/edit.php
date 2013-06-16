<?php

$guid = get_input('guid');
$product = get_entity($guid);

if ($product->container_guid != $vars['entity']->guid) {
    // this product is not part of this group
    register_error(elgg_echo('qs:invalid:guid'));
    forward(REFERER);
}

echo elgg_view_form('product/edit', array(), array(
	'group' => $vars['entity'],
	'entity' => $product
));