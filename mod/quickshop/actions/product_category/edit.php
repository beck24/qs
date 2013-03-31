<?php

$guid = get_input('guid');
$container_guid = get_input('container_guid');
$title = get_input('title');

$category = get_entity($guid);
$container = get_entity($container_guid);

$action = 'edit';

if ($category && !elgg_instanceof($category, 'object', 'product_category')) {
  register_error(elgg_echo('quickshop:product_category:error:invalid'));
  forward(REFERER);
}

if (!$container || !$container->canEdit()) {
  register_error(elgg_echo('quickshop:product_category:error:invalid:container'));
  forward(REFERER);
}

// check to make sure the container isn't a subcategory of the category being moved
if ($category && ($container_guid == $guid || quickshop_is_subcategory($category, $container))) {
  register_error(elgg_echo('quickshop:product_category:error:container_circle'));
  forward(REFERER);
}

if (!$category) {
  $action = 'add';
  $category = new ElggObject();
  $category->subtype = 'product_category';
  $category->owner_guid = elgg_get_logged_in_user_guid();
  $category->access_id = ACCESS_PUBLIC;
  $category->description = '';
}

$category->container_guid = $container->guid;
$category->title = trim(elgg_strip_tags($title));

$category->save();

system_message(elgg_echo("quickshop:product_category:{$action}:success"));

forward(REFERER);
