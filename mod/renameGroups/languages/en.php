<?php
/**
 *	Elgg renameGroups
 *	Author : Mahin Akbar | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info@webgalli.com
 *	Web	: http://webgalli.com 
 *	Skype : 'team.webgalli'
 *	@package renameGroups
 * 	Plugin info : Allows site admin to rename groups to anything they wish.
 *	Licence : GNU2
 *	Copyright : Team Webgalli
 */

 
if ((include elgg_get_plugins_path() . 'groups/languages/en.php') == '1') {
	$new_language = array();	
	$patterns = array(	'/group/', 
						'/groups/', 
						'/Group/', 
						'/Groups/',
					);
	$replacements = array(	elgg_get_plugin_setting('group', 'renameGroups'), 
							elgg_get_plugin_setting('groups', 'renameGroups'), 
							elgg_get_plugin_setting('Group', 'renameGroups'), 
							elgg_get_plugin_setting('Groups', 'renameGroups'), 
						);
	foreach($english as $key => $val){
		$new_language[$key] = preg_replace($patterns, $replacements, $val);
	}
	$new_language['renameGroups:instruction'] = "Enter the replacement word for <b>%s</b>.";
	add_translation('en', $new_language);
}