<?php
defined( 'ABSPATH' ) or die();

// Register theme's assets
add_action( 'admin_init', 'promosys__setup_admin_assets' );

// Register script for custom widget`s
add_action('admin_enqueue_scripts', 'promosys__widgets_script');
add_action('admin_enqueue_scripts', 'promosys__weather_var' );

// Register script for custom metaboxes
add_action('admin_enqueue_scripts', 'promosys__metaboxes_script');

/**
 * Register scripts and styles for the theme
 *
 * @return  void
 */
function promosys__setup_admin_assets($a) {
	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css', array(), '4.7.0', 'all' );

	// Flaticon
	$cwsfi = get_option('cwsfi');
	if( !empty($cwsfi) && isset($cwsfi['css']) ){
		wp_enqueue_style( 'cwsfi-css', $cwsfi['css'], array(), PROMOSYS__VERSION, 'all' );
	} else {
		wp_enqueue_style( 'admin-flaticon', get_template_directory_uri() . '/assets/fonts/flaticons/style.css', array(), PROMOSYS__VERSION, 'all' );
	};

	// Admin`s gutenberg styles
	wp_enqueue_style( 'admin-gutenberg', get_template_directory_uri() . '/admin/css/gutenberg.css', array(), PROMOSYS__VERSION, 'all' );

	// Admin`s custom styles 
	wp_enqueue_style( 'admin-meta', get_template_directory_uri() . '/admin/css/metaboxes.css', array(), PROMOSYS__VERSION, 'all' );

	// Admin`s visual composer styles
	wp_enqueue_style( 'admin-vc', get_template_directory_uri() . '/admin/css/vc.css', array(), PROMOSYS__VERSION, 'all' );
}

/**
 * Register scripts for custom widgets
 *
 * @return  void
 */
function promosys__widgets_script() {
    wp_enqueue_media();
    wp_enqueue_script( 'widgets-script', get_template_directory_uri() . '/admin/js/widgets.js', false, PROMOSYS__VERSION, true );
	wp_enqueue_style( 'widgets-css', get_template_directory_uri() . '/admin/css/widgets.css', array(), PROMOSYS__VERSION, 'all' );
    if ( class_exists('Weather_Atlas_Public') ) {
        wp_enqueue_script( 'jquery-ui-autocomplete' );
    }
}
function promosys__weather_var() {
    if ( class_exists('Weather_Atlas_Public') ) {
        $get_locale_root_array = explode("_", get_locale());
        $get_locale_root = $get_locale_root_array[0];
        if ($get_locale_root == 'de') {
            $language_root_wp = 'de';
        } elseif ($get_locale_root == 'en') {
            $language_root_wp = 'en';
        } elseif ($get_locale_root == 'es') {
            $language_root_wp = 'es';
        } elseif ($get_locale_root == 'ru') {
            $language_root_wp = 'ru';
        } elseif ($get_locale_root == 'zh') {
            $language_root_wp = 'zh';
        } else {
            $language_root_wp = 'en';
        }
        echo '<script type="text/javascript">
                /*<![CDATA[*/
                var weather_atlas_language = "' . $language_root_wp . '";
              </script>';
    }
}

/**
 * Register scripts for custom widgets
 *
 * @return  void
 */
function promosys__metaboxes_script() {
	if ( !did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
    wp_enqueue_script( 'metaboxes-script', get_template_directory_uri() . '/admin/js/metaboxes.js', false, PROMOSYS__VERSION, true );
}