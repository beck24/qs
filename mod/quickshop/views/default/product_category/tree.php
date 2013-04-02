<?php

// this view calls itself recursively to build a tree of categories

$group = elgg_get_page_owner_entity();
$category = $vars['category'];

if (!elgg_instanceof($group, 'group')) {
  return true;
}

$add_new = '';
if (!$category) {
  // we're at the top level
  $category = $group;
  $all_products = elgg_view('output/url', array(
	 'text' => elgg_echo('quickshop:category:allproducts'),
	  'href' => elgg_get_site_url() . 'groups/category/all/' . $group->guid,
	  'is_trusted' => true
  ));
  $add_new = elgg_view('output/url', array(
	 'text' => elgg_echo('quickshop:category:add'),
	  'href' => elgg_get_site_url() . 'quickshop/store/category/add/' . $group->guid,
	  'class' => 'elgg-button elgg-button-action'
  ));
  
  // we have stuff to show
  echo '<h3>' . elgg_echo('quickshop:product_categories:title') . '</h3>';
  
  echo '<ul class="product_categories_menu quickshop-category-all">';
  echo '<li>' . $all_products . '</li>';
  echo '</ul>';
  
}

// get subcategories
$subcategories = quickshop_get_alpha_categories($category);

if ($subcategories) {
  echo '<ul class="product_categories_menu">';
  foreach ($subcategories as $subcategory) {
	$dropdown = '';
	if (quickshop_get_alpha_categories($subcategory, array('count' => true))) {
	  $dropdown = '<span class="elgg-icon elgg-icon-hover-menu quickshop-category-tree"></span>';
	}
	
	$edit = '';
	if ($subcategory->canEdit()) {
	  $edittext = '<span class="elgg-icon elgg-icon-settings-alt quickshop-category-edit"></span>';
	  $edit = elgg_view('output/url', array(
		 'text' => $edittext,
		  'href' => elgg_get_site_url() . 'groups/category/edit/' . $subcategory->guid,
	  ));
	}
	
	echo '<li>';
	echo elgg_view('output/url', array(
		'text' => $subcategory->title,
		'href' => $subcategory->getURL(),
		'is_trusted' => true
	));
	echo $edit;
	echo $dropdown;
	echo elgg_view('product_category/tree', array('category' => $subcategory));
	echo '</li>';
  }
  echo '</ul>';
  
  if ($add_new && $group->canEdit()) {
	echo $add_new;
  }
}