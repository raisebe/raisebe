<?php
    /* -----> STYLING TAB PROPERTIES <----- */
    $styles = array(
        array(
            "type"			=> "css_editor",
            "param_name"	=> "custom_styles",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "responsive"	=> 'all',
        ),
    );
    
    /* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
    $styles_landscape = $styles_portrait = $styles_mobile = $styles;
    
    $styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
    $styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
    $styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());
    
	/* -----> STYLING TAB PROPERTIES <----- */
	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Type', 'backend', 'promosys' ),
				"param_name"		=> "style",
				"value"				=> array(
					esc_html_x( 'Info message', 'backend', 'promosys' )		=> 'info',
					esc_html_x( 'Success message', 'backend', 'promosys' )	=> 'success',
					esc_html_x( 'Warning message', 'backend', 'promosys' )	=> 'warning',
					esc_html_x( 'Error message', 'backend', 'promosys' )	=> 'error',
				),
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
				"param_name"		=> "title",
                "admin_label"       => true
			),
			array(
				"type"				=> "textarea",
				"heading"			=> esc_html_x( 'Description', 'backend', 'promosys' ),
				"param_name"		=> "description",
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "closable",
				"value"				=> array( esc_html_x( 'Show Close Button', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			),
		),
        /* -----> STYLING TAB <----- */
        $styles,
        /* -----> TABLET LANDSCAPE TAB <----- */
        $styles_landscape,
        /* -----> TABLET PORTRAIT TAB <----- */
        $styles_portrait,
        /* -----> MOBILE TAB <----- */
        $styles_mobile
	));

	/* -----> MODULE DECLARATION <----- */
	vc_map( array(
		"name"				=> esc_html_x( 'CWS Info Box', 'backend', 'promosys' ),
		"base"				=> "cws_sc_info_box",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Info_Box extends WPBakeryShortCode {
	    }
	}
?>