<?php

$product = $vars['entity'];

$icon = elgg_view_entity_icon($product, 'medium');

$title = elgg_view('output/url', array(
	'text' => $product->title,
	'href' => $product->getURL(),
	'is_trusted' => true
));

$description = elgg_view('output/longtext', array(
	'value' => elgg_get_excerpt($product->description, 150),
	'class' => 'elgg-subtext'
));

$entity_menu = $product->getMenu();

?>

<div class="qs-product-list">
    <div class="qs-product-list-title">
        <?php echo $title; ?>
    </div>
    <div class="qs-product-list-image">
        <?php echo $icon; ?>
    </div>
    <div class="qs-product-list-description">
        <?php echo $description; ?>
    </div>
    <div class="qs-product-list-actions">
        <?php echo $entity_menu; ?>
    </div>
</div>