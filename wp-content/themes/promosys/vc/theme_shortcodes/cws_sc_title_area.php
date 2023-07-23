<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			    => "css_editor",
			"param_name"	    => "custom_styles",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => 'all',
		),
		array(
			"type"				=> "checkbox",
			"param_name"		=> "share_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"				=> array( esc_html_x( 'Extend Background to Previous Row', 'backend', 'promosys' ) => true ),
            "std"               => "1",
		),


        array(
            "type"				=> "checkbox",
            "param_name"		=> "customize_colors",
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "value"				=> array( esc_html_x( 'Customize Colors', 'backend', 'promosys' ) => true ),
        ),

        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Overlay color type', 'backend', 'promosys' ),
            'param_name'		=> 'overlay_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay Color type -                      $overlay_color_type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Overlay Color', 'backend', 'promosys' ),
            "param_name"		=> "overlay_color",
            "dependency"		=> array(
                "element"	=> "overlay_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay Color -                           $overlay_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "overlay_gradient_start",
            "dependency"		=> array(
                "element"	=> "overlay_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay gradient start Color -            $overlay_gradient_start
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "overlay_gradient_finish",
            "dependency"		=> array(
                "element"	=> "overlay_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay gradient finish Color -           $overlay_gradient_finish
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "param_name"		=> "overlay_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "overlay_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "154",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay gradient angle -                  $overlay_gradient_angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "overlay_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "overlay_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(178.32deg, rgba(255, 255, 255, 0.5) -20.58%, rgba(255, 255, 255, 0) 97.59%), linear-gradient(140.43deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);  background-position: 0 -60%; background-size: 100% 267%; opacity: 0.8;",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Overlay custom gradient -                 $overlay_gradient_custom

		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
			"value"				=> '#fff',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'promosys' ),
			"param_name"		=> "divider_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
			"value"				=> '#fff',
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Additional Info Color', 'backend', 'promosys' ),
            "param_name"		=> "info_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
            "value"				=> '#fff',
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Additional Info Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "info_color_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
            "value"				=> '#ffea74',
        ),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Breadcrumbs Color', 'backend', 'promosys' ),
			"param_name"		=> "breadcrumbs_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
			"value"				=> '#fff',
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Breadcrumbs Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "breadcrumbs_color_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "customize_colors",
                "not_empty"	=> true
            ),
            "value"				=> "#ffea74"
        ),


		array(
			"type"				=> "checkbox",
			"param_name"		=> "customize_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"responsive"		=> 'all',
			"value"				=> array( esc_html_x( 'Customize Sizes', 'backend', 'promosys' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "50px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Margins', 'backend', 'promosys' ),
			"param_name"		=> "title_margins",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "0px 0px 0px 0px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Divider Margins', 'backend', 'promosys' ),
			"param_name"		=> "divider_margins",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "7px 0px 12px 0px",
		),
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Additional Info Size', 'backend', 'promosys' ),
            "param_name"		=> "info_size",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "responsive"		=> 'all',
            "dependency"		=> array(
                "element"	=> "customize_size",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "16px",
        ),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Breadcrumbs Size', 'backend', 'promosys' ),
			"param_name"		=> "breadcrumbs_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "18px",
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
				"type"				=> "checkbox",
				"param_name"		=> "show_mask",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"				=> array( esc_html_x( 'Show Mask', 'backend', 'promosys' ) => true ),
			),
			array(
				"type"				=> "attach_image",
				"heading"			=> esc_html_x( 'SVG Mask', 'backend', 'promosys' ),
				"param_name"		=> "mask",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "show_mask",
					"not_empty"	=> true
				),
				"value"				=> ""
			),
			array(
				"type" 				=> "dropdown",
				"heading" 			=> esc_html__("Mask Start Pos", 'promosys'),
				"param_name" 		=> "mask_start",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "show_mask",
					"not_empty"	=> true
				),
				"value" 			=> array(
					esc_html__("Top Left", 'promosys') 		    => "top_left",
					esc_html__("Top Center", 'promosys') 		=> "top_center",
					esc_html__("Top Right", 'promosys') 		=> "top_right",
					esc_html__("Right Center", 'promosys') 	    => "right_center",
					esc_html__("Bottom Right", 'promosys') 	    => "bottom_right",
					esc_html__("Bottom Center", 'promosys')	    => "bottom_center",
					esc_html__("Bottom Left", 'promosys') 		=> "bottom_left",
					esc_html__("Left Center", 'promosys') 		=> "left_center",
				),
                "std"               => "bottom_center",
			),
			array(
				"type" 				=> "cws_dropdown",
				"heading" 			=> esc_html__("Hide", 'promosys'),
				"multiple"			=> "true",
				"param_name" 		=> "hide_fields",
				"value" 			=> array(
					esc_html__("None", 'promosys') 		    => "none",
					esc_html__("Title", 'promosys') 		=> "title",
					esc_html__("Divider", 'promosys') 	    => "divider",
					esc_html__("Post Info", 'promosys') 	=> "info",
					esc_html__("Breadcrumbs", 'promosys')	=> "breadcrumbs",
				),
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "mouse_anim",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"				=> array( esc_html_x( 'Mouse Move Animation', 'backend', 'promosys' ) => true ),
				"std"				=> "1"
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "scroll_anim",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
				"value"				=> array( esc_html_x( 'Scroll Animation', 'backend', 'promosys' ) => true ),
				"std"				=> "1"
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
		"name"				=> esc_html_x( 'CWS Title Area', 'backend', 'promosys' ),
		"base"				=> "cws_sc_title_area",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Title_Area extends WPBakeryShortCode {
	    }
	}
?>