<?php

$guid = get_input('guid');
$group = get_entity($guid);

if (!elgg_instanceof($group, 'group')) {
    register_error(elgg_echo('qs:invalid:guid'));
    forward(REFERER);
}

$cart = quickshop_get_cart($group);

if ($cart) {
    $products = $cart->getItems();
    
    foreach ($products as $product) {
        $attr = 'quantity_' . $product->guid;
        
        $qty = get_input($attr, 1);
        if (!is_numeric($qty)) {
            register_error(elgg_echo('qs:quantity:numeric'));
            continue; // do nothing
        }
        
        $qty = round($qty);
        
        if ($qty <= 0) {
            $cart->removeItem($product);
            $cart->$attr = 1;
        }
        else {
            $cart->$attr = $qty;
        }
    }
}

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