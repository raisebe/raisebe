<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	=> 'all'
		),
		array(
			"type"				=> "checkbox",
			"param_name"		=> "custom_colors",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"value"				=> array( esc_html_x( 'Custom Colors', 'backend', 'promosys' ) => true ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"std"				=> '1'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Arrows Color', 'backend', 'promosys' ),
			"param_name"		=> "nav_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"dependency"		=> array(
				"element"	=> "custom_colors",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffffff"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Arrows Hover Color', 'backend', 'promosys' ),
			"param_name"		=> "nav_hover_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"dependency"		=> array(
				"element"	=> "custom_colors",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Dots Color', 'backend', 'promosys' ),
			"param_name"		=> "dots_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"dependency"		=> array(
				"element"	=> "custom_colors",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#c9c9c9'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Dots Active Color', 'backend', 'promosys' ),
			"param_name"		=> "dots_active_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"dependency"		=> array(
				"element"	=> "custom_colors",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape =  cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait =  cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile =  cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"			    => "dropdown",
				"heading"		    => esc_html_x( 'Carousel Columns', 'backend', 'promosys' ),
				"param_name"	    => "columns",
				"value"			    => array(
					esc_html_x( "One", 'backend', 'promosys' ) 		=> '1',
					esc_html_x( "Two", 'backend', 'promosys' )		=> '2',
					esc_html_x( "Three", 'backend', 'promosys' )	=> '3',
					esc_html_x( "Four", 'backend', 'promosys' )		=> '4',
					esc_html_x( "Five", 'backend', 'promosys' )		=> '5',
					esc_html_x( "Six", 'backend', 'promosys' )		=> '6',
				)		
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Landscape Columns', 'backend', 'promosys' ),
				"param_name"		=> "landscape_columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( "One", 'backend', 'promosys' ) 		=> '1',
					esc_html_x( "Two", 'backend', 'promosys' )		=> '2',
					esc_html_x( "Three", 'backend', 'promosys' )		=> '3',
					esc_html_x( "Four", 'backend', 'promosys' )		=> '4',
					esc_html_x( "Five", 'backend', 'promosys' )		=> '5',
					esc_html_x( "Six", 'backend', 'promosys' )		=> '6',
				)		
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Portrait Columns', 'backend', 'promosys' ),
				"param_name"		=> "portrait_columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( "One", 'backend', 'promosys' ) 		=> '1',
					esc_html_x( "Two", 'backend', 'promosys' )		=> '2',
					esc_html_x( "Three", 'backend', 'promosys' )		=> '3',
					esc_html_x( "Four", 'backend', 'promosys' )		=> '4',
					esc_html_x( "Five", 'backend', 'promosys' )		=> '5',
					esc_html_x( "Six", 'backend', 'promosys' )		=> '6',
				)		
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Mobile Columns', 'backend', 'promosys' ),
				"param_name"		=> "mobile_columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( "One", 'backend', 'promosys' ) 		=> '1',
					esc_html_x( "Two", 'backend', 'promosys' )		=> '2',
					esc_html_x( "Three", 'backend', 'promosys' )		=> '3',
					esc_html_x( "Four", 'backend', 'promosys' )		=> '4',
					esc_html_x( "Five", 'backend', 'promosys' )		=> '5',
					esc_html_x( "Six", 'backend', 'promosys' )		=> '6',
				)		
			),
			array(
				"type"			    => "textfield",
				"heading"		    => esc_html_x( 'Slides to scroll', 'backend', 'promosys' ),
				"param_name"	    => "slides_to_scroll",
				"value"			    => "1"
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "pagination",
				"value"			    => array( esc_html_x( 'Add Pagination Dots', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"std"			    => '1'
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "navigation",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Add Navigation Arrows', 'backend', 'promosys' ) => true )
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "auto_height",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Auto Height', 'backend', 'promosys' ) => true ),
				"std"			    => '1'
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "draggable",
				"value"			    => array( esc_html_x( 'Draggable', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"std"			    => '1'
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "infinite",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Infinite Loop', 'backend', 'promosys' ) => true )
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "autoplay",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Autoplay', 'backend', 'promosys' ) => true )
			),
			array(
				"type"			    => "textfield",
				"heading"		    => esc_html_x( 'Autoplay Speed', 'backend', 'promosys' ),
				"dependency"	    => array(
					"element"	=> "autoplay",
					"not_empty"	=> true
				),
				"param_name"	    => "autoplay_speed",
				"value"			    => "3000"
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "pause_on_hover",
				"dependency"	    => array(
					"element"	=> "autoplay",
					"not_empty"	=> true
				),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Pause on Hover', 'backend', 'promosys' ) => true )
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "vertical",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Vertical Direction', 'backend', 'promosys' ) => true )
			),
			array(
				"type"			    => "checkbox",
				"param_name"	    => "vertical_swipe",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Vertical Swipe', 'backend', 'promosys' ) => true )
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

	vc_map( array(
		"name"				=> esc_html_x( 'CWS Carousel', 'backend', 'promosys' ),
		"base"				=> "cws_sc_carousel",
		'content_element' 	=> true,
		'as_parent'			=> array('only' => 'vc_column_text, cws_sc_image, cws_sc_text, cws_sc_services, cws_sc_widget_text, vc_single_image, products'),
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		'js_view' 			=> 'VcColumnView',
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Carousel extends WPBakeryShortCodesContainer {
	    }
	}
?>