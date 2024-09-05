<?php
/**
 * Plugin Name: WPZOOM Shortcodes
 * Plugin URI: https://www.wpzoom.com/
 * Description: A suite of useful shortcodes compatible with any existing themes, not just with WPZOOM themes.
 * Author: WPZOOM
 * Author URI: httpd://www.wpzoom.com/
 * Version: 1.0.5
 * Copyright: (c) 2019 WPZOOM
 * License: GPLv2 or later
 * Text Domain: wpzoom-shortcodes
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'WPZOOM_SHORTCODE_VERSION' ) ) {
	define( 'WPZOOM_SHORTCODE_VERSION', get_file_data( __FILE__, [ 'Version' ] )[0] ); // phpcs:ignore
}

require_once plugin_dir_path( __FILE__ ) . 'shortcodes/wzslider.php';

require_once plugin_dir_path( __FILE__ ) . "shortcodes/shortcodes.php";
require_once plugin_dir_path( __FILE__ ) . 'init.php';
