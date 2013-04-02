<?php

$guid = get_input('guid');
$category = get_entity($guid);

if (!$category || !$category->canEdit() || !elgg_instanceof($category, 'object', 'product_category')) {
  register_error(elgg_echo('quickshop:product_category:error:invalid'));
  forward(REFERER);
}

$group = quickshop_get_group_by_category($category);

$category->delete();

system_message(elgg_echo('quickshop:product_category:sm:deleted'));
forward($group->getURL());