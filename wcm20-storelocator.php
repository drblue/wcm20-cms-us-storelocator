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

define('WCMSL_ACF_ADDRESS_FIELD', 'field_611b77292462d');
define('WCMSL_ACF_CITY_FIELD', 'field_611b77672462e');
define('WCMSL_ACF_LATITUDE_FIELD', 'field_611c2dbe9b8bf');
define('WCMSL_ACF_LONGITUDE_FIELD', 'field_611c2ddf9b8c0');

/**
 * Include dependencies.
 */
require_once(WCMSL_PLUGIN_DIR . 'vendor/autoload.php');

require_once(WCMSL_PLUGIN_DIR . 'includes/cpt.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/ct.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/acf-loader.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/geocode.php');

require_once(WCMSL_PLUGIN_DIR . 'includes/functions.php');
require_once(WCMSL_PLUGIN_DIR . 'includes/options.php');
