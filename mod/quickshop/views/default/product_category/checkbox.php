<?php

// this view calls itself recursively to build a tree of categories

$container = $vars['container'];
$product = $vars['product'];

// get subcategories
$subcategories = quickshop_get_alpha_categories($container);

if ($subcategories) {
  echo '<ul class="product-category-checkbox">';
  foreach ($subcategories as $subcategory) {
	echo '<li>';
    $options = array(
		'name' => 'product_category[]',
		'value' => $subcategory->guid,
		'default' => false
	);
    
    if ($subcategory->hasProduct($product)) {
        $options['checked'] = 'checked';
    }
	echo elgg_view('input/checkbox', $options);
    echo $subcategory->title;
	echo elgg_view('product_category/checkbox', array('container' => $subcategory, 'product' => $product));
	echo '</li>';
  }
  echo '</ul>';

}