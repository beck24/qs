<?php

$group = $vars['entity'];

elgg_push_breadcrumb(elgg_echo('qs:admin:title:taxes'));

elgg_register_menu_item('title', array(
				'name' => 'qs:admin:taxes:add',
				'href' => $group->getURL() . '/admin/taxes/add',
				'text' => elgg_echo('qs:admin:taxes:add'),
				'link_class' => 'elgg-button elgg-button-action',
			));


$options = array(
    'type' => 'object',
    'subtype' => 'qstax',
    'container_guid' => $group->guid,
    'limit' => 15,
    'pagination' => true,
    'count' => true
);

$count = elgg_get_entities($options);

if ($count) {
    unset($options['count']);
    echo elgg_view('object/qstax/header');
    echo elgg_list_entities($options);
}
else {
    echo elgg_echo('qs:taxes:none');
}
