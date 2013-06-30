<?php

$product = $vars['entity'];
$cart = $vars['cart'];
$group = $cart->getGroup();

$icon = elgg_view_entity_icon($product, 'small');
$title = $product->title;
$desc = elgg_view('output/longtext', array(
    'value' => elgg_get_excerpt($product->description, 200),
    'class' => 'elgg-subtext'
));

$attr = 'quantity_' . $product->guid;
$quantity = $cart->$attr ? $cart->$attr : 1;

$cost = quickshop_get_group_money_symbol($group) . quickshop_format_monetary_value($product->sell_price * $quantity);

$qty_input = elgg_view('input/text', array(
    'name' => $attr,
    'value' => $quantity,
    'class' => 'qs-cart-qty',
    'maxlength' => 4
));

$remove = elgg_view('output/url', array(
    'text' => '<span class="elgg-icon elgg-icon-delete"></span>',
    'href' => 'action/removefromcart?guid=' . $product->guid,
    'is_action' => true
));
?>

<div class="qs-cart-listing clearfix">
    <div class="qs-cart-listing-icon">
        <?php echo $icon; ?>
    </div>
    <div class="qs-cart-listing-desc">
        <?php echo $title . $desc; ?>
    </div>
    <div class="qs-cart-listing-qty">
        <?php echo elgg_echo('qs:qty') . $qty_input; ?>
    </div>
    <div class="qs-cart-listing-price">
        <?php echo quickshop_get_group_money_symbol($group) . $product->sell_price; ?>
    </div>
    <div class="qs-cart-listing-total">
        <?php echo $cost; ?>
    </div>
    <div class="qs-cart-listing-actions">
        <?php echo $remove; ?>
    </div>
</div>