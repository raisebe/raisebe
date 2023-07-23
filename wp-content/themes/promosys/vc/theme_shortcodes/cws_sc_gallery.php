<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	=> 'all',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'promosys' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#fff',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Plus Color', 'backend', 'promosys' ),
			"param_name"		=> "plus_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Overlay Gradient 1', 'backend', 'promosys' ),
			"param_name"		=> "overlay_gradient_1",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> 'rgba(255,175,0, .75)',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Overlay Gradient 2', 'backend', 'promosys' ),
			"param_name"		=> "overlay_gradient_2",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> 'rgba(255,104,73, .75)',
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
				"heading"		=> esc_html_x( 'Columns', 'CWS_VC_Button', 'promosys' ),
				"param_name"	=> "columns",
				"value"			=> array(
					esc_html_x( 'Two', 'CWS_VC_Button', 'promosys' )		=> '2',
					esc_html_x( 'Three', 'CWS_VC_Button', 'promosys' )		=> '3',
					esc_html_x( 'Four', 'CWS_VC_Button', 'promosys' )		=> '4',
				),
				"std"			=> '3'
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Images', 'backend', 'promosys' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
					array(
						"type"				=> "attach_image",
						"heading"			=> esc_html_x( 'Image', 'backend', 'promosys' ),
						"param_name"		=> "image",
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Subtitle', 'backend', 'promosys' ),
						"param_name"		=> "subtitle",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
                ),
                "value"			=> "",
            ),
            array(
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Link to:', 'CWS_VC_Button', 'promosys' ),
				"param_name"	=> "url",
				"value"			=> array(
					esc_html_x( 'None', 'CWS_VC_Button', 'promosys' )				=> 'none',
					esc_html_x( 'Media File', 'CWS_VC_Button', 'promosys' )		=> 'media',
					esc_html_x( 'Attachment Page', 'CWS_VC_Button', 'promosys' )	=> 'attachment',
				),
				"std"			=> 'none'
			),
            array(
				"type"			    => "checkbox",
				"param_name"	    => "enable_masonry",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"			    => array( esc_html_x( 'Enable Masonry', 'backend', 'promosys' ) => true ),
				"std"			    => '1'
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
		"name"				=> esc_html_x( 'CWS Gallery', 'backend', 'promosys' ),
		"base"				=> "cws_sc_gallery",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Gallery extends WPBakeryShortCode {
	    }
	}
?>