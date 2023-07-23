<?php

function promosys_customizer_controls(){
    // Get all exist headers
    $custom_headers = array();
    if( function_exists('cws_hf_init') ){
        $args = array(
            'post_type'         => 'cws-tmpl-header',
            'posts_per_page'    => -1
        );

        $headers = new WP_Query($args);
        foreach ($headers->posts as $header) {
            $custom_headers[$header->ID] = esc_html($header->post_title);
        }
    }

    // Get all exist sticky headers
    $custom_sticky_headers = array();
    if( function_exists('cws_hf_init') ){
        $args = array(
            'post_type'         => 'cws-tmpl-sticky',
            'posts_per_page'    => -1
        );

        $sticky_headers = new WP_Query($args);
        foreach ($sticky_headers->posts as $sticky) {
            $custom_sticky_headers[$sticky->ID] = esc_html($sticky->post_title);
        }
    }

    // Get all exist footers
    $custom_footers = array();
    if( function_exists('cws_hf_init') ){
        $args = array(
            'post_type'         => 'cws-tmpl-footer',
            'posts_per_page'    => -1
        );

        $footers = new WP_Query($args);
        foreach ($footers->posts as $footer) {
            $custom_footers[$footer->ID] = esc_html($footer->post_title);
        }
    }

    class_exists('WooCommerce') ? $woo_panel_layout = require '_woocommerce.php' : $woo_panel_layout = array();
    
    return $customizer_extensions = array(
        'general' => array(
            'title'         => esc_html_x('General', 'customizer', 'promosys'),
            'description'   => esc_html_x('General Theme Options', 'customizer', 'promosys'),
            'priority'      => 5,
            'layout'        => require '_general.php'
        ),
        'header_panel' => array(
            'title'         => esc_html_x('Header', 'customizer', 'promosys'),
            'description'   => esc_html_x('Promosys Header Properties', 'customizer', 'promosys'),
            'priority'      => 6,
            'layout'        => require '_header.php'
        ),
        'footer_panel' => array(
            'title'         => esc_html_x('Footer', 'customizer', 'promosys'),
            'descripton'    => esc_html_x('Promosys Footer Properties', 'customizer', 'promosys'),
            'priority'      => 7,
            'layout'        => require '_footer.php'
        ),
        'woo_panel' => array(
            'title'         => esc_html_x('Shop', 'customizer', 'promosys'),
            'descripton'    => esc_html_x('Promosys WooCommerce Shop Properties', 'customizer', 'promosys'),
            'priority'      => 8,
            'layout'        => $woo_panel_layout
        )
    );
}

?>