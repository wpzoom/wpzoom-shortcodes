<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPZOOM_Shortcodes_Plugin_Init' ) ) {
	exit;
}

$assets_path = WPZOOM_Shortcodes_Plugin_Init::$assets_path;

wp_register_script( 'wpz-shortcode-generator-htmlsanitizer', $assets_path . '/js/shortcode-generator/htmlsanitizer.js', array( 'jquery' ), WPZOOM_SHORTCODE_VERSION, false );
wp_register_script( 'wpz-shortcode-generator-column-control', $assets_path . '/js/shortcode-generator/column-control.js', array( 'jquery' ), WPZOOM_SHORTCODE_VERSION, false );
wp_register_script( 'wpz-shortcode-generator-tab-control', $assets_path . '/js/shortcode-generator/tab-control.js', array( 'jquery' ), WPZOOM_SHORTCODE_VERSION, false );
wp_register_script(
	'wpz-shortcode-generator-dialog',
	$assets_path . '/js/shortcode-generator/dialog.js',
	array(
		'jquery',
		'wpz-shortcode-generator-htmlsanitizer',
		'wpz-shortcode-generator-column-control',
		'wpz-shortcode-generator-tab-control',
	),
	WPZOOM_SHORTCODE_VERSION,
	false
);

$dialog_inline_script = 'var shortcode_generator_url = ' . wp_json_encode( $assets_path . '/js/shortcode-generator/' ) . ';';
$dialog_inline_script .= 'var shortcode_generator_ver = ' . wp_json_encode( WPZOOM_SHORTCODE_VERSION ) . ';';
$dialog_inline_script .= 'var wpz_dialog_nonce = ' . wp_json_encode( wp_create_nonce( 'wpz_shortcodes_dialog' ) ) . ';';
wp_add_inline_script( 'wpz-shortcode-generator-dialog', $dialog_inline_script, 'before' );
wp_enqueue_script( 'wpz-shortcode-generator-dialog' );

$support_shortcodes = true;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
</head>
<body>
<div id="wpz-dialog">

<?php if ( $support_shortcodes ) { ?>

<div id="wpz-options-buttons" class="clear">
    <div class="alignleft">

        <input type="button" id="wpz-btn-cancel" class="button" name="cancel" value="<?php esc_attr_e( 'Cancel', 'wpzoom-shortcodes' ); ?>" accesskey="C" />

    </div>
    <div class="alignright">

        <input type="button" id="wpz-btn-preview" class="button" name="preview" value="<?php esc_attr_e( 'Preview', 'wpzoom-shortcodes' ); ?>" accesskey="P" />
        <input type="button" id="wpz-btn-insert" class="button-primary" name="insert" value="<?php esc_attr_e( 'Insert', 'wpzoom-shortcodes' ); ?>" accesskey="I" />

    </div>
    <div class="clear"></div><!--/.clear-->
</div><!--/#wpz-options-buttons .clear-->

<div id="wpz-options" class="alignleft">
    <h3><?php esc_html_e( 'Customize the Shortcode', 'wpzoom-shortcodes' ); ?></h3>

    <table id="wpz-options-table">
    </table>

</div>

<div id="wpz-preview" class="alignleft">

    <h3><?php esc_html_e( 'Preview', 'wpzoom-shortcodes' ); ?></h3>

    <iframe id="wpz-preview-iframe" frameborder="0" style="width:100%;height:250px" scrolling="no"></iframe>

</div>
<div class="clear"></div>

<?php wp_print_scripts( array( 'wpz-shortcode-generator-dialog' ) ); ?>
<?php  }  else { ?>

<div id="wpz-options-error">
    <p><?php esc_html_e( 'Your version of theme does not yet support shortcodes.', 'wpzoom-shortcodes' ); ?></p>
</div>

<?php  } ?>

</div>

</body>
</html>
