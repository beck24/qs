<?php
$category_guid = get_input('category_guid');
$category = get_entity($category_guid);

quickshop_categories_breadcrumbs($category);
elgg_push_breadcrumb($category->title, $category->getURL());
elgg_push_breadcrumb(elgg_echo('edit'));

$title = elgg_echo('quickshop:category:edit', array($category->title));

$content = elgg_view_form('product_category/edit', array('enctype' => 'multipart/form-data'), array(
	'group' => elgg_get_page_owner_entity(),
	'category' => $category
));

$layout = elgg_view_layout('one_sidebar', array(
	'title' => elgg_view_title($title),
	'content' => $content,
));

echo elgg_view_page($title, $layout);