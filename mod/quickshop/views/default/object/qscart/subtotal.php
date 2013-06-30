<?php
    $cart = $vars['cart'];
    $group = $cart->getGroup();
    $subtotal = $cart->getSubtotal();
    
    echo elgg_view('object/qscart/line_item', array(
        'description' => elgg_echo('quickshop:subtotal'),
        'total' => quickshop_get_group_money_symbol($group) . quickshop_format_monetary_value($subtotal)
    ));
