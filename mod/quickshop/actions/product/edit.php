<?php

$guid = get_input('guid');
$sell_price = get_input('sell_price', 0);
$title = get_input('title');
$description = get_input('description');
$tags = get_input('tags');
$container_guid = get_input('container_guid');
$access_id = get_input('access_id', ACCESS_PUBLIC);

$product = get_entity($guid);

elgg_make_sticky_form('product/edit');

$sell_price = quickshop_format_monetary_value($sell_price);

if (!is_numeric($sell_price)) {
  register_error(elgg_echo('quickshop:product:error:sell_price'));
  forward(REFERER);
}

if (empty($title)) {
  register_error(elgg_echo('quickshop:product:error:notitle'));
  forward(REFERER);
}

if ($product && !elgg_instanceof($product, 'object', 'product')) {
  register_error(elgg_echo('quickshop:product:error:notitle'));
  forward(REFERER);
}

if (!$product) {
  $product = new ElggObject();
  $product->subtype = 'product';
  $product->owner_guid = elgg_get_logged_in_user_guid();
  $product->container_guid = $container_guid;
}

$product->title = $title;
$product->description = $description;
$product->access_id = $access_id;

if (!$product->save()) {
  register_error(elgg_echo('quickshop:product:error:save'));
  forward(REFERER);
}

// save metadata
$product->sell_price = $sell_price;

elgg_clear_sticky_form('product/edit');
forward(REFERER);