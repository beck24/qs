<?php

function qs_theme_white_init() {
    elgg_register_plugin_hook_handler('qs:themes', 'options_values', 'qs_theme_white_options_values');
    
    $css = elgg_get_simplecache_url('css', 'qs_theme_white/css');
	elgg_register_simplecache_view('css/qs_theme_white/css');
	elgg_register_css('qs_theme_white', $css);
}

function qs_theme_white_options_values($hook, $type, $return, $params) {
    $return['qs_theme_white'] = elgg_echo('qs_theme_white');
    
    return $return;
}

elgg_register_event_handler('init', 'system', 'qs_theme_white_init');