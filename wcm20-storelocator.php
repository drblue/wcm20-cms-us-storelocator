<?php
/**
 * Plugin Name:	WCM20 Store Locator
 * Description:	This plugin adds a store post type and map functionality
 * Version:		0.1
 * Author:		Johan Nordström
 * Author URI:	https://www.thehiveresistance.com
 * Text Domain:	wcm20-storelocator
 * Domain Path:	/languages
 */

define('WCMSL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WCMSL_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Include dependencies.
 */
require_once(WCMSL_PLUGIN_DIR . 'includes/cpt.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/ct.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/acf-loader.php');

require_once(WCMSL_PLUGIN_DIR . 'includes/functions.php');
