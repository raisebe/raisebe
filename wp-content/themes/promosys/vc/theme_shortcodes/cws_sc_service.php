<?php
	/* -----> ICONS PROPERTIES <----- */
	$icons = cws_ext_icon_vc_sc_config_params( 'icon_img', 'icon' );

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_icon",
                "value"			    => array( esc_html_x( 'Show Icon Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Icon Settings -                          $add_icon
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Icon Shape', 'backend', 'promosys' ),
                "param_name"		=> "icon_shape",
                "value"				=> array(
                    esc_html_x( "None", 'backend', 'promosys' ) 		=> 'none',
                    esc_html_x( "Blot", 'backend', 'promosys' ) 		=> 'blot',
                    esc_html_x( "Round", 'backend', 'promosys' ) 	    => 'round',
                    esc_html_x( "Ellipse", 'backend', 'promosys' ) 	    => 'ellipse',
                    esc_html_x( "Triangle", 'backend', 'promosys' ) 	=> 'triangle',
                ),
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon Shape  -                                 $icon_shape
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Image Shape', 'backend', 'promosys' ),
                "param_name"		=> "image_shape",
                "value"				=> array(
                    esc_html_x( "None", 'backend', 'promosys' ) 		=> 'none',
                    esc_html_x( "Round", 'backend', 'promosys' ) 	    => 'round',
                    esc_html_x( "Ellipse", 'backend', 'promosys' ) 	    => 'ellipse',
                    esc_html_x( "Triangle", 'backend', 'promosys' ) 	=> 'triangle',
                    esc_html_x( "Rounded", 'backend', 'promosys' ) 	    => 'rounded',
                ),
                "std"               => "rounded",
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Image Shape  -                                $image_shape
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
                "edit_field_class" 	=> "vc_col-xs-2",
            ), // Icon Size  -                                  $icon_size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Icon Margin', "backend", 'promosys' ),
                "param_name"		=> "icon_margin",
                "group"				=> esc_html_x( "Styling", "backend", 'promosys' ),
                "responsive"		=> "all",
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-2",
            ), // Icon Margin  -                                $icon_margin
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
                "value"				=> '#243238',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
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
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
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
                'heading'			=> esc_html_x( 'Shape front color type', 'backend', 'promosys' ),
                'param_name'		=> 'shape_front_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "icon_shape",
                    "value"	    => array("blot","round","triangle")
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front color type  -                     $shape_front_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Shape Front Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_color",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front Color  -                          $shape_front_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_start",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient start Color -            $shape_front_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient finish Color -           $shape_front_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient angle -                  $shape_front_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front custom gradient -                 $shape_front_gradient_custom
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Shape back color type', 'backend', 'promosys' ),
                'param_name'		=> 'shape_back_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "icon_shape",
                    "value"	    => array("blot","round","ellipse","triangle")
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back color type  -                      $shape_back_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Shape back Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_color",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '#FAF5FE',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back Color  -                           $shape_back_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_start",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient start Color -             $shape_back_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient finish Color -            $shape_back_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient angle -                   $shape_back_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back custom gradient -                  $shape_back_gradient_custom
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_icon_hover",
                "value"			    => array( esc_html_x( 'Change colors on Hover', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "dependency"		=> array(
                    "element"	=> "add_icon",
                    "not_empty"	=> true
                ),
            ), // Change colors on Hover -                      $add_icon_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Icon color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'icon_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	   => "add_icon_hover",
                    "not_empty"	   => true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon color type (hover)  -                    $icon_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Icon Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "icon_color_hover",
                "dependency"		=> array(
                    "element"	=> "icon_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '#243238',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon Color (hover)  -                         $icon_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "icon_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient start Color (hover) -           $icon_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "icon_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient finish Color (hover) -          $icon_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "icon_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon gradient angle (hover) -                 $icon_gradient_angle_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "icon_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "icon_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Icon custom gradient (hover) -                $icon_gradient_custom_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Shape front color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'shape_front_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	   => "add_icon_hover",
                    "not_empty"	   => true,
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front color type (hover)  -             $shape_front_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Shape Front Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_color_hover",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front Color (hover)  -                  $shape_front_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient start Color (hover) -    $shape_front_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient finish Color (hover) -   $shape_front_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front gradient angle (hover) -          $shape_front_gradient_angle_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "shape_front_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "shape_front_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape front custom gradient (hover) -         $shape_front_gradient_custom_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Shape back color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'shape_back_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	   => "add_icon_hover",
                    "not_empty"	   => true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back color type (hover)  -              $shape_back_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Shape back Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_color_hover",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '#FAF5FE',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back Color (hover)  -                   $shape_back_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient start Color (hover) -     $shape_back_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient finish Color (hover) -    $shape_back_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back gradient angle (hover) -           $shape_back_gradient_angle_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "shape_back_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "shape_back_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Shape back custom gradient (hover) -          $shape_back_gradient_custom_hover
            array(
                "type"			    => "separator",
                "param_name"	    => "icon_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Separator
            
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_title",
                "value"			    => array( esc_html_x( 'Show Title Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Title Settings -                         $add_title
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
                    esc_html_x( "Default - (H5)", 'backend', 'promosys' ) 	=> 'h5',
                    esc_html_x( "H1", 'backend', 'promosys' ) 				=> 'h1',
                    esc_html_x( "H2", 'backend', 'promosys' ) 				=> 'h2',
                    esc_html_x( "H3", 'backend', 'promosys' ) 				=> 'h3',
                    esc_html_x( "H4", 'backend', 'promosys' ) 				=> 'h4',
                    esc_html_x( "H5", 'backend', 'promosys' ) 				=> 'h5',
                    esc_html_x( "H6", 'backend', 'promosys' ) 				=> 'h6',
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title HTML Tag -                              $title_tag
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
                "param_name"		=> "title_size",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "value"				=> "20px",
                "responsive"		=> 'all',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title Size  -                                 $title_size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Line Height', 'backend', 'promosys' ),
                "param_name"		=> "title_line_height",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "value"				=> "29px",
                "responsive"		=> 'all',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title Line-Height -                           $title_line_height
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Margin Top', 'backend', 'promosys' ),
                "param_name"		=> "title_margin",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "value"				=> "23px",
                "responsive"		=> 'all',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title Margin Top -                            $title_margin
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
            ), // Title color type -                            $title_color_type
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
            ), // Title Color -                                 $title_color
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
            ), // Title gradient start Color -                  $title_gradient_start
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
            ), // Title gradient finish Color -                 $title_gradient_finish
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
            ), // Title gradient angle -                        $title_gradient_angle
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
            ), // Title custom gradient -                       $title_gradient_custom
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_title_hover",
                "value"			    => array( esc_html_x( 'Change colors on Hover', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
            ), // Change colors on Hover -                      $add_title_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Title color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'title_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_title_hover",
                    "not_empty"	=> true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title color type -                            $title_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Title Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "title_color_hover",
                "dependency"		=> array(
                    "element"	=> "title_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '#243238',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title Color on Hover -                        $title_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "title_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "title_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title gradient start Color on Hover -         $title_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "title_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "title_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title gradient finish Color on Hover -        $title_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "title_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "title_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title gradient angle on Hover -               $title_gradient_angle_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "title_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "title_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Title custom gradient on Hover -              $title_gradient_custom_hover
            array(
                "type"			    => "separator",
                "param_name"	    => "title_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Separator
            
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_divider",
                "value"			    => array( esc_html_x( 'Show Title Divider Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Title Divider Settings -                 $add_divider
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Divider Margin Top', 'backend', 'promosys' ),
                "param_name"		=> "divider_margin",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_divider",
                    "not_empty"	=> true
                ),
                "value"				=> "",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider Margin Top -                          $divider_margin
            array(
                "type"				=> "placeholder",
                "param_name"		=> "placeholder_3",
                "edit_field_class" 	=> "vc_col-xs-8",
                "dependency"		=> array(
                    "element"	=> "add_divider",
                    "not_empty"	=> true
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Divider color type', 'backend', 'promosys' ),
                'param_name'		=> 'divider_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom Gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_divider",
                    "not_empty"	=> true
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider color type -                          $divider_color_type
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
            ), // Divider Color -                               $divider_color
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
            ), // Divider gradient start Color -                $divider_gradient_start
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
            ), // Divider gradient finish Color -               $divider_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "divider_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "divider_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider custom gradient -                     $divider_gradient_custom
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_divider_hover",
                "value"			    => array( esc_html_x( 'Change colors on Hover', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "dependency"		=> array(
                    "element"	=> "add_divider",
                    "not_empty"	=> true
                ),
            ), // Change colors on Hover -                      $add_divider_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Divider color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'divider_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	    => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	    => 'gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_divider_hover",
                    "not_empty"	=> true
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider color type on Hover -                 $divider_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Divider Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "divider_color_hover",
                "dependency"		=> array(
                    "element"	=> "divider_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider Color on Hover -                      $divider_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Divider gradient start Color', 'backend', 'promosys' ),
                "param_name"		=> "divider_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "divider_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-3",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider gradient start Color on Hover -       $divider_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Divider gradient finish Color', 'backend', 'promosys' ),
                "param_name"		=> "divider_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "divider_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-3",
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider gradient finish Color on Hover -      $divider_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "divider_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "divider_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Divider custom gradient on Hover -            $divider_gradient_custom_hover
            array(
                "type"			    => "separator",
                "param_name"	    => "divider_separator",
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
            ), // Show Text Settings -                          $add_text
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
            ), // Text Size -                                   $text_size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text Line-Height', 'backend', 'promosys' ),
                "param_name"		=> "text_line_height",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
                "value"				=> "32px",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Line-Height -                            $text_line_height
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text Margin Top', 'backend', 'promosys' ),
                "param_name"		=> "text_margin",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
                "value"				=> "9px",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Margin Top -                             $text_margin
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Font Color', 'backend', 'promosys' ),
                "param_name"		=> "font_color",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
                "value"				=> "#3b545f",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Color -                                  $font_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Font Accent Color', 'backend', 'promosys' ),
                "param_name"		=> "font_accent_color",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Accent Color -                           $font_accent_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Text Accent Hover Color', 'backend', 'promosys' ),
                "param_name"		=> "font_accent_hover",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Accent Hover -                           $font_accent_hover
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_text_hover",
                "value"			    => array( esc_html_x( 'Change colors on Hover', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "dependency"		=> array(
                    "element"	=> "add_text",
                    "not_empty"	=> true
                ),
            ), // Change colors on Hover -                      $add_text_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Font Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "font_color_hover",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text_hover",
                    "not_empty"	=> true
                ),
                "value"				=> "#3b545f",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Color on Hover -                         $font_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Font Accent Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "font_accent_color_hover",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text_hover",
                    "not_empty"	=> true
                ),
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Accent Color on Hover -                  $font_accent_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Text Accent Hover Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "font_accent_hover_hover",
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_text_hover",
                    "not_empty"	=> true
                ),
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Text Accent Hover on Hover -                  $font_accent_hover_hover
            array(
                "type"			    => "separator",
                "param_name"	    => "text_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Separator
            
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_background",
                "value"			    => array( esc_html_x( 'Show Background Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Background Settings -                    $add_background
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'BG color type', 'backend', 'promosys' ),
                'param_name'		=> 'background_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_background",
                    "not_empty"	=> true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG color type -                               $background_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "background_color",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG Color -                                    $background_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_start",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient start Color -                     $background_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient finish Color -                    $background_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient angle -                           $background_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG custom gradient -                          $background_gradient_custom
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_background_hover",
                "value"			    => array( esc_html_x( 'Change colors on Hover', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "dependency"		=> array(
                    "element"	=> "add_background",
                    "not_empty"	=> true
                ),
            ), // Change colors on Hover -                      $add_background_hover
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'BG color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'background_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_background_hover",
                    "not_empty"	=> true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG color type on Hover -                      $background_color_type_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "background_color_hover",
                "dependency"		=> array(
                    "element"	=> "background_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> '',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG Color on Hover -                           $background_color_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "background_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient start Color on Hover -            $background_gradient_start_hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "background_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient finish Color on Hover -           $background_gradient_finish_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "background_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG gradient angle on Hover -                  $background_gradient_angle_hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "background_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // BG custom gradient on Hover -                 $background_gradient_custom_hover
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Hover Animation', 'backend', 'promosys' ),
                "param_name"		=> "hover",
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "value"				=> array(
                    esc_html_x( "None", 'backend', 'promosys' ) 		=> 'none',
                    esc_html_x( "Skew 3D", 'backend', 'promosys' ) 	    => 'skew',
                ),
                "dependency"		=> array(
                    "element"	=> "add_background",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // Hover Animation -                             $hover
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_shadow",
                "value"			    => array( esc_html_x( 'Show Shadow', 'backend', 'promosys' ) => true ),
                "dependency"		=> array(
                    "element"	=> "add_background",
                    "not_empty"	=> true
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Add shadow -                                  $add_shadow
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Shadow CSS', 'backend', 'promosys' ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-6",
                "param_name"		=> "shadow_css",
                "dependency"		=> array(
                    "element"	=> "add_shadow",
                    "not_empty"	=> true
                ),
                "value"				=> ""
            ), // Shadow CSS -                                  $shadow_css
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Shadow CSS on Hover', 'backend', 'promosys' ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-6",
                "param_name"		=> "shadow_css_hover",
                "dependency"		=> array(
                    "element"	=> "add_shadow",
                    "not_empty"	=> true
                ),
                "value"				=> ""
            ), // Shadow CSS on hover -                         $shadow_css_hover
            array(
                "type"			    => "separator",
                "param_name"	    => "background_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Separator
	        
            array(
                "type"			    => "checkbox",
                "param_name"	    => "customize_align",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "responsive"	=> "all",
                "dependency"	=> array(
                    "element"		=> "icon_img",
                    "value"			=> array( "icon", "image" )
                ),
                "value"			=> array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
            ), // Customize Alignment -                         $customize_align
            array(
                "type"			    => "dropdown",
                "heading"		    => esc_html_x( 'Text Alignment', 'backend', 'promosys' ),
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
            ), // Custom styles -                               $custom_styles
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
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Icon type', 'backend', 'promosys' ),
                "param_name"		=> "icon_img",
                "value"				=> array(
                    esc_html_x( "Icon", 'backend', 'promosys' ) 		=> 'icon',
                    esc_html_x( "Image", 'backend', 'promosys' ) 		=> 'image',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // Icon type -                                   $icon_img
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Icon Position', 'backend', 'promosys' ),
                "param_name"		=> "style",
                "value"				=> array(
                    esc_html_x( "Icon Top", 'backend', 'promosys' ) 		=> 'icon_top',
                    esc_html_x( "Icon Left", 'backend', 'promosys' ) 		=> 'icon_left',
                    esc_html_x( "Icon Right", 'backend', 'promosys' ) 	    => 'icon_right',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // Icon Position -                               $style
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Vertical Alignment', 'backend', 'promosys' ),
                "param_name"		=> "vertical_align",
                "dependency"		=> array(
                    "element"	=> "style",
                    "value"		=> array("icon_left", "icon_right")
                ),
                "value"				=> array(
                    esc_html_x( "Top", 'backend', 'promosys' ) 		=> 'flex-start',
                    esc_html_x( "Center", 'backend', 'promosys' ) 	=> 'center',
                    esc_html_x( "Bottom", 'backend', 'promosys' ) 	=> 'flex-end',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // Vertical Alignment -                          $vertical_align
            array(
                "type"				=> "placeholder",
                "param_name"		=> "placeholder_1",
                "dependency"		=> array(
                    "element"	=> "style",
                    "value"		=> array("icon_top"),
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
            ), // ------------------------------
        ),
        $icons, // Icon select
        array(
            array(
                "type"				=> "attach_image",
                "heading"			=> esc_html_x( 'Image', 'CWS_VC_Image', 'promosys' ),
                "param_name"		=> "image",
                "dependency"		=> array(
                    "element"	=> "icon_img",
                    "value"		=> 'image'
                ),
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // Image -                                       $image
            array(
                "type"				=> "textarea",
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "admin_label"		=> true,
                "param_name"		=> "title",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // Title -                                       $title
            array(
                "type"				=> "textarea_html",
                "heading"			=> esc_html_x( 'Text', 'backend', 'promosys' ),
                "param_name"		=> "content",
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // Text -                                        $content
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'URL', 'backend', 'promosys' ),
				"param_name"		=> "url",
				"value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-4",
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
		"name"				=> esc_html_x( 'CWS Service', 'backend', 'promosys' ),
		"base"				=> "cws_sc_service",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Service extends WPBakeryShortCode {
	    }
	}
?>