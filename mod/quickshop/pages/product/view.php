<?php

$category_guid = get_input('category_guid');
$category = get_entity($category_guid);

quickshop_categories_breadcrumbs($category);
elgg_push_breadcrumb($category->title);

$title = elgg_echo('quickshop:category:title', array($category->title));

$content = quickshop_list_alpha_category_products($category);

if (!$content) {
  $content .= elgg_echo('quickshop:product_category:no_results');
}
else {
  $content .= $products;
}

$layout = elgg_view_layout('one_sidebar', array(
	'title' => elgg_view_title($title),
	'content' => $content,
));

echo elgg_view_page($title, $layout);