<?php

$guid = get_input('guid');
$product = get_entity($guid);

if (!elgg_instanceof($product, 'object', 'product')) {
    register_error(elgg_echo('qs:invalid:guid'));
    forward(REFERER);
}

$group = $product->getGroup();

$cart = quickshop_get_cart($group);

$cart->removeItem($product);

if (!$cart->getItems()) {
    // there are no items in the cart, lets delete it
    $ia = elgg_set_ignore_access();
    unset($_SESSION['qscart'][$group->guid]);
    $cart->delete();
    elgg_set_ignore_access($ia);
    
    system_message(elgg_echo('qs:remove:empty:cart'));
    forward($group->getURL());
}

forward(REFERER);