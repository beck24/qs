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

elgg_register_event_handler('init', 'system', 'renameGroups_init');
function renameGroups_init() {}