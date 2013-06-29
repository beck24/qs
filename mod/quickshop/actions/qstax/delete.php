<?php

$guid = get_input('guid');
$tax = get_entity($guid);

if (!elgg_instanceof($tax, 'object', 'qstax') || !$tax->canEdit()) {
    register_error(elgg_echo('qs:error:generic:permissions'));
    forward(REFERER);
}

$group = $tax->getGroup();

if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
    register_error(elgg_echo('qs:error:generic:permissions'));
    forward(REFERER);
}

if ($tax->delete()) {
    system_message(elgg_echo('qs:tax:delete:success'));
}
else {
    register_error(elgg_echo('qs:tax:delete:error'));
}

forward($group->getURL() . '/admin/taxes');