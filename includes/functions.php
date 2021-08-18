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

/**
 * Return Google Maps API Key from the plugin settings.
 *
 * @return string|null
 */
function wcmsl_get_google_maps_api_key() {
	return get_field('google_maps_api_key', 'option');
}

/**
 * Enqueue CSS and JavaScript
 *
 * @return void
 */
function wcmsl_enqueue_styles() {
	// Load plugin styles
	wp_enqueue_style('wcm20-storelocator-styles', WCMSL_PLUGIN_URL . "assets/css/wcm20-storelocator.css", [], "0.1", "screen");

	// Load plugin script
	wp_enqueue_script('wcm20-storelocator', WCMSL_PLUGIN_URL . "assets/js/wcm20-storelocator.js", [], "0.1", true);
	wp_localize_script('wcm20-storelocator', 'wcmsl_settings', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'messages' => [],
	]);

	// Load Google Maps JavaScript library
	$google_maps_api_key = wcmsl_get_google_maps_api_key();
	if ($google_maps_api_key) {
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key . '&callback=initMap', [], false, true);
	}
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

/**
 * Hook into when a field group for a store is saved.
 *
 * Look up latitude/longitude from address if not set.
 *
 * @param int $post_id
 * @return void
 */
function wcmsl_acf_save_post($post_id) {
	// 👨🏻‍⚖️ Bail if it's not a store that's being saved
	if (get_post_type($post_id) !== 'wcmsl_store') {
		return;
	}

	// We're sure it's a store
	$address = $_POST['acf'][WCMSL_ACF_ADDRESS_FIELD];
	$city = $_POST['acf'][WCMSL_ACF_CITY_FIELD];
	$latitude = $_POST['acf'][WCMSL_ACF_LATITUDE_FIELD];
	$longitude = $_POST['acf'][WCMSL_ACF_LONGITUDE_FIELD];

	// If not latitude nor longitude is empty, do nothing
	if (!(empty($latitude) || empty($longitude))) {
		return;
	}

	// No latitude or longitude is set, do geocoding of address + city
	$pos = wcmsl_geocode($address, $city);
	if ($pos !== false && is_array($pos)) {
		$_POST['acf'][WCMSL_ACF_LATITUDE_FIELD] = $pos['lat'];
		$_POST['acf'][WCMSL_ACF_LONGITUDE_FIELD] = $pos['lng'];
	}
}
add_action('acf/save_post', 'wcmsl_acf_save_post', 5);
