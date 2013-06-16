<?php

$title = elgg_echo('quickshop:category:allproducts');
$group = elgg_get_page_owner_entity();

elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb($title);

if ($group->canEdit()) {
  elgg_register_title_button("groups/product");
}

$dbprefix = elgg_get_config('dbprefix');

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'product',
	'container_guid' => $group->guid,
	'full_view' => false,
	'order_by' => 'o.title ASC',
	'joins' => array("JOIN {$dbprefix}objects_entity o ON e.guid = o.guid")
));

if (!$content) {
  $content = elgg_echo('quickshop:product:noresults');
}

$body = '<div class="qs-product-list-wrapper">' . $content . '</div>';

$layout = elgg_view_layout('content', array(
	'title' => elgg_view_title($title),
	'content' => $body,
	'filter' => ''
));

echo elgg_view_page($title, $layout);