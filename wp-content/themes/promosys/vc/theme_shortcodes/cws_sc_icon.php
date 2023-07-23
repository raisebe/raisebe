<?php
	/* -----> ICONS PROPERTIES <----- */
    $icons = cws_ext_icon_vc_sc_config_params();

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = cws_ext_merge_arrs( array(
        array(
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_icon",
                "value"			    => array( esc_html_x( 'Show Icon Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Settings -                               $add_icon
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Icon Shape', 'backend', 'promosys' ),
                "param_name"		=> "icon_shape",
                "value"				=> array(
                    esc_html_x( "None", 'backend', 'promosys' ) 		=> 'none',
                    esc_html_x( "Round", 'backend', 'promosys' ) 	    => 'round',
                    esc_html_x( "Rounded", 'backend', 'promosys' ) 	    => 'rounded',
                ),
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon Shape  -                                 $icon_shape
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Icon Size', "backend", 'promosys' ),
                "param_name"		=> "icon_size",
                "group"				=> esc_html_x( "Styling", "backend", 'promosys' ),
                "responsive"		=> "all",
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "value"				=> "50px",
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // Icon Size  -                                  $icon_size
            array(
                "type"				=> "placeholder",
                "param_name"		=> "placeholder_2",
                "edit_field_class" 	=> "vc_col-xs-4",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Icon color type', 'backend', 'promosys' ),
                'param_name'		=> 'icon_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon color type  -                            $icon_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Icon Color', 'backend', 'promosys' ),
                "param_name"		=> "icon_color",
                "dependency"		=> array(
                    "element"	=> "icon_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon Color  -                                 $icon_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_start",
                "dependency"		=> array(
                    "element"	=> "icon_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient start Color -                   $icon_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "icon_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient finish Color -                  $icon_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "icon_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient angle -                         $icon_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "icon_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon custom gradient -                        $icon_gradient_custom
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Shape background color type', 'backend', 'promosys' ),
                'param_name'		=> 'shape_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "icon_shape",
                    "value"	    => array("round","rounded")
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape BG color type  -                        $shape_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Shape Front Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_color",
                "dependency"		=> array(
                    "element"	=> "shape_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape BG Color  -                             $shape_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_gradient_start",
                "dependency"		=> array(
                    "element"	=> "shape_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape BG gradient start Color -               $shape_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "shape_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape BG gradient finish Color -              $shape_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "shape_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "shape_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape BG gradient angle -                     $shape_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "shape_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "shape_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                ), // Shape BG custom gradient -                    $shape_gradient_custom
            array(
                "type"			    => "separator",
                "param_name"	    => "icon_separator",
                "responsive"		=> "all",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Separator
    
            array(
                "type"			    => "checkbox",
                "param_name"	    => "customize_align",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "responsive"	    => "all",
                "value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
            ), // Customize Alignment -                         $customize_align
            array(
                "type"			    => "dropdown",
                "heading"		    => esc_html_x( 'Icon Alignment', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"	    => "module_alignment",
                "edit_field_class" 	=> "vc_col-xs-4",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "customize_align",
                    "not_empty"	=> true
                ),
                "value"			    => array(
                    esc_html_x( "Left", 'backend', 'promosys' ) 	=> 'left',
                    esc_html_x( "Center", 'backend', 'promosys' ) 	=> 'center',
                    esc_html_x( "Right", 'backend', 'promosys' ) 	=> 'right',
                ),
                "std"               => "center"
            ), // Alignment -                                   $module_alignment
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
                "responsive"	=> 'all'
            ),
        ),
	));

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
        $icons, // Icon select
		array(
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Link', 'backend','promosys' ),
				"edit_field_class" 	=> "vc_col-xs-4",
				"param_name"		=> "url",
				"value"				=> ""
			), // URL -                                         $url
            array(
                "type"				=> "checkbox",
                "param_name"		=> "new_tab",
                "value"				=> array( esc_html_x( 'Open in new tab', "backend", 'promosys' ) => true ),
                "std"				=> "1",
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-8 cws-inline",
            ), // Open in new tab -                             $new_tab
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			), // Extra class name -                            $el_class
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
		"name"				=> esc_html_x( 'CWS Icon', 'backend', 'promosys' ),
		"base"				=> "cws_sc_icon",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Icon extends WPBakeryShortCode {
	    }
	}
?>