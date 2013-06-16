<?php

$guid = get_input('guid');
$category = get_entity($guid);
$container = $category->getGroup();

if (!elgg_instanceof($category, 'object', 'product_category') || ($container->guid != $vars['entity']->guid)) {
    register_error(elgg_echo('qs:invalid:guid'));
    forward(REFERER);
}

echo elgg_view_form('product_category/edit', array(), array(
	'group' => $vars['entity'],
	'category' => $category
));