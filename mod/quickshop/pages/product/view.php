<?php

$product_guid = get_input('product_guid');
$product = get_entity($product_guid);
$group = $product->getContainerEntity();

elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb($product->title);

$title = $product->title;

$content = elgg_view_entity($product, array(
    'full_view' => true
));

$layout = elgg_view_layout('one_sidebar', array(
	'title' => elgg_view_title($title),
	'content' => $content,
));

echo elgg_view_page($title, $layout);