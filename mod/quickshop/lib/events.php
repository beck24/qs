<?php

/**
 *	update the groups identifier
 * @param type $event
 * @param type $type
 * @param type $object
 */
function quickshop_group_identifier($event, $type, $object) {
  $identifier = get_input('identifier');
  
  $object->identifier = $identifier;
}
