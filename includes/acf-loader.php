<?php

// Define path and URL to the ACF plugin.
define('WCMSL_ACF_PATH', WCMSL_PLUGIN_DIR . 'includes/acf/');
define('WCMSL_ACF_URL', WCMSL_PLUGIN_URL . 'includes/acf/');

// Include the ACF plugin.
include_once(WCMSL_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'wcmsl_acf_settings_url');
function wcmsl_acf_settings_url($url) {
	return WCMSL_ACF_URL;
}

// Load Local JSON files from our plugin
add_filter('acf/settings/load_json', 'wcmsl_acf_settings_load_json');
function wcmsl_acf_settings_load_json($paths) {
	$paths[] = WCMSL_PLUGIN_DIR . 'includes/acf-json';
	return $paths;
}

// Change path for Local JSON to point to our plugin
add_filter('acf/settings/save_json', 'wcmsl_acf_settings_save_json');
function wcmsl_acf_settings_save_json() {
	return WCMSL_PLUGIN_DIR . 'includes/acf-json';
}

// (Optional) Hide the ACF admin menu item (false = hide menu, true = show menu)
// add_filter('acf/settings/show_admin', 'wcmsl_acf_settings_show_admin');
function wcmsl_acf_settings_show_admin($show_admin) {
	return false;  // don't show admin menu item
}
