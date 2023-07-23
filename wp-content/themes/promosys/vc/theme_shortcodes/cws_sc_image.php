<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = cws_ext_merge_arrs( array(
		array(
			array(
				"type"			    => "css_editor",
				"param_name"	    => "custom_styles",
				"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
				"responsive"	    => 'all'
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
				"dependency"		=> array(
					"element"	  => "customize_align",
					"not_empty"	  => true
				),
				"value"			=> array(
					esc_html_x( "Left", 'backend', 'promosys' ) => 'left',
					esc_html_x( "Center", 'backend', 'promosys' ) => 'center',
					esc_html_x( "Right", 'backend', 'promosys' ) => 'right',
				),
				"std"			=> 'center',
			),
		)
	));

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "attach_image",
				"heading"			=> esc_html_x( 'Image', 'backend', 'promosys' ),
				"param_name"		=> "image",
			),
            array(
                "type"				=> "attach_image",
                "heading"			=> esc_html_x( 'Hover Image', 'backend', 'promosys' ),
                "param_name"		=> "hover_image",
                "dependency"		=> array(
                    "element"	=> "bg_hover",
                    "value"		=> array('flip', 'fall'),
                ),
            ),
            array(
                "type"			=> "dropdown",
                "heading"		=> esc_html__( 'Thumbnail size', 'metamax' ),
                "param_name"	=> "thumbnail_size",
                "value"         => array(
                    esc_html__( 'Full', 'metamax' )             => 'full',
                    esc_html__( 'Large', 'metamax' )            => 'large',
                    esc_html__( 'Medium large', 'metamax' )     => 'medium_large',
                    esc_html__( 'Medium', 'metamax' )           => 'medium',
                    esc_html__( 'Thumbnail', 'metamax' )        => 'thumbnail',
                ),
            ),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Image Hover Effect', 'backend', 'promosys' ),
				"param_name"		=> "bg_hover",
				"value"				=> array(
					esc_html_x( 'No Hover', 'backend', 'promosys' )		=> 'no_hover',
					esc_html_x( '3D', 'backend', 'promosys' )			=> '3d',
					esc_html_x( 'Flip', 'backend', 'promosys' )			=> 'flip',
					esc_html_x( 'Falling Down', 'backend', 'promosys' )	=> 'fall',
					esc_html_x( 'Grayscale', 'backend', 'promosys' )	=> 'grayscale',
				),
				"std"				=> 'no_hover'
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Sensivity', "backend", 'promosys' ),
				"param_name"		=> "max_tilt",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "10"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Perspective', "backend", 'promosys' ),
				"param_name"		=> "perspective",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "1000"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Scale', "backend", 'promosys' ),
				"param_name"		=> "scale",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "1"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Speed', "backend", 'promosys' ),
				"description"		=> esc_html_x( 'Speed of the enter/exit transition', "backend", 'promosys' ),
				"param_name"		=> "speed",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "300"
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
		"name"				=> esc_html_x( 'CWS Image', 'backend', 'promosys' ),
		"base"				=> "cws_sc_image",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Image extends WPBakeryShortCode {
	    }
	}
?>