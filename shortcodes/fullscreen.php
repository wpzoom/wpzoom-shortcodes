<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'wpz_shortcode_fullscreen' ) ) :
	function wpz_shortcode_fullscreen( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => __( 'Fullscreen Image', 'wpzoom-shortcodes-plugin' ),
		), $atts ) );

		return '<div class="fullimg">' . do_shortcode( $content ) . '</div>' . "\n";
	}
endif;

add_shortcode( 'fullscreen', 'wpz_shortcode_fullscreen' );

if ( ! function_exists( 'add_fullscreen_buttons' ) ) :

	function add_fullscreen_buttons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', 'add_fullscreen_tinymce_plugin' );
			add_filter( 'mce_buttons', 'register_fullscreen_buttons' );
		}
	}
endif;

add_action( 'init', 'add_fullscreen_buttons' );

if ( ! function_exists( 'register_fullscreen_buttons' ) ) :
	function register_fullscreen_buttons( $buttons ) {
		array_push( $buttons, "|", "fullscreen" );

		return $buttons;
	}
endif;

if ( ! function_exists( 'add_fullscreen_tinymce_plugin' ) ) :
	function add_fullscreen_tinymce_plugin( $plugin_array ) {
		$plugin_array['fullscreen_btn'] = WPZOOM_Shortcodes_Init::$assets_path . '/js/fullscreen_buttons.js';

		return $plugin_array;
	}
endif;

if ( ! function_exists( 'fullscreen_refresh_mce' ) ) :
	function fullscreen_refresh_mce( $ver ) {
		$ver += 3;

		return $ver;
	}
endif;

add_filter( 'tiny_mce_version', 'fullscreen_refresh_mce' );