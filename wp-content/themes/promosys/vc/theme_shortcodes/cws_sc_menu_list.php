<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'CWS_VC_Menu_List', 'promosys' ),
			"responsive"	=> 'all'
		)
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
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Menu List', 'CWS_VC_Menu_List', 'promosys' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
					array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Title', 'CWS_VC_Menu_List', 'promosys' ),
						"param_name"		=> "title",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Url', 'CWS_VC_Menu_List', 'promosys' ),
						"param_name"		=> "url",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Tag', 'CWS_VC_Menu_List', 'promosys' ),
						"param_name"		=> "tag",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "colorpicker",
						"heading"			=> esc_html_x( 'Tag Color', 'CWS_VC_Menu_List', 'promosys' ),
						"param_name"		=> "tag_color",
						"value"				=> PRIMARY_COLOR
					),
                ),
                "value"			=> "",
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'CWS_VC_Menu_List', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'CWS_VC_Menu_List', 'promosys' ),
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
		"name"				=> esc_html_x( 'CWS Menu List', 'CWS_VC_Menu_List', 'promosys' ),
		"base"				=> "cws_sc_menu_list",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Menu_List extends WPBakeryShortCode {
	    }
	}
?>