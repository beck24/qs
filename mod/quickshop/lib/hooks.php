<?php

function quickshop_extras_menu($hook, $type, $return, $params) {
  return array();
}


/**
 *	Handle some custom URLs in the 'groups' pagehandler
 * 
 * @param type $hook
 * @param type $type
 * @param type $return
 * @param type $params
 * @return type
 */
function quickshop_groups_router($hook, $type, $return, $params) {
  if ($type != 'groups') {
	return $return;
  }
  
  // see if it's a group identifier
    $groups = elgg_get_entities_from_metadata(array(
        'type' => 'group',
        'metadata_names' => array('identifier'),
        'metadata_values' => array($return['segments'][0]),
        'limit' => 1
    ));
    
    if (elgg_instanceof($groups[0], 'group')) {
        // set custom theme
        elgg_set_viewtype($groups[0]->theme);
        elgg_register_viewtype_fallback($groups[0]->theme);
        
        elgg_load_css($groups[0]->theme);
        
        elgg_set_page_owner_guid($groups[0]->guid);
        
        elgg_load_library('elgg:groups');        
        
        // modified url for store profiles
        if (count($return['segments']) == 1) {
            // only one parameter after url/groups

            groups_handle_profile_page($groups[0]->guid);
            return true;
        }
        
        switch ($return['segments'][1]) {
            case 'admin':
                if ($groups[0]->canEdit()) {
                    array_shift($return['segments']);
                    array_shift($return['segments']);
                    $view = implode('/', $return['segments']);

                    groups_handle_admin_page($groups[0]->guid, $view);
                }
                break;
            
            case 'category':
                array_shift($return['segments']);
                array_shift($return['segments']);
                if (quickshop_product_category_page_handler($return['segments'])) {
                    return true;
                }
                break;
                
            case 'product':
                array_shift($return['segments']);
                array_shift($return['segments']);
                if (quickshop_product_page_handler($return['segments'])) {
                    return true;
                }
                break;
                
                
            case 'cart':
                quickshop_cart_page_handler();
                return true;
                break;
        }
    }
    
}

/**
 * When a group is created or updated, makes sure the identifier is valid and unique
 * 
 * @param type $hook
 * @param type $type
 * @param type $return
 * @param type $params
 * @return boolean
 */
function quickshop_validate_identifier($hook, $type, $return, $params) {
  
  elgg_make_sticky_form('groups');
  
  $identifier = get_input('identifier');
  $guid = get_input('group_guid');
  
  if ($identifier != friendly_title($identifier)) {
	register_error(elgg_echo('quickshop:error:identifier:char'));
	return false;
  }
  
  // system reserved strings
  $reserved = array('add', 'edit', 'admin', 'profile', 'action');
  if (in_array($identifier, $reserved)) {
      register_error(elgg_echo('quickshop:error:identifier:unique'));
      return false;
  }
  
  $group = elgg_get_entities_from_metadata(array(
	 'type' => 'group',
	  'metadata_names' => array('identifier'),
	  'metadata_values' => array($identifier),
	  'limit' => 1
  ));
  
  
  if ($group && $group[0]->guid != $guid) {
	// another store is using this identifier
	register_error(elgg_echo('quickshop:error:identifier:unique'));
	return false;
  }
  
  return true;
}


function quickshop_product_entity_menu($hook, $type, $return, $params) {
  if (!elgg_instanceof($params['entity'], 'object', 'product')) {
	return $return;
  }
  
  foreach ($return as $key => $item) {
	if ($item->getName() == 'edit') {
      $group = $params['entity']->getContainerEntity();
	  $return[$key]->setHref("groups/{$group->identifier}/admin/product/edit?guid={$params['entity']->guid}");
	}
  }
  
  return $return;
}


function quickshop_group_owner_block($hook, $type, $return, $params) {
  if (elgg_instanceof($params['entity'], 'group')) {
	return array();
  }
  
  return $return;
}


function quickshop_group_admin_menu($hook, $type, $return, $params) {
    $group = $params['entity'];
    
    if (!$group->canEdit()) {
        return $return;
    }
    
    // edit store
    $edit = new ElggMenuItem(
                'edit',
                elgg_echo('qs:admin:edit'),
                elgg_get_site_url() . "groups/{$group->identifier}/admin/edit"
            );

    $return[] = $edit;
    
    
    // add product
    $add_product = new ElggMenuItem(
            'add_product',
            elgg_echo('quickshop:product:add'),
            elgg_get_site_url() . "groups/{$group->identifier}/admin/product/add"
            );
    
    $return[] = $add_product;
    
    
    // add category
    $add_category = new ElggMenuItem(
            'add_category', 
            elgg_echo('quickshop:category:add'), 
            elgg_get_site_url() . "groups/{$group->identifier}/admin/category/add"
            );
    
    $return[] = $add_category;
    
    
    // view orders
    $view_orders = new ElggMenuItem(
            'qs:order:view',
            elgg_echo('quickshop:view:orders'),
            elgg_get_site_url() . "groups/{$group->identifier}/admin/orders/paid"
            );
    
    $return[] = $view_orders;
            
    return $return;
}