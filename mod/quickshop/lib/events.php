<?php

/**
 *	update the groups identifier
 * @param type $event
 * @param type $type
 * @param type $object
 */
function quickshop_group_identifier($event, $type, $object) {
  $identifier = get_input('identifier');
  $theme = get_input('theme');
  
  $object->identifier = $identifier;
  $object->theme = $theme;
}


/**
 *  triggers on user login
 *  checks for any carts created while logged out
 * 
 * @param type $event
 * @param type $type
 * @param type $user
 */
function quickshop_user_login($event, $type, $user) {
    if (is_array($_SESSION['qscart'])) {
        $ia = elgg_set_ignore_access();
        foreach ($_SESSION['qscart'] as $group_guid => $cart_guid) {
            $cart = get_entity($cart_guid);
            
            if (elgg_instanceof($cart, 'object', 'qscart')) {
                if ($cart->owner_guid != $user->guid) {
                    $cart->owner_guid = $user->guid;
                    $cart->save();
                }
            }
        }
        elgg_set_ignore_access($ia);
    }
}