<?php

/**
 * Registers breadcrumb navigatio
 * 
 * @param type $category
 */
function quickshop_categories_breadcrumbs($category) {
  // get all parent categories up to the group
  $group = quickshop_get_group_by_category($category);
  
  elgg_push_breadcrumb($group->name, $group->getURL());
  
  $parents = array();
  while ($parent = get_entity($category->container_guid)) {
	if ($parent->guid == $group->guid) {
	  break;
	}
	
	$parents[] = $parent;
	$category = $parent;
  }
  
  $parents = array_reverse($parents);
  
  foreach ($parents as $parent) {
	elgg_push_breadcrumb($parent->title, $parent->getURL());
  }
}


function quickshop_format_monetary_value($value) {
  $money = preg_replace('~[^0-9|^.|(?=2.)]~', '', $value);
  $money = number_format($money,2);
  
  return $money;
}

/**
 * convenience function for getting categories within a container ordered alphabetically
 * 
 * @param type $container
 * @param type $options
 * @return type
 */
function quickshop_get_alpha_categories($container, $options = array()) {
  $db_prefix = elgg_get_config('dbprefix');
  $defaults = array(
	  'type' => 'object',
	  'subtype' => 'product_category',
	  'container_guid' => $container->guid,
	  'limit' => false,
	  'order_by' => 'o.title ASC',
	  'joins' => array("JOIN {$db_prefix}objects_entity o ON e.guid = o.guid"),
  );
	  
  $options = array_merge($defaults, $options);
	  
  return elgg_get_entities($options);
}


/**
 * Convenience function for listing products in a category alphabetically
 * @param type $container
 * @param type $options
 * @return type
 */
function quickshop_list_alpha_category_products($container, $options = array()) {
  $db_prefix = elgg_get_config('dbprefix');
  $defaults = array(
	  'type' => 'object',
	  'subtype' => 'product',
	  'container_guid' => elgg_get_page_owner_guid(),
	  'relationship' => QUICKSHOP_CATEGORY_RELATIONSHIP,
	  'relationship_guid' => $container->guid,
	  'inverse_relationship' => true,
	  'order_by' => 'o.title ASC',
	  'joins' => array("JOIN {$db_prefix}objects_entity o ON e.guid = o.guid"),
  );
	  
  $options = array_merge($defaults, $options);
  
  return elgg_list_entities_from_relationship($options);
}

/**
 *	gets the top level group for a given category
 * @param type $category
 * @return boolean
 */
function quickshop_get_group_by_category($category) {
  while ($parent = $category->getContainerEntity()) {
	if (elgg_instanceof($parent, 'group')) {
	  return $parent;
	}
	
	if (elgg_instanceof($parent, 'object', 'product_category')) {
	  $category = $parent;
	}
	else {
	  return false;
	}
  }
}

/**
 * Determines if the subcategory is actually a subcategory of the container
 * 
 * @param type $container
 * @param type $subcategory
 * @return bool
 */
function quickshop_is_subcategory($container, $category) {
  while ($parent = get_entity($category->container_guid)) {
	if ($container->guid == $parent->guid) {
	  return true;
	}
	
	$category = $parent;
	if (elgg_instanceof($parent, 'group')) {
	  break; // we're at the top
	}
  }
  
  return false;
}

/**
 *	Determines if a given category is valid
 * @param type $category
 * @return boolean
 */
function quickshop_is_valid_category($category) {
  if (!$category || !elgg_instanceof($category, 'object', 'product_category')) {
	return false;
  }

  $group = quickshop_get_group_by_category($category);
	  
  if (!$group || !elgg_instanceof($group, 'group')) {
	return false;
  }
  
  return true;
}

/**
 * determines if a given category is valid and can be edited by the logged in user
 * 
 * @param type $category
 * @return boolean
 */
function quickshop_is_valid_editable_category($category) {
  if (!quickshop_is_valid_category($category)) {
	return false;
  }

  $group = quickshop_get_group_by_category($category);
	  
  if (!$group || !$group->canEdit() || !elgg_instanceof($group, 'group')) {
	return false;
  }
  
  return true;
}

/**
 *	Recursively gets the full tree of categories and organizes them into options_values
 *  for dropdown inputs
 * 
 * @param type $container
 * @param type $options
 * @param type $depth
 * @return type
 */
function quickshop_product_category_options_values($container, $options = array(), $depth = 0) {
  if ($depth == 0) {
	$options[$container->guid] = elgg_echo('quickshop:product_category:top_level');
  }
  
  $prefix = '';
  for ($i=0; $i<$depth; $i++) {
	$prefix .= '--';
  }
  
  $categories = elgg_get_entities(array(
	 'type' => 'object',
	  'subtype' => 'product_category',
	  'container_guids' => array($container->guid),
	  'limit' => false
  ));
  
  foreach ($categories as $category) {
	$options[$category->guid] = $prefix . $category->title;
	$newdepth = $depth + 1;
	$options = quickshop_product_category_options_values($category, $options, $newdepth);
  }
  
  return $options;
}