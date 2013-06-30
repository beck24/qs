<?php

// define our constants
define(QUICKSHOP_CATEGORY_RELATIONSHIP, 'quickshop_in_category');
define(QUICKSHOP_TAX_RELATIONSHIP, 'quickshop_is_taxed');

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
  
  // product entity menu
  elgg_register_plugin_hook_handler('register', 'menu:entity', 'quickshop_product_entity_menu');
  
  // group admin menu
  elgg_register_plugin_hook_handler('register', 'menu:group_admin', 'quickshop_group_admin_menu');
  
  // give groups nicer urls based on metadata
  elgg_register_entity_url_handler('group', 'all', 'quickshop_group_url');
  
  // save our identifier to groups
  elgg_register_event_handler('update', 'group', 'quickshop_group_identifier');
  elgg_register_event_handler('create', 'group', 'quickshop_group_identifier');
  
  // handle our cart assignments
  elgg_register_event_handler('login', 'user', 'quickshop_user_login');
  
  // register actions
  $action_path = dirname(__FILE__) . '/actions';
  elgg_register_action('product_category/edit', "$action_path/product_category/edit.php");
  elgg_register_action('product_category/delete', "$action_path/product_category/delete.php");
  elgg_register_action('product/edit', "$action_path/product/edit.php");
  elgg_register_action('addtocart', "$action_path/product/addtocart.php", 'public');
  elgg_register_action('removefromcart', "$action_path/product/removefromcart.php", 'public');
  elgg_register_action('qscart/update', "$action_path/product/cartupdate.php", 'public');
  elgg_register_action('qstax/edit', "$action_path/qstax/edit.php");
  elgg_register_action('qstax/delete', "$action_path/qstax/delete.php");
  
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
	// All Products category
	case 'all':
	  $group = get_entity($page[1]);
	  if (!$group || !elgg_instanceof($group, 'group')) {
		return false;
	  }
	  elgg_set_page_owner_guid($group->guid);
	  if (include dirname(__FILE__) . '/pages/category/all.php') {
		return true;
	  }
	  break;
	  
	  // we're viewing a category
	default:
	  $category = get_entity($page[0]);
	  if (!quickshop_is_valid_category($category)) {
		return false;
	  }
	  $group = $category->getGroup();
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
  switch ($page[0]) {
	
	default:
	  // we're viewing a product
	  $product = get_entity($page[0]);
	  if (!$product || !elgg_instanceof($product, 'object', 'product')) {
		return false;
	  }
	  $group = $product->getContainerEntity();
	  if (!$group || !elgg_instanceof($group, 'group')) {
		return false;
	  }
	  
	  elgg_set_page_owner_guid($group->guid);
	  set_input('product_guid', $page[0]);
	  if (include dirname(__FILE__) . '/pages/product/view.php') {
		return true;
	  }
	  break;
  }
  
  return false;
}


function quickshop_cart_page_handler() {
    $group = elgg_get_page_owner_entity();
    elgg_push_breadcrumb($group->name, $group->getURL());
    elgg_push_breadcrumb(elgg_echo('qs:view:cart'));
    
    $cart = quickshop_get_cart($group);
    
    if ($cart) {
        $content = elgg_view_entity($cart, array(
            'full_view' => true
        ));
    }
    else {
        $content = elgg_echo('qs:cart:empty');
    }
    
    $title = elgg_echo('qs:view:cart');
    
    $layout = elgg_view_layout('content', array(
        'title' => $title,
        'content' => $content,
        'filter' => false
    ));
    
    echo elgg_view_page($title, $layout);
}

// gives groups easy to remember urls
function quickshop_group_url($group) {
  
  if ($group->identifier) {
	return elgg_get_site_url() . "groups/" . elgg_get_friendly_title($group->identifier);
  }
  
  return elgg_get_site_url() . "groups/profile/{$group->guid}/" . elgg_get_friendly_title($group->name);
}

function quickshop_get_group_taxes($group) {
    if (!elgg_instanceof($group, 'group')) {
        return array();
    }
    
    return elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'qstax',
        'container_guid' => $group->guid,
        'limit' => 0
    ));
}

function quickshop_get_group_money_symbol($group) {
    if ($group->money_symbol) {
        return htmlentities($group->money_symbol);
    }
    
    return htmlentities('$');
}

function quickshop_get_group_products($group, $limit = false) {
    if (!elgg_instanceof($group, 'group')) {
        return array();
    }
    
    $options = array(
        'type' => 'object',
        'subtype' => 'product',
        'container_guid' => $group->guid,
        'limit' => $limit
    );
    
    return new ElggBatch('elgg_get_entities', $options);
}

// call our init
elgg_register_event_handler('init', 'system', 'quickshop_init');