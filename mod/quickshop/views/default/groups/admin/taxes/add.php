<?php

$group = $vars['entity'];

elgg_push_breadcrumb(elgg_echo('qs:admin:title:taxes'), $group->getURL() . '/admin/taxes');
elgg_push_breadcrumb(elgg_echo('qs:admin:title:taxes/add'));

elgg_register_menu_item('title', array(
				'name' => 'qs:admin:taxes:add',
				'href' => $group->getURL() . '/admin/taxes/add',
				'text' => elgg_echo('qs:admin:taxes:add'),
				'link_class' => 'elgg-button elgg-button-action',
			));

echo elgg_view_form("qstax/edit", array(), array('group' => $group));