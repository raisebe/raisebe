<?php
	/* -----> ICONS PROPERTIES <----- */
	$icons = cws_ext_icon_vc_sc_config_params('add_icon', true);

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	=> 'all'
		),
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_align",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => "all",
			"value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
		),
		array(
			"type"			=> "dropdown",
			"heading"		=> esc_html_x( 'Aligning', 'backend', 'promosys' ),
			"param_name"	=> "aligning",
			"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	=> "all",
			"dependency"	=> array(
				"element"		=> "customize_align",
				"not_empty"		=> true
			),
			"value"			=> array(
				esc_html_x( 'Left', 'backend', 'promosys' )	=> 'left',
				esc_html_x( 'Center', 'backend', 'promosys' )	=> 'center',
				esc_html_x( 'Right', 'backend', 'promosys' )	=> 'right',
			)
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
				"type"				=> "textfield",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
				"param_name"		=> "title",
				"value"				=> "Click Me!",
                "edit_field_class" 	=> "vc_col-xs-4",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Link', 'backend', 'promosys' ),
				"edit_field_class" 	=> "vc_col-xs-4",
				"param_name"		=> "url",
                "value"             => "#"
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "new_tab",
				"value"				=> array( esc_html_x( 'Open in New Tab', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-4 cws-inline",
			),
            array(
                "type"			    => "separator",
                "param_name"	    => "title_separator",
            ), // Separator
            
            
            array(
                "type"			=> "dropdown",
                "heading"		=> esc_html_x( 'Button Style', 'backend', 'promosys' ),
                "param_name"	=> "btn_style",
                "value"			=> array(
                    esc_html_x( 'Arrow Fade In', 'backend', 'promosys' )		=> 'arrow_fade_in',
                    esc_html_x( 'Arrow Fade Out', 'backend', 'promosys' )		=> 'arrow_fade_out',
                    esc_html_x( 'Simple', 'backend', 'promosys' )				=> 'simple',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
            ),
            array(
                "type"			=> "dropdown",
                "heading"		=> esc_html_x( 'Button Size', 'backend', 'promosys' ),
                "param_name"	=> "btn_size",
                "value"			=> array(
                    esc_html_x( 'Large', 'backend', 'promosys' )		=> 'large',
                    esc_html_x( 'Medium', 'backend', 'promosys' )		=> 'medium',
                    esc_html_x( 'Small', 'backend', 'promosys' )		=> 'small',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "std"           => "medium"
            ),
            array(
                "type"				=> "checkbox",
                "param_name"		=> "add_shadow",
                "value"				=> array( esc_html_x( 'Add shadow', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox cws-inline vc_col-xs-4",
            ),
            array(
                "type"			    => "separator",
                "param_name"	    => "settings_separator",
            ), // Separator
            
            
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "set_bg",
                "value"				=> array( esc_html_x( 'Set background color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ),
            
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Background color type', 'backend', 'promosys' ),
                'param_name'		=> 'bg_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "set_bg",
                    "not_empty"	=> true
                ),
                "std"               => "custom_gradient"
            ), // BG color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_color",
                "dependency"		=> array(
                    "element"	=> "bg_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
            ), // BG Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_start",
                "dependency"		=> array(
                    "element"	=> "bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
            ), // BG gradient start Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
            ), // BG gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "90",
            ), // BG gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "bg_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
            ), // BG custom gradient
            
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Background color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'bg_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "set_bg",
                    "not_empty"	=> true
                ),
                "std"               => "simple"
            ), // BG color type on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_color_hover",
                "dependency"		=> array(
                    "element"	=> "bg_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
            ), // BG Color on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
            ), // BG gradient start Color on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
            ), // BG gradient finish Color on Hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
            ), // BG gradient angle on Hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "bg_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "bg_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
            ), // BG custom gradient on Hover
            array(
                "type"			    => "separator",
                "param_name"	    => "background_separator",
            ), // Separator
            
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "set_color",
                "value"				=> array( esc_html_x( 'Set title color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_font_color",
                "value"				=> '#ffffff',
                "dependency"		=> array(
                    "element"	=> "set_color",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
            ),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "btn_font_color_hover",
                "value"				=> '#ffffff',
                "dependency"		=> array(
                    "element"	=> "set_color",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
            ),
            array(
                "type"			    => "separator",
                "param_name"	    => "color_separator",
            ), // Separator
            
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "set_border",
                "value"				=> array( esc_html_x( 'Set border color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_border_color",
                "value"				=> '',
                "dependency"		=> array(
                    "element"	=> "set_border",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
            ),
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "btn_border_color_hover",
                "value"				=> '',
                "dependency"		=> array(
                    "element"	=> "set_border",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
            ),
            array(
                "type"			    => "separator",
                "param_name"	    => "border_separator",
            ), // Separator
            
            
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_icon",
                "value"			    => array( esc_html_x( 'Add Icon to button', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ),
        ),
        $icons,
        array(
            array(
                "type"			    => "separator",
                "param_name"	    => "icon_separator",
            ), // Separator
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
		"name"				=> esc_html_x( 'CWS Button', 'backend', 'promosys' ),
		"base"				=> "cws_sc_button",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Button extends WPBakeryShortCode {
	    }
	}
?>