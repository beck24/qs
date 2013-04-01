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
  
  // modified url for store profiles
  if (count($return['segments']) == 1) {
	// only one parameter after url/groups/
	// see if it's a group identifier
	$groups = elgg_get_entities_from_metadata(array(
		'type' => 'group',
		'metadata_names' => array('identifier'),
		'metadata_values' => array($return['segments'][0]),
		'limit' => 1
	));
	
	if ($groups) {
	  elgg_load_library('elgg:groups');
	  groups_handle_profile_page($groups[0]->guid);
	  return true;
	}
	else {
	  return $return;
	}
  }
  
  
  // call a custom implementation of page handlers
  if ($return['segments'][0] == 'category') {
	array_shift($return['segments']);
	if (quickshop_product_category_page_handler($return['segments'])) {
	  return true;
	}
	
	// something's not right...
	forward('', '404');
  }
  
  if ($return['segments'][0] == 'product') {
	array_shift($return['segments']);
	if (quickshop_product_page_handler($return['segments'])) {
	  return true;
	}
	
	// something's not right
	forward('', '404');
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


function quickshop_group_owner_block($hook, $type, $return, $params) {
  if (elgg_instanceof($params['entity'], 'group')) {
	return array();
  }
  
  return $return;
}