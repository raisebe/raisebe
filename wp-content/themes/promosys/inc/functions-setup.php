<?php
defined( 'ABSPATH' ) or die();

// Setup the theme navigation
add_action( 'after_setup_theme', 'promosys__navigation' );

// Setup theme supports
add_action( 'after_setup_theme', 'promosys__supports' );

// Setup custom widgets
add_action( 'after_setup_theme', 'cws__widgets' );

// Add action to register the needed scripts and styles
// for the theme
add_action( 'init', 'promosys__register_assets', 5 );

// We need enqueue the scripts and styles before showing
// the content
add_action( 'wp_enqueue_scripts', 'promosys__enqueue_assets', 5 );
add_action( 'wp_enqueue_scripts', 'promosys__enqueue_assets', 5 );

// Enqueue fonts in footer to avoid render-block
add_action( 'get_footer', 'promosys__enqueue_fonts' );
add_action( 'get_footer', 'promosys__typography_styles' );

// Setup sidebars & widgets
add_action( 'widgets_init', 'promosys__widgets_init' );

// Regenerate permalinks, if ( portfolio / staff / case_studies ) slug was changed
add_action( 'init', 'rewrite_permalinks', 11 );

// Adding SVG support in the media library
add_filter( 'upload_mimes', 'promosys__upload_mimes' );

// Update theme
add_filter('pre_set_site_transient_update_themes', 'cws_check_for_update' );

// Change postcounts
add_filter('wp_list_categories', 'cws_custom_cats_postcount_filter');
add_filter('get_archives_link', 'cws_custom_arch_postcount_filter');
    

add_filter('loginout', 'my_login_menu_customize');
    
    
    function my_login_menu_customize( $link ) {
        
        if ( ! is_user_logged_in() ) {
            return sprintf( '<a href="%s">%s</a>', wp_login_url(), esc_html_x( 'Sign in', 'frontend', 'promosys' ) );
        } else {
            return sprintf( '<a href="%s">%s</a>', wp_logout_url(), esc_html_x( 'Sign out', 'frontend', 'promosys' ) );
        }
        
        return $link;
    }
/**
 * Change postcount in categories widget
 * 
 * @return  void
 */
function cws_custom_cats_postcount_filter ($count) {
	$count = str_replace('</a> (', '</a><span class="post_count">', $count);
	$count = str_replace(')', '</span>', $count);
	$count = str_replace('>(', '>', $count);
	return $count;
}

/**
 * Change postcount in archives widget
 * 
 * @return  void
 */
function cws_custom_arch_postcount_filter($count) {
   $count = str_replace('</a>&nbsp;(', '</a><span class="post_count">', $count);
   $count = str_replace(')', '</span>', $count);
   $count = str_replace('>(', '>', $count);
   return $count;
}


/**
 * Rewrite permalinks
 *
 * @return  void
 */
function rewrite_permalinks() {
    if( get_theme_mod('cws_reset_permalinks') == 'true' ){
        flush_rewrite_rules();
        set_theme_mod('cws_reset_permalinks', 'false');
    }
}


/**
 * Register the theme menu locations
 * 
 * @return  void
 */
function cws_set_custom_posts_per_page( $query ) {
	if( !is_admin() && $query->is_main_query() ){
		if( is_post_type_archive( 'cws_staff' ) ){
			$query->set( 'posts_per_page', get_theme_mod('cws_staff_items_pp') );
		} else if( is_post_type_archive( 'cws_portfolio' ) ){
			$query->set( 'posts_per_page', get_theme_mod('cws_portfolio_items_pp') );
		}
	}
}
add_action( 'pre_get_posts', 'cws_set_custom_posts_per_page' );

/**
 * Register the theme menu locations
 * 
 * @return  void
 * @since   1.0.0
 */
function promosys__navigation() {
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary Menu', 'promosys' ),
		'sliding'   => esc_html__( 'Sliding Menu', 'promosys' ),
		'top'       => esc_html__( 'Top Menu', 'promosys' )
	) );
}

/**
 * Add custom URL fields to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
function cws_custom_media_field( $form_fields, $post ) {
    $form_fields['cws-custom-url'] = array(
        'label' => 'Custom URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'cws_custom_url', true ),
        'helps' => 'Custom URL for CWS-Presentation module',
    );
 
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'cws_custom_media_field', 10, 2 );
 
/**
 * Save values of custom URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */
function cws_custom_media_field_save( $post, $attachment ) {
    if( isset( $attachment['cws-custom-url'] ) )
        update_post_meta( $post['ID'], 'cws_custom_url', $attachment['cws-custom-url'] );
    return $post;
}
add_filter( 'attachment_fields_to_save', 'cws_custom_media_field_save', 10, 2 );

/**
 * Register the theme features support
 * 
 * @return  void
 */
function promosys__supports() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'status', 'video', 'audio' ) );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );
	add_theme_support( 'custom-background', array('default-color' => '#fff') );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
}

/**
 * Register the theme custom widgets
 * 
 * @return  void
 */
function cws__widgets() {
	$widgets = array(
		'CWS_About',
		'CWS_Recent_Posts',
		'CWS_Twitter',
		'CWS_Banner'
	);

	if( PROMOSYS__ACTIVE ){
        $cws_essentials = new CWS_Essentials();
        $cws_essentials->cws_register_widgets($widgets);
	}
}

/**
 * Register the theme assets
 * 
 * @return  void
 */
function promosys__register_assets() {
	// Theme's icons
    wp_enqueue_style( 'cwsicons', get_template_directory_uri() . '/assets/fonts/cwsicons/style.css', array(), PROMOSYS__VERSION, 'all' );

	// Theme's scripts
    wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/assets/js/slick-slider.min.js', array('jquery'), '1.8.1' );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array(), '1.1.0', true );
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array(), '1.6.2', true );
    wp_enqueue_script( 'counterup', get_template_directory_uri() . '/assets/js/counterup.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'particles', get_template_directory_uri() . '/assets/js/particles.js', array(), '2.0.0', true );
    wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/js/jquery.sticky-sidebar.min.js', array(), '3.3.1', true );
    wp_enqueue_script( 'tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.js', array(), '1.0.0', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array(), '3.0.6', true );
}

function promosys__enqueue_assets() {
	// The dynamic styles
	if ( locate_template( 'dynamic-styles.php' ) ) {
		// Load the script that generate the dynamic
		// stylesheets
		get_template_part( 'dynamic-styles' );
	}

	// Enqueue the main styles
    wp_enqueue_style( 'promosys-theme', get_template_directory_uri() . '/assets/css/main.css', array(), PROMOSYS__VERSION, 'all' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    
    // Enqueue the main script
    wp_enqueue_script( 'promosys-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'slick-slider', 'magnific-popup', 'waypoints', 'counterup', 'sticky-sidebar', 'tilt', 'particles' ), PROMOSYS__VERSION, true );
    
    // Enqueue the inline stylesheet
	wp_add_inline_style( 'promosys-theme', promosys__styles() );
	wp_add_inline_style( 'promosys-theme', promosys__scheme_styles() );

	// Enqueue the wp included masonry script
	wp_enqueue_script( 'masonry' );

	// Comment script
	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
}

function promosys__enqueue_fonts() {
	// Enqueue flaticons
    $cwsfi = get_option('cwsfi');
    if( !empty($cwsfi) && isset($cwsfi['css']) ){
        wp_enqueue_style( 'cwsfi-css', $cwsfi['css'], array(), PROMOSYS__VERSION, 'all' );
    } else {
        wp_enqueue_style( 'flaticons', get_template_directory_uri() . '/assets/fonts/flaticons/style.css', array(), PROMOSYS__VERSION, 'all' );
    };

	// Enqueue custom icons
	wp_enqueue_style( 'cwsicons' );

	// Font Awesome
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css', array(), '4.7.0', 'all' );
}

function promosys__widgets_init() {
	$sidebars = get_theme_mod('theme_sidebars');
	$sidebars = isset($sidebars) ? $sidebars :
	array(
		'blog_sidebar' 	    	=> 'Blog ',
		'blog_single_sidebar' 	=> 'Blog Single',
        'custom_sidebar'		=> 'Custom Sidebar',
	);

	if( !empty($sidebars) && function_exists('register_sidebars') ){
		foreach( $sidebars as $key => $value ){
			if( !empty($value) ){
				register_sidebar( array(
					'name' => $value,
					'id' => strtolower(preg_replace("/[^a-z0-9\-]+/i", "_", esc_attr($key) )),
					'before_widget' => '<div class="cws-widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="widget-title h5"><span class="widget-title-text">',
					'after_title' => '</span></div>',
				));
			}
		}
	}
}

/**
 * Register custom mime types for the theme
 * 
 * @param   array  $mimes  List of mime types
 * @return  array
 */
function promosys__upload_mimes( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	$mimes['ico'] = 'image/x-icon';
	$mimes['dat'] = 'application/octet-stream';
	$mimes['txt'] = 'text/plain';

	return $mimes;
}

/**
 * Theme and plugin updates
 * 
 * @return  bool
 */
function cws_check_for_update( $transient ){
	if( empty($transient->checked) ){ return $transient; }

	$theme_pc = trim(get_option('envato_purchase_code_promosys'));
	if (empty($theme_pc)) {
		add_action( 'admin_notices', 'cws_an_purchase_code' );
	}

	$result = wp_remote_get('http://up.cwsthemes.com/products-updater.php?pc=' . $theme_pc . '&tname=' . 'promosys');
	if (!is_wp_error( $result ) ) {
		if (200 == $result['response']['code'] && 0 != strlen($result['body']) ) {
			
			$resp = json_decode($result['body'], true);
			$h = isset( $resp['h'] ) ? (float) $resp['h'] : 0;
			$theme = wp_get_theme(get_template());
			if (isset($resp['new_version']) && version_compare( $theme->get('Version'), $resp['new_version'], '<' ) ) {
				$transient->response['promosys'] = $resp;
			}

			// request and save plugins info
			$opt_res = wp_remote_get('http://up.cwsthemes.com/plugins/update.php', array( 'timeout' => 1));
			update_option('cws_plugin_ver', array('data' => $opt_res['body'], 'lasttime' => date('U')));
			// end of request and save plugins info
		}
		else{
			unset($transient->response['promosys']);
		}
	}
	return $transient;
}

// A purchase code notice
function cws_an_purchase_code() {
	$cws_theme = wp_get_theme();
	echo "<div class='update-nag'>" . $cws_theme->get('Name') . esc_html__(' theme notice: Please insert your Item Purchase Code in Theme Options to get the latest theme updates!', 'promosys') .'</div>';
}
# /Theme and plugin updates