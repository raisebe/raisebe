<?php
	/* -----> MENUS PROPERTIES <----- */
	$args = get_terms('nav_menu', array('hide_empty' => true));
	$menus = array( 'None' => 'none' );

	if( !empty($args) ){
		foreach( $args as $value ){
			$menus[$value->name] = $value->slug;
		}
	}

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			    => "css_editor",
			"param_name"	    => "custom_styles",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => 'all',
		),
        array(
            "type"			    => "textfield",
            "heading"		    => esc_html_x( 'Menu item line-height', 'backend', 'promosys' ),
            "param_name"	    => "line_height",
            "edit_field_class" 	=> "vc_col-xs-6",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "description"       => esc_html_x( 'in pixels', 'backend', 'promosys' ),
            "value"			    => "24"
        ),
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_align",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"responsive"	    => "all",
			"value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
		),
		array(
			"type"			    => "dropdown",
			"heading"		    => esc_html_x( 'Alignment', 'backend', 'promosys' ),
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"param_name"	    => "alignment",
			"responsive"	    => "all",
			"dependency"	    => array(
				"element"		=> "customize_align",
				"not_empty"		=> true
			),
			"value"			=> array(
				esc_html_x( "Left", 'backend', 'promosys' )     => 'flex-start',
				esc_html_x( "Center", 'backend', 'promosys' )   => 'center',
				esc_html_x( "Right", 'backend', 'promosys' )    => 'flex-end',
			),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Color', 'backend', 'promosys' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"param_name"		=> "color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffffff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Hover', 'backend', 'promosys' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"param_name"		=> "hover_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffea74",
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Submenu Font Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "submenu_color",
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#243238",
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Submenu Font Hover', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "submenu_color_hover",
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> PRIMARY_COLOR,
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
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Choose Menu', 'backend', 'promosys' ),
				"param_name"	=> "menu",
				"value"			=> $menus	
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
		"name"				=> esc_html_x( 'CWS Menu', 'backend', 'promosys' ),
		"base"				=> "cws_sc_menu",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Menu extends WPBakeryShortCode {
	    }
	}
?>