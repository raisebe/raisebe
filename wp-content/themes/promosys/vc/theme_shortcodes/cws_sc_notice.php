<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'CWS_VC_Notice', 'promosys' ),
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
				"type"				=> "textarea",
				"heading"			=> esc_html_x( 'Notice', 'CWS_VC_Notice', 'promosys' ),
				"param_name"		=> "notice",
				"value"				=> "FINAL CLEARANCE: Take 20% off ‘Sale Must-Haves'",
				"admin_label"		=> true,
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "closable",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"				=> array( esc_html_x( 'Closable', 'CWS_VC_Notice', 'promosys' ) => true ),
				"std"				=> "1"
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Text Color', 'CWS_VC_Notice', 'promosys' ),
				"param_name"		=> "font_color",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> '#ffffff',
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Close Color', 'CWS_VC_Notice', 'promosys' ),
				"param_name"		=> "close_color",
				"edit_field_class" 	=> "vc_col-xs-4",
				"dependency"		=> array(
					"element"	=> "closable",
					"not_empty"	=> true
				),
				"value"				=> PRIMARY_COLOR,
			),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Close Color on Hover', 'CWS_VC_Notice', 'promosys' ),
                "param_name"		=> "close_color_hover",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "closable",
                    "not_empty"	=> true
                ),
                "value"				=> SECONDARY_COLOR,
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'CWS_VC_Notice', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'CWS_VC_Notice', 'promosys' ),
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
		"name"				=> esc_html_x( 'CWS Notice', 'CWS_VC_Notice', 'promosys' ),
		"base"				=> "cws_sc_notice",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Notice extends WPBakeryShortCode {
	    }
	}
?>