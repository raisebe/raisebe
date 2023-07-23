<?php
defined( 'ABSPATH' ) or exit;

// Theme constants
define( 'PROMOSYS__PATH', trailingslashit( get_template_directory() ) );
define( 'PROMOSYS__URI', trailingslashit( get_template_directory_uri() ) );
define( 'PROMOSYS__PLUGINS_DIR', ABSPATH . 'wp-content/plugins/' );
define( 'PROMOSYS__ACTIVE', class_exists('CWS_Essentials') );
define( 'PROMOSYS__VERSION', '1.0.0' );
define( 'PROMOSYS__ID', 'promosys' );


// Action to load the theme translation
add_action( 'after_setup_theme', 'promosys__translation_import', 5 );

/**
 * Load the translation files into the theme textdomain
 *
 * @return  void
 */
function promosys__translation_import() {
	load_theme_textdomain( 'promosys', get_template_directory() . '/languages' );
}

/**
 * We must check PHP version to ensure the theme can
 * be worked fine
 */
if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
	// Register action to checking theme requirements
	add_action( 'after_switch_theme', 'promosys__requirement_check', 10, 2 );

	// Action to sending a notice while hosting does
	// not meet the minimum requires
	add_action( 'admin_notices', 'promosys__requirement_notice' );

	/**
	 * Check the theme requirements
	 *
	 * @param   string  $name   Theme's name
	 * @param   object  $theme  The theme object
	 *
	 * @return  void
	 */
	function promosys__requirement_check( $name, $theme ) {
		// Switch back to previous theme
		switch_theme( $theme->stylesheet );
	}

	/**
	 * Show the warning message when hosting environment doesn't
	 * meet the theme minimum requires.
	 *
	 * @return  void
	 */
	function promosys__requirement_notice() {
		printf( '<div class="error"><p>%s</p></div>',
			esc_html__( 'Sorry! Your server does not meet the minimum requirements, please upgrade PHP version to 5.6 or higher', 'promosys' ) );
	}

	return;
}


// The base classes
require_once PROMOSYS__PATH . 'inc/functions-helpers.php';
require_once PROMOSYS__PATH . 'inc/functions-template.php';

require_once PROMOSYS__PATH . 'assets/fonts/default_fonts.php';
require_once PROMOSYS__PATH . 'inc/functions-helpers-styles.php';
require_once PROMOSYS__PATH . 'inc/functions-custom-icons.php';
require_once PROMOSYS__PATH . 'inc/functions-blog.php';

//  Welcome page
require_once PROMOSYS__PATH . 'admin/cws-welcome-page.php';

// Theme customize setup
require_once PROMOSYS__PATH . 'admin/customize/functions-customize.php';

// Theme setup
require_once PROMOSYS__PATH . 'inc/functions-setup.php';

if( is_admin() ) {
	require_once PROMOSYS__PATH . 'admin/plugins.php';
	require_once PROMOSYS__PATH . 'admin/functions-setup.php';
}

// Woocommerce
if( class_exists('WooCommerce') ){
	require_once PROMOSYS__PATH . 'woocommerce/wooinit.php';
}

// WPBakery Page Builder
if( class_exists('Vc_Manager') ){
	$vc_man = Vc_Manager::getInstance();
	$vc_man->disableUpdater(true);
	if (!isset($_COOKIE['vchideactivationmsg_vc11'])) {
		setcookie('vchideactivationmsg_vc11', WPB_VC_VERSION);
	}
	require_once( get_template_directory() . '/vc/cws_vc_config.php' );
}

// Additional Thumbnails size
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'medium_large', 600, 9999, false );
}