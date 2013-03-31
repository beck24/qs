<?php
/**
 * renameGroups plugin settings
 */

$patterns = array('group', 'groups', 'Group', 'Groups');
foreach($patterns as $p){
	echo '<div>';
	echo elgg_echo('renameGroups:instruction', array($p));
	echo ' ';
	echo elgg_view('input/text', array( "name" => "params[$p]", 'value' => $vars['entity']->$p ));
	echo '</div>';
}