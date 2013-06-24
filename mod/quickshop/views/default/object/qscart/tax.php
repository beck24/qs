<?php
    $cart = $vars['cart'];
    $tax = $cart->getTax();
    
    foreach ($tax as $description => $total) {
        echo elgg_view('object/qscart/line_item', array(
            'description' => $description,
            'total' => $total
        ));
    }
