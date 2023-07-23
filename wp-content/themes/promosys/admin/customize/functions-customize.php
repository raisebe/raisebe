<?php
defined( 'ABSPATH' ) or die();

require_once PROMOSYS__PATH . 'admin/customize/inc/customize-helper-functions.php';
require_once PROMOSYS__PATH . 'admin/customize/controls/customizer-controls.php';

function promosys_set_defaults(){
    
    // Child theme set customizer properties
    if( is_child_theme() && get_option('promosys_child_theme_activated') != '1' ){
        update_option('promosys_child_theme_activated', '1');
    
        $theme_slug = get_option( 'template' );
        $mods       = get_option( "theme_mods_".$theme_slug );
    
        update_option( "theme_mods_".$theme_slug."-child", $mods );
    }

    if( get_option('promosys_theme_activated') != '1' ){ //Сomment this condition, if you need to remove default
        // customizer properties
        update_option('promosys_theme_activated', '1');

        $settings_default_props = promosys_get_defaults(promosys_customizer_controls());

        foreach( $settings_default_props as $setting_id => $default_value ){
            if( !get_theme_mod($setting_id) ){
                set_theme_mod($setting_id, $default_value);
            }

            // remove_theme_mod($setting_id); //Uncomment this line, if you need to remove default customizer properties
        }
    }
}
add_action( 'after_setup_theme', 'promosys_set_defaults' );


function promosys_register_customizer( $wp_customize ){

    require_once PROMOSYS__PATH . 'admin/customize/class-cws-customizer.php';
    
    promosys_read_options( $wp_customize, promosys_customizer_controls() );
}
add_action( 'customize_register', 'promosys_register_customizer', 10, 2 );


function my_enqueue_customizer_stylesheet() {
    wp_enqueue_style( 'customizer-styles', PROMOSYS__URI . 'admin/css/customizer.css', '', PROMOSYS__VERSION );
    wp_enqueue_style( 'customizer-styles', PROMOSYS__URI . 'admin/css/widgets.css', '', PROMOSYS__VERSION );
}
add_action( 'customize_controls_print_styles', 'my_enqueue_customizer_stylesheet' );


function promosys_customizer_css(){
    if( !empty($GLOBALS['data_to_send']) ){
        $live_preview_styles = json_decode($GLOBALS['data_to_send']['ajax_data']);
        $out = $control = $elem = $style = '';

        if( !empty($live_preview_styles) ){
            $out .= "<style type='text/css'>";

            foreach( $live_preview_styles as $key => $value ){
                foreach ($value as $k => $v) {
                    switch($k) {
                        case 'control':
                            $control = $v;
                            break;
                        case 'trigger_class':
                            $elem = $v;
                            break;
                        case 'style_to_change':
                            $style = $v;
                            break;
                        default:
                            break;
                    }
                }

                $out .= $elem."{";
                    $out .= $style.": ".esc_attr(get_theme_mod($control)).";";
                $out .= "}";
            }

            $out .= "</style>";
        }

        echo sprintf('%s', $out);
    }
}
add_action( 'wp_head', 'promosys_customizer_css');


function promosys_customizer_control_toggle(){
    wp_enqueue_script( 
        'contextual-controls',
        get_template_directory_uri() . '/admin/customize/inc/cws_customizer_context.js?v=' . rand(),
        array( 'customize-controls' ), 
        '',
        false
    );

    wp_localize_script( 'contextual-controls', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ));
}
add_action( 'customize_controls_enqueue_scripts', 'promosys_customizer_control_toggle' );


function promosys_customizer_preview(){
    wp_enqueue_script(
        'live-preview',
        get_template_directory_uri() . '/admin/customize/inc/cws_customizer.js',
        array( 'jquery', 'customize-preview' ),
        '',
        true
    );

    wp_localize_script( 'live-preview', 'preview_controls', $GLOBALS['data_to_send'] );
}
add_action( 'customize_preview_init', 'promosys_customizer_preview' );

require_once PROMOSYS__PATH . 'admin/customize/inc/customizer-ajax-functions.php';

?>