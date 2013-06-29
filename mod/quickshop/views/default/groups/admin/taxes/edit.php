<?php

$group = $vars['entity'];

$guid = get_input('guid');
$tax = get_entity($guid);

if (!elgg_instanceof($tax, 'object', 'qstax') || !$tax->canEdit()) {
    register_error(elgg_echo('qs:error:generic:permissions'));
    forward(REFERER);
}

elgg_push_breadcrumb(elgg_echo('qs:admin:title:taxes'), $group->getURL() . '/admin/taxes');
elgg_push_breadcrumb(elgg_echo('qs:admin:title:taxes/edit'));

elgg_register_menu_item('title', array(
				'name' => 'qs:admin:taxes:add',
				'href' => $group->getURL() . '/admin/taxes/add',
				'text' => elgg_echo('qs:admin:taxes:add'),
				'link_class' => 'elgg-button elgg-button-action',
			));

echo elgg_view_form("qstax/edit", array(), array('group' => $group, 'entity' => $tax));