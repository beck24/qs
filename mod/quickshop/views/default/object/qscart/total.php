<?php
    $cart = $vars['cart'];
    $total = $cart->getTotal();
    
    echo elgg_view('object/qscart/line_item', array(
        'description' => elgg_echo('quickshop:total'),
        'total' => quickshop_format_monetary_value($total)
    ));
