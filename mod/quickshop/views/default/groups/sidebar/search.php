<?php
/**
 * Search for content in this group
 *
 * @uses vars['entity'] ElggGroup
 */
$vars['entity'] = elgg_get_page_owner_entity();

if (!elgg_instanceof($vars['entity'], 'group')) {
  return true;
}

$url = elgg_get_site_url() . 'search';
$body = elgg_view_form('groups/search', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
), $vars);

echo elgg_view_module('aside', elgg_echo('groups:search_in_group'), $body);