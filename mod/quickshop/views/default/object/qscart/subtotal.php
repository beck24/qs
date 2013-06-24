<?php
    $cart = $vars['cart'];
    $subtotal = $cart->getSubtotal();
    
    echo elgg_view('object/qscart/line_item', array(
        'description' => elgg_echo('quickshop:subtotal'),
        'total' => quickshop_format_monetary_value($subtotal)
    ));
