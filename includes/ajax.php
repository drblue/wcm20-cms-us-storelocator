<?php
/**
 * Ajax actions
 */

/**
 * Respond to ajax action 'wcmsl_get_stores'
 *
 * @return void
 */
function wcmsl_ajax_get_stores() {
	// Fetch stores from database
	$stores_query = new WP_Query([
		'post_type' => 'wcmsl_store',
		'posts_per_page' => -1,
	]);

	$stores = [];
	if ($stores_query->have_posts()) {
		while ($stores_query->have_posts()) {
			$stores_query->the_post();

			array_push($stores, [
				'name' => get_the_title(),
				'address' => get_field(WCMSL_ACF_ADDRESS_FIELD),
				'city' => get_field(WCMSL_ACF_CITY_FIELD),
				'latitude' => (float)get_field(WCMSL_ACF_LATITUDE_FIELD),
				'longitude' => (float)get_field(WCMSL_ACF_LONGITUDE_FIELD),
			]);
		}
	}

	wp_send_json_success($stores);
}
add_action('wp_ajax_wcmsl_get_stores', 'wcmsl_ajax_get_stores');
add_action('wp_ajax_nopriv_wcmsl_get_stores', 'wcmsl_ajax_get_stores');
