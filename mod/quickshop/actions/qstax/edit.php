<?php

$guid = get_input('guid');
$container_guid = get_input('container_guid');
$title = get_input('title');
$description = get_input('description');
$taxtype = get_input('taxtype');
$rate = get_input('rate');
$all_products = get_input('all_products');
$default_tax = get_input('default_tax');

// sanity check
if (empty($title) || empty($description) || empty($rate)) {
    register_error(elgg_echo('qs:tax:error:required_fields'));
    forward(REFERER);
}

if (!is_numeric($rate)) {
    register_error(elgg_echo('qs:tax:error:rate_numeric'));
    forward(REFERER);
}

$group = get_entity($container_guid);
if (!$group || !$group->canEdit()) {
    register_error(elgg_echo('qs:error:generic:permissions'));
    forward(REFERER);
}

if ($guid) {
    $tax = get_entity($guid);
    if (!elgg_instanceof($tax, 'object', 'qstax') || !$tax->canEdit()) {
        register_error(elgg_echo('qs:error:generic:permissions'));
        forward(REFERER);
    }
}
else {
    $tax = new QStax();
    $tax->access_id = ACCESS_PUBLIC;
    $tax->owner_guid = elgg_get_logged_in_user_guid();
    $tax->container_guid = $container_guid;
}

$tax->title = $title;
$tax->description = $description;
$tax->rate = $rate;
$tax->taxtype = $taxtype;
$tax->default_tax = $default_tax;

if (!$tax->save()) {
    register_error(elgg_echo('qs:error:generic:entity:save'));
    forward(REFERER);
}

system_message(elgg_echo('qs:tax:edit:success'));

if ($all_products) {
    // lets add this tax to all existing products
    set_time_limit(0);
    $products = quickshop_get_group_products($group);
    
    foreach ($products as $product) {
        add_entity_relationship($product->guid, QUICKSHOP_TAX_RELATIONSHIP, $tax->guid);
    }
    
    system_message(elgg_echo('qs:tax:all_products:success'));
}

forward($group->getURL() . '/admin/taxes');