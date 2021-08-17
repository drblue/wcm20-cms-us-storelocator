<?php
/**
 * Options Page for this plugin
 */

if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
		'page_title' => 'Store Locator Settings',
		'menu_title' => 'Store Locator',
		'menu_slug' => 'wcmsl-settings',
		'capability' => 'manage_options',
	]);
}
