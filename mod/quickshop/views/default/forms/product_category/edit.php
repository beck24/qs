<?php
$category = $vars['category'];


// title
$title_label = elgg_echo('quickshop:product_category:label:title');

$value = elgg_get_sticky_value('product_category', 'title');
if (!$value) {
  $value = $category ? $category->title : '';
}
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'value' => $value
));

$title_input .= '<br><br>';



// parent category
$categories_count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'product_category',
	'container_guid' => $vars['group']->guid,
	'count' => true
));

if (!$categories_count) {
  $parent_label = '';
  $parent_input = elgg_view('input/hidden', array(
	 'name' => 'container_guid',
	  'value' => $vars['group']->guid
  ));
}
else {
  $value = elgg_get_sticky_value('product_category', 'container_guid');
  if (!$value) {
	$value = $category ? $category->container_guid : $vars['group']->guid;
  }
  $parent_label = '<label>' . elgg_echo('quickshop:category:parent:title') . '</label><br>';
  $parent_input = elgg_view('input/dropdown', array(
	 'name' => 'container_guid',
	  'value' => $value,
	  'options_values' => quickshop_product_category_options_values($vars['group'])
  ));
  
  $parent_input .= '<br><br>';
}

$submit_input = elgg_view('input/submit', array(
	'value' => elgg_echo('submit')
));


// category input
$category_input = '';
if ($category) {
  $category_input = elgg_view('input/hidden', array(
	 'name' => 'guid',
	  'value' => $category->guid
  ));
}
?>

<label><?php echo $title_label; ?></label>
<?php

echo $title_input;

echo $parent_label;

echo $parent_input;

echo $category_input;

echo $submit_input;