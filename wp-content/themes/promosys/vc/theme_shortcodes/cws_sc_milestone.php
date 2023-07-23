<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_counter",
                "value"			    => array( esc_html_x( 'Show Counter Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // Show Counter Settings -                       $add_counter
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Counter Size', 'backend', 'promosys' ),
                "param_name"		=> "counter_size",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "add_counter",
                    "not_empty"	=> true
                ),
                "value"				=> "50px",
                "responsive"		=> 'all',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter Size  -                               $counter_size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Counter Line Height', 'backend', 'promosys' ),
                "param_name"		=> "counter_line_height",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "add_counter",
                    "not_empty"	=> true
                ),
                "value"				=> "65px",
                "responsive"		=> 'all',
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter Line-Height -                         $counter_line_height
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Counter color type', 'backend', 'promosys' ),
                'param_name'		=> 'counter_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_counter",
                    "not_empty"	=> true
                ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter color type -                          $counter_color_type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Counter Color', 'backend', 'promosys' ),
                "param_name"		=> "counter_color",
                "dependency"		=> array(
                    "element"	=> "counter_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter Color -                               $counter_color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "counter_gradient_start",
                "dependency"		=> array(
                    "element"	=> "counter_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter gradient start Color -                $counter_gradient_start
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "counter_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "counter_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter gradient finish Color -               $counter_gradient_finish
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "counter_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "counter_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter gradient angle -                      $counter_gradient_angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "counter_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "counter_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // Counter custom gradient -                     $counter_gradient_custom
            array(
                "type"			    => "separator",
                "param_name"	    => "counter_separator",
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
                    esc_html_x( "DIV", 'backend', 'promosys' ) 				=> 'div',
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
                "value"				=> "18px",
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
                "value"				=> "24px",
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
                "value"				=> "5px",
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
                "type"			    => "separator",
                "param_name"	    => "title_separator",
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
                "value"				=> "14px",
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
                "value"				=> "25px",
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
                "value"				=> "12px",
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
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Count', 'backend', 'promosys' ),
                "param_name"		=> "count",
                "value"				=> "50",
                "edit_field_class" 	=> "vc_col-xs-6",
            ), // Count -                                       $count
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Extra Symbol', 'backend', 'promosys' ),
                "param_name"		=> "symbol",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-6",
            ), // Extra Symbol -                                $symbol
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
		"name"				=> esc_html_x( 'CWS Milestone', 'backend', 'promosys' ),
		"base"				=> "cws_sc_milestone",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Milestone extends WPBakeryShortCode {
	    }
	}
?>