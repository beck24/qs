<?php

$guid = get_input('guid');

$product = get_entity($guid);

if (!elgg_instanceof($product, 'object', 'product')) {
    register_error(elgg_echo('qs:invalid:guid'));
    forward(REFERER);
}

$group = $product->getGroup();

$cart = quickshop_get_cart($group);

$ia = elgg_set_ignore_access();
if (!$cart) {
    $cart = new QScart();
    $cart->container_guid = $group->guid;
    $cart->access_id = ACCESS_PUBLIC;
    $cart->owner_guid = elgg_is_logged_in() ? elgg_get_logged_in_user_guid() : elgg_get_site_entity()->guid;
    $cart->title = '';
    $cart->description = '';
    $cart->status = 'initialized';
    $cart->save();
}

$cart->addItem($product);

elgg_set_ignore_access($ia);

$_SESSION['qscart'][$group->guid] = $cart->guid;

system_message(elgg_echo('qs:cart:item:added'));
forward(REFERER);