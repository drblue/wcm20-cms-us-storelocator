<?php
/**
 * Shortcodes
 */

/**
 * Shortcode 'storelocator'
 *
 * @return string
 */
function wcmsl_shortcode_storelocator() {
	return '<div id="wcmsl-map"></div>';
}
add_shortcode(WCMSL_SHORTCODE_STORELOCATOR, 'wcmsl_shortcode_storelocator');
