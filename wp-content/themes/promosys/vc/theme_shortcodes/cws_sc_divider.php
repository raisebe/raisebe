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

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"			    => "dropdown",
				"heading"		    => esc_html_x( 'Style', 'backend', 'promosys' ),
				"param_name"	    => "style",
				"value"			    => array(
					esc_html_x( 'Simple', 'backend', 'promosys' )		=> 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )		=> 'gradient',
					esc_html_x( 'Special', 'backend', 'promosys' )		=> 'special',
				),
				"admin_label"   => true,
				"std"			=> 'simple',
                "edit_field_class" 	=> "vc_col-xs-4",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Divider Color', 'backend', 'promosys' ),
				"param_name"		=> "color",
                "dependency"		=> array(
                    "element"	=> "style",
                    "value"		=> array("simple")
                ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> PRIMARY_COLOR
			),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Gradient Start Color', 'backend', 'promosys' ),
                "param_name"		=> "gradient_start_color",
                "dependency"		=> array(
                    "element"	=> "style",
                    "value"		=> array("gradient","special")
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR
            ),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Gradient Finish Color', 'backend', 'promosys' ),
				"param_name"		=> "gradient_finish_color",
				"edit_field_class" 	=> "vc_col-xs-2",
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> array("gradient","special")
				),
				"value"				=> SECONDARY_COLOR
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
		"name"				=> esc_html_x( 'CWS Divider', 'backend', 'promosys' ),
		"base"				=> "cws_sc_divider",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Divider extends WPBakeryShortCode {
	    }
	}
?>