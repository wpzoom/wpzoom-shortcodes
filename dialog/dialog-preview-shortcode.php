<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (
    ! class_exists( 'WPZOOM_Shortcodes_Plugin_Init' )
 || ! current_user_can( 'edit_posts' )
) {
    exit;
}

$valid_shortcodes = array(
    'box', 'button', 'ilink', 'unordered_list', 'ordered_list',
    'twocol_one', 'twocol_one_last',
    'threecol_one', 'threecol_one_last', 'threecol_two', 'threecol_two_last',
    'fourcol_one', 'fourcol_one_last', 'fourcol_two', 'fourcol_two_last', 'fourcol_three', 'fourcol_three_last',
    'fivecol_one', 'fivecol_one_last', 'fivecol_two', 'fivecol_two_last', 'fivecol_three', 'fivecol_three_last', 'fivecol_four', 'fivecol_four_last',
    'sixcol_one', 'sixcol_one_last', 'sixcol_two', 'sixcol_two_last', 'sixcol_three', 'sixcol_three_last', 'sixcol_four', 'sixcol_four_last', 'sixcol_five', 'sixcol_five_last',
    'tabs', 'tab'
);


if ( ! isset( $shortcode ) || ! is_string( $shortcode ) || '' === trim( $shortcode ) ) {
	return false;
}

$regex = get_shortcode_regex();
$code  = trim( $shortcode );
preg_match( "/$regex/s", $code, $matches );
$shortcode_name = isset( $matches[2] ) ? $matches[2] : '';

if (
      empty( $shortcode_name )
 || ! in_array( $shortcode_name, $valid_shortcodes, true )
) {
    return false;
}

$assets_path = WPZOOM_Shortcodes_Plugin_Init::$assets_path;

wp_register_script( 'wpz-shortcode-preview-jquery', $assets_path . '/js/jquery.min.1.4.3.js', array(), WPZOOM_SHORTCODE_VERSION, false );
wp_enqueue_script( 'wpz-shortcode-preview-jquery' );

wp_register_style( 'wpz-shortcode-preview-theme-style', get_stylesheet_uri(), array(), null );
wp_register_style( 'wpz-shortcode-preview-shortcodes', $assets_path . '/css/shortcodes.css', array(), WPZOOM_SHORTCODE_VERSION );
wp_register_style( 'wpz-shortcode-preview-font-awesome', $assets_path . '/css/font-awesome.min.css', array(), WPZOOM_SHORTCODE_VERSION );
wp_enqueue_style( 'wpz-shortcode-preview-theme-style' );
wp_enqueue_style( 'wpz-shortcode-preview-shortcodes' );
wp_enqueue_style( 'wpz-shortcode-preview-font-awesome' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php wp_print_scripts( array( 'wpz-shortcode-preview-jquery' ) ); ?>
    <?php wp_print_styles( array( 'wpz-shortcode-preview-theme-style', 'wpz-shortcode-preview-shortcodes', 'wpz-shortcode-preview-font-awesome' ) ); ?>
    <style>
        .post  { margin: -5px 0 0 0; }
        .shortcode-typography { display: block; margin-top: 20px; }
    </style>
</head>
<body>

<?php echo wp_kses_post( do_shortcode( $shortcode ) ); ?>

<script type="text/javascript">
    jQuery( '#wpz-preview h3:first', window.parent.document).removeClass('wpz-loading');
</script>
</body>
</html>
