<?php

// define our constants
define(QUICKSHOP_CATEGORY_RELATIONSHIP, 'quickshop_in_category');

// load our hooks
require_once dirname(__FILE__) . '/lib/hooks.php';
require_once dirname(__FILE__) . '/lib/events.php';
require_once dirname(__FILE__) . '/lib/functions.php';


// register everything we need
function quickshop_init() {
  
  // extend views
  elgg_extend_view('css/elgg', 'quickshop/css');
  elgg_extend_view('js/elgg', 'quickshop/js');
  elgg_extend_view('page/elements/sidebar', 'groups/sidebar/search', 500);
  elgg_extend_view('page/elements/sidebar', 'product_category/tree', 501);
  
  elgg_register_library('elgg:groups', elgg_get_plugins_path() . 'quickshop/lib/groups.php');
  
  // handle some custom routing for 'groups'
  // note, need to register for all routes for compatibility with pagehandler_hijack
  elgg_register_plugin_hook_handler('route', 'all', 'quickshop_groups_router');
  
  // validate identifier
  elgg_register_plugin_hook_handler('action', 'groups/edit', 'quickshop_validate_identifier');
  
  // replace group owner_block links
  elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'quickshop_group_owner_block', 1000);
  
  // remove extras menu
  elgg_register_plugin_hook_handler('register', 'menu:extras', 'quickshop_extras_menu', 1000);
  
  // give groups nicer urls based on metadata
  elgg_register_entity_url_handler('group', 'all', 'quickshop_group_url');
  elgg_register_entity_url_handler('object', 'product_category', 'quickshop_product_category_url');
  
  // save our identifier to groups
  elgg_register_event_handler('update', 'group', 'quickshop_group_identifier');
  elgg_register_event_handler('create', 'group', 'quickshop_group_identifier');
  
  
  // register actions
  $action_path = elgg_get_plugins_path() . 'quickshop/actions';
  elgg_register_action('product_category/edit', "$action_path/product_category/edit.php");
  
  // auto-load some assets
  elgg_load_js('lightbox');
  elgg_load_css('lightbox');
}


/**
 *	page handler for groups/product_category
 *	Note that this is called from the groups router
 * 
 * @param type $page
 */
function quickshop_product_category_page_handler($page) {
  
  switch ($page[0]) {
	//
	// add a new category
	case 'add':
	  $group = get_entity($page[1]);
	  if (!$group || !$group->canEdit() || !elgg_instanceof($group, 'group')) {
		return false;
	  }
	  elgg_set_page_owner_guid($group->guid);
	  if (include dirname(__FILE__) . '/pages/category/add.php') {
		return true;
	  }
	  break;
	  
	//
	// edit an existing category
	case 'edit':
	  $category = get_entity($page[1]);
	  if (!quickshop_is_valid_editable_category($category)) {
		return false;
	  }
	  $group = quickshop_get_group_by_category($category);
	  set_input('category_guid', $category->guid);
	  elgg_set_page_owner_guid($group->guid);
	  if (include dirname(__FILE__) . '/pages/category/edit.php') {
		return true;
	  }
	  break;
	  
	  // we're viewing a category
	default:
	  $category = get_entity($page[0]);
	  if (!quickshop_is_valid_category($category)) {
		return false;
	  }
	  $group = quickshop_get_group_by_category($category);
	  set_input('category_guid', $category->guid);
	  elgg_set_page_owner_guid($group->guid);
	  
	  if (include dirname(__FILE__) . '/pages/category/view.php') {
		return true;
	  }
	  break;
  }
  
  return false;
}

/**
 *	page handler for groups/product
 *	Note that this is called from the groups router
 * 
 * @param type $page
 */
function quickshop_product_page_handler($page) {
  
}

// gives groups easy to remember urls
function quickshop_group_url($group) {
  
  if ($group->identifier) {
	return elgg_get_site_url() . "groups/" . elgg_get_friendly_title($group->identifier);
  }
  
  return elgg_get_site_url() . "groups/profile/{$group->guid}/" . elgg_get_friendly_title($group->name);
}


// category urls
function quickshop_product_category_url($category) {
  return elgg_get_site_url() . "groups/category/{$category->guid}/" . elgg_get_friendly_title($category->title);
}

// call our init
elgg_register_event_handler('init', 'system', 'quickshop_init');