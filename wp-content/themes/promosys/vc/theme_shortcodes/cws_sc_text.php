<?php

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
	    
        // Title Options
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_title",
            "value"			    => array( esc_html_x( 'Show Title Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Title
        array(
            "type"				=> "dropdown",
            "heading"			=> esc_html_x( 'Title HTML Tag', 'backend', 'promosys' ),
            "param_name"		=> "title_tag",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> array(
                esc_html_x( "Default - (H3)", 'backend', 'promosys' ) 	=> 'h3',
                esc_html_x( "H1", 'backend', 'promosys' ) 				=> 'h1',
                esc_html_x( "H2", 'backend', 'promosys' ) 				=> 'h2',
                esc_html_x( "H3", 'backend', 'promosys' ) 				=> 'h3',
                esc_html_x( "H4", 'backend', 'promosys' ) 				=> 'h4',
                esc_html_x( "H5", 'backend', 'promosys' ) 				=> 'h5',
                esc_html_x( "H6", 'backend', 'promosys' ) 				=> 'h6',
            ),
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title HTML Tag
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
            "param_name"		=> "title_size",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Size
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Line Height', 'backend', 'promosys' ),
            "param_name"		=> "title_line_height",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Line-Height
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Margin Bottom', 'backend', 'promosys' ),
            "param_name"		=> "title_margin",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "25px",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Margin Bottom
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Title color type', 'backend', 'promosys' ),
            'param_name'		=> 'title_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title color type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
            "param_name"		=> "title_color",
            "dependency"		=> array(
                "element"	=> "title_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> '#243238',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "title_gradient_start",
            "dependency"		=> array(
                "element"	=> "title_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title gradient start Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "title_gradient_finish",
            "dependency"		=> array(
                "element"	=> "title_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title gradient finish Color
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "param_name"		=> "title_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "title_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "154",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title gradient angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "title_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "title_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title custom gradient
        array(
            "type"			    => "separator",
            "param_name"	    => "title_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_divider",
            "value"			    => array( esc_html_x( 'Show Divider Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Divider
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Divider Margin Bottom', 'backend', 'promosys' ),
            "param_name"		=> "divider_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_divider",
                "not_empty"	=> true
            ),
            "value"				=> "18px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider Margin Bottom
        array(
            "type"				=> "placeholder",
            "param_name"		=> "placeholder",
            "edit_field_class" 	=> "vc_col-xs-8",
            "dependency"		=> array(
                "element"	=> "add_divider",
                "not_empty"	=> true
            ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Placeholder
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Divider color type', 'backend', 'promosys' ),
            'param_name'		=> 'divider_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	    => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	    => 'gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_divider",
                "not_empty"	=> true
            ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider color type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Divider Color', 'backend', 'promosys' ),
            "param_name"		=> "divider_color",
            "dependency"		=> array(
                "element"	=> "divider_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Divider gradient start Color', 'backend', 'promosys' ),
            "param_name"		=> "divider_gradient_start",
            "dependency"		=> array(
                "element"	=> "divider_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-3",
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider gradient start Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Divider gradient finish Color', 'backend', 'promosys' ),
            "param_name"		=> "divider_gradient_finish",
            "dependency"		=> array(
                "element"	=> "divider_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-3",
            "value"				=> SECONDARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider gradient finish Color
        array(
            "type"			    => "separator",
            "param_name"	    => "divider_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_subtitle",
            "value"			    => array( esc_html_x( 'Show Subtitle Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Subtitle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Subtitle Size', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_size",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_subtitle",
                "not_empty"	=> true
            ),
            "value"				=> "12px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Size
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Subtitle Margin Bottom', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_margin",
            "edit_field_class" 	=> "vc_col-xs-3",
            "dependency"		=> array(
                "element"	=> "add_subtitle",
                "not_empty"	=> true
            ),
            "value"				=> "19px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Margin Bottom
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Subtitle Color', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_color",
            "edit_field_class" 	=> "vc_col-xs-5",
            "dependency"		=> array(
                "element"	=> "add_subtitle",
                "not_empty"	=> true
            ),
            "value"				=> "#ffffff",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Color
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Subtitle Background type', 'backend', 'promosys' ),
            'param_name'		=> 'subtitle_bg_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	   => "add_subtitle",
                "not_empty"	   => true
            ),
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle BG color type  -                                    $subtitle_bg_color_type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Background Color', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_bg_color",
            "dependency"		=> array(
                "element"	=> "subtitle_bg_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Background Color  -                                 $subtitle_bg_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_bg_gradient_start",
            "dependency"		=> array(
                "element"	=> "subtitle_bg_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Background gradient start Color -                   $subtitle_bg_gradient_start
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_bg_gradient_finish",
            "dependency"		=> array(
                "element"	=> "subtitle_bg_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Background gradient finish Color -                  $subtitle_bg_gradient_finish
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_bg_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "subtitle_bg_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "154",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Background gradient angle -                         $subtitle_bg_gradient_angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "subtitle_bg_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "subtitle_bg_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(151.18deg, #5C52D8 -42.06%, #4F5BD5 130.7%);",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Subtitle Background custom gradient -                        $subtitle_bg_gradient_custom
        array(
            "type"			    => "separator",
            "param_name"	    => "subtitle_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_text",
            "value"			    => array( esc_html_x( 'Show Text Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Add Test
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Text Size', 'backend', 'promosys' ),
            "param_name"		=> "text_size",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_text",
                "not_empty"	=> true
            ),
            "value"				=> "16px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Text Size
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Font Color', 'backend', 'promosys' ),
            "param_name"		=> "font_color",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_text",
                "not_empty"	=> true
            ),
            "value"				=> "#3b545f",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Text Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Font Accent Color', 'backend', 'promosys' ),
            "param_name"		=> "font_accent_color",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_text",
                "not_empty"	=> true
            ),
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Text Accent Color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Font Color Hover', 'backend', 'promosys' ),
            "param_name"		=> "font_color_hover",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "add_text",
                "not_empty"	=> true
            ),
            "value"				=> SECONDARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Text Color Hover
        array(
            "type"			    => "separator",
            "param_name"	    => "text_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_align",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => "all",
			"value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
		), // Customize align
		array(
			"type"			    => "dropdown",
			"heading"		    => esc_html_x( 'Text Alignment', 'backend', 'promosys' ),
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"param_name"	    => "module_alignment",
			"responsive"	    => "all",
			"dependency"		=> array(
				"element"	=> "customize_align",
				"not_empty"	=> true
			),
			"value"			    => array(
				esc_html_x( "Left", 'backend', 'promosys' ) 	=> 'left',
				esc_html_x( "Center", 'backend', 'promosys' )   => 'center',
				esc_html_x( "Right", 'backend', 'promosys' ) 	=> 'right',
			),
            "edit_field_class" 	=> "vc_col-xs-4",
		), // Alignment
        array(
            "type"			    => "separator",
            "param_name"	    => "alignment_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			=> "css_editor",
            "param_name"	=> "custom_styles",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "responsive"	=> 'all',
        ), // Custom styles
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
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "admin_label"		=> true,
                "param_name"		=> "title",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-10",
            ), // Title
            array(
                "type"				=> "textarea",
                "heading"			=> esc_html_x( 'Subtitle', 'backend', 'promosys' ),
                "param_name"		=> "subtitle",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-10",
            ), // Subtitle
            array(
                "type"				=> "textarea_html",
                "heading"			=> esc_html_x( 'Text', 'backend', 'promosys' ),
                "param_name"		=> "content",
                "edit_field_class" 	=> "vc_col-xs-10",
            ), // Text
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			), // Extra Classes
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
		"name"				=> esc_html_x( 'CWS Text', 'backend', 'promosys' ),
		"base"				=> "cws_sc_text",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Text extends WPBakeryShortCode {
	    }
	}
?>