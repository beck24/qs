<?php

$product = $vars['entity'];

$icon = elgg_view_entity_icon($product, 'small');

$link = elgg_view('output/url', array(
	'text' => $product->title,
	'href' => $product->getURL(),
	'is_trusted' => true
));

$description = elgg_view('output/longtext', array(
	'value' => elgg_get_excerpt($product->description, 150),
	'class' => 'elgg-subtext'
));

$cost = $product->sell_price;

$addtocart = $product->addToCartLink();

$entity_menu = $product->getMenu();


$body = elgg_view_image_block($icon, $link . $entity_menu . $description . $cost . $addtocart);

echo $body;