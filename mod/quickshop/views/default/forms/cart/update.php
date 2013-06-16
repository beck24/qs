<?php

$cart = $vars['entity'];

$products = $cart->getItems();

if (!$products) {
    elgg_echo('qs:cart:no:products');
    return;
}

foreach ($products as $product) {
    echo elgg_view('object/product/cart_item', array(
        'entity' => $product,
        'cart' => $cart,
        ));
}

echo elgg_view('object/qscart/subtotal', $vars);

echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $cart->container_guid));
echo elgg_view('input/submit', array('value' => elgg_echo('qs:cart:update')));
echo '</div>';