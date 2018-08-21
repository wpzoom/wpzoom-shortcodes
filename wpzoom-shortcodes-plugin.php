<?php
/**
 * Plugin Name: WPZOOM SHORTCODES
 * Plugin URI: http://www.wpzoom.com/
 * Description: WPZOOM SHORTCODES.
 * Author: WPZOOM
 * Author URI: http://www.wpzoom.com/
 * Version: 1.0
 * License: GPLv2 or later
 * Text Domain: wpzoom-shortcodes-plugin
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( get_option( 'wpzoom_framework_wzslider_enable', false ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'shortcodes/wzslider.php';
}

require_once plugin_dir_path( __FILE__ ) . "shortcodes/shortcodes.php";
require_once plugin_dir_path( __FILE__ ) . 'init.php';
