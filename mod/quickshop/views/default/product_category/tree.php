<?php

// this view calls itself recursively to build a tree of categories

$group = elgg_get_page_owner_entity();
$category = $vars['category'];

if (!elgg_instanceof($group, 'group')) {
  return true;
}

if (!$category) {
  // we're at the top level
  $category = $group;
  $count = quickshop_get_alpha_categories($category, array('count' => true));
  
  if ($count) {
	// we have stuff to show
	echo '<h3>' . elgg_echo('quickshop:product_categories:title') . '</h3>';
  }
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
		  'href' => elgg_get_site_url() . 'groups/category/edit/' . $subcategory->guid
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
}