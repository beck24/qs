<?php

$title = elgg_echo('quickshop:product:add');
$group = elgg_get_page_owner_entity();

elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb($title);

$content = elgg_view_form('product/edit', array(), array(
	'group' => elgg_get_page_owner_entity()
));

$layout = elgg_view_layout('one_sidebar', array(
	'title' => elgg_view_title($title),
	'content' => $content,
));

echo elgg_view_page($title, $layout);