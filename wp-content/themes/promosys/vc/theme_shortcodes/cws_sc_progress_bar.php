<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_title",
            "value"			    => array( esc_html_x( 'Show Title Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Title
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
            "param_name"		=> "title_color",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "value"				=> "#243238",
             "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title color
        array(
            "type"			    => "separator",
            "param_name"	    => "title_separator",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_counter",
            "value"			    => array( esc_html_x( 'Show Counter Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Counter
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Percents Color', 'backend', 'promosys' ),
            "param_name"		=> "percents_color",
            "value"				=> "#243238",
            "dependency"		=> array(
                "element"	=> "add_counter",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Percents color
        array(
            "type"			    => "separator",
            "param_name"	    => "counter_separator",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_bar",
            "value"			    => array( esc_html_x( 'Show Progress Bar Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Progress Bar
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Progress Bar color type', 'backend', 'promosys' ),
            'param_name'		=> 'bar_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_bar",
                "not_empty"	=> true
            ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Bar color type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Bar Color', 'backend', 'promosys' ),
            "param_name"		=> "bar_color",
            "dependency"		=> array(
                "element"	=> "bar_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Bar Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "bar_gradient_start",
            "dependency"		=> array(
                "element"	=> "bar_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-3",
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Bar gradient start Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "bar_gradient_finish",
            "dependency"		=> array(
                "element"	=> "bar_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-3",
            "value"				=> SECONDARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Bar gradient finish Color
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "bar_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "bar_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(90deg, #F76331 -8.57%, #C01FB8 184.64%);",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Bar custom gradient
        array(
            "type"			    => "separator",
            "param_name"	    => "bar_separator",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'CWS_VC_Gallery', 'promosys' ),
			"responsive"	=> 'all',
		),
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "admin_label"		=> true,
                "param_name"		=> "title",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-8",
            ), // Title
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Percents', 'backend', 'promosys' ),
                "param_name"		=> "percents",
                "admin_label"       => true,
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // Percents
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
		"name"				=> esc_html_x( 'CWS Progress Bar', 'backend', 'promosys' ),
		"base"				=> "cws_sc_progress_bar",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Progress_Bar extends WPBakeryShortCode {
	    }
	}
?>