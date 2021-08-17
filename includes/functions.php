<?php

if (!function_exists('pre')) {
	/**
	 * Print human-readable information about a variable, wrapped in HTML `<pre>`-tags.
	 *
	 * @param mixed $obj
	 * @return string
	 */
	function pre($obj) {
		return sprintf("<pre>%s</pre>", print_r($obj, true));
	}
}

function wcmsl_enqueue_styles() {
	wp_enqueue_style('wcm20-storelocator-styles', WCMSL_PLUGIN_URL . "assets/css/wcm20-storelocator.css", [], "0.1", "screen");

	wp_enqueue_script('wcm20-storelocator', WCMSL_PLUGIN_URL . "assets/js/wcm20-storelocator.js", [], "0.1", true);
	wp_localize_script('wcm20-storelocator', 'wcmsl_settings', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'messages' => [],
	]);
}
add_action('wp_enqueue_scripts', 'wcmsl_enqueue_styles');

/**
 * Initialize plugin.
 *
 * @return void
 */
function wcmsl_plugin_loaded() {
	// Load plugin translations
	load_plugin_textdomain('wcm20-storelocator', false, WCMSL_PLUGIN_DIR . 'languages/');
}
add_action('plugins_loaded', 'wcmsl_plugin_loaded');


/**
 * Override loading of textdomain for this plugin.
 *
 * @param string $mofile
 * @param string $domain
 * @return string
 */
function wcmsl_load_textdomain($mofile, $domain) {
	if ($domain === 'wcm20-storelocator' && strpos($mofile, WP_LANG_DIR . '/plugins/') !== false) {
		$locale = apply_filters('plugin_locale', determine_locale(), $domain);
		$mofile = WCMSL_PLUGIN_DIR . 'languages/' . $domain . '-' . $locale . '.mo';
	}
	return $mofile;
}
add_filter('load_textdomain_mofile', 'wcmsl_load_textdomain', 10, 2);