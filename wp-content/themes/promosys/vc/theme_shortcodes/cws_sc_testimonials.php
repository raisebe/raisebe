<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = cws_ext_merge_arrs( array(
		array(
            // Avatar Settings
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_avatar",
                "value"			    => array( esc_html_x( 'Show Avatar Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // ['add_avatar']                    Show Avatar Settings
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Avatar border color type', 'backend', 'promosys' ),
                'param_name'		=> 'avatar_bd_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "add_avatar",
                    "not_empty"	=> true
                ),
                "std"               => "custom_gradient",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['avatar_bd_color_type']          Avatar border color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "avatar_bd_color",
                "dependency"		=> array(
                    "element"	=> "avatar_bd_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['avatar_bd_color']               Avatar border Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "avatar_bd_gradient_start",
                "dependency"		=> array(
                    "element"	=> "avatar_bd_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['avatar_bd_gradient_start']      Avatar border gradient start Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "avatar_bd_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "avatar_bd_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['avatar_bd_gradient_finish']     Avatar border gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "avatar_bd_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "avatar_bd_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "-18",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['avatar_bd_gradient_angle']      Avatar border gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "avatar_bd_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "avatar_bd_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "value"				=> "background-image: linear-gradient(108deg, #FCB04E 0%, #E95647 65%, #C82A86 80%);",
            ), // ['avatar_bd_gradient_custom']     Avatar border custom gradient
            array(
                "type"			    => "separator",
                "param_name"	    => "avatar_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Position Settings
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_position",
                "value"			    => array( esc_html_x( 'Show Position Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "responsive"	    => "all",
            ), // ['add_position']                  Show Position Settings
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Font size', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "pos_font_size",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_position",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "14px",
            ), // ['pos_font_size']                 Position Font size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Margin Bottom', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "pos_margin_bottom",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_position",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "7px",
            ), // ['pos_margin_bottom']             Position margin bottom
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Position color', 'backend', 'promosys' ),
                "param_name"		=> "pos_color",
                "dependency"	    => array(
                    "element"		=> "add_position",
                    "not_empty"		=> true
                ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "#9B9B9B",
            ), // ['pos_color']                     Position color
            array(
                "type"			    => "separator",
                "param_name"	    => "position_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Name Settings
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_name",
                "value"			    => array( esc_html_x( 'Show Name Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "responsive"	    => "all",
            ), // ['add_name']                      Show Name Settings
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Font size', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "name_font_size",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_name",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "25px",
            ), // ['name_font_size']                Name Font size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Margin Bottom', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "name_margin_bottom",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_name",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "11px",
            ), // ['name_margin_bottom']            Name margin bottom
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Name color', 'backend', 'promosys' ),
                "param_name"		=> "name_color",
                "dependency"	    => array(
                    "element"		=> "add_name",
                    "not_empty"		=> true
                ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "#243238",
            ), // ['name_color']                    Name color
            array(
                "type"			    => "separator",
                "param_name"	    => "name_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Text Settings
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_text",
                "value"			    => array( esc_html_x( 'Show Text Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "responsive"	    => "all",
            ), // ['add_text']                      Show Text Settings
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Font size', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "text_font_size",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_text",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "18px",
            ), // ['text_font_size']                Text Font size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text Line Height', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "text_lh",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_text",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "35px",
            ), // ['text_lh']                       Text line height
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Text color', 'backend', 'promosys' ),
                "param_name"		=> "text_color",
                "dependency"	    => array(
                    "element"		=> "add_text",
                    "not_empty"		=> true
                ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "",
            ), // ['text_color']                    Text color
            array(
                "type"			    => "separator",
                "param_name"	    => "text_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Background Settings
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_background",
                "value"			    => array( esc_html_x( 'Show Background Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "std"               => "1",
            ), // ['add_background']                Show Background Settings
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Background color type', 'backend', 'promosys' ),
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
                "std"               => "custom_gradient",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['background_color_type']          Background color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "background_color",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['background_color']               Background Color
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
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['background_gradient_start']      Background gradient start Color
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
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['background_gradient_finish']     Background gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "-18",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['background_gradient_angle']      Background gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "background_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "background_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "value"				=> "background-image: linear-gradient(174.86deg, #FFFFFF 7.72%, #FAEFFF 145.46%);",
            ), // ['background_gradient_custom']     Background custom gradient
            array(
                "type"			    => "separator",
                "param_name"	    => "text_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Custom Styles
            array(
                "type"			=> "css_editor",
                "param_name"	=> "custom_styles",
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "responsive"	=> 'all'
            ), // ['custom_styles']                 Custom styles
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
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Columns', 'backend', 'promosys' ),
				"param_name"		=> "columns",
                "edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> array(
					esc_html_x( 'One', 'backend', 'promosys' )		=> '1',
					esc_html_x( 'Two', 'backend', 'promosys' )		=> '2',
					esc_html_x( 'Three', 'backend', 'promosys' )	=> '3',
					esc_html_x( 'Four', 'backend', 'promosys' )		=> '4',
				)
			), // ['columns']                       Columns
            
            // Carousel Settings
			array(
				"type"				=> "checkbox",
				"param_name"		=> "carousel",
				"value"				=> array( esc_html_x( 'Carousel', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			), // ['carousel']                      Add carousel
			array(
				"type"				=> "checkbox",
				"param_name"		=> "autoplay",
                "edit_field_class" 	=> "cws-checkbox cws-inline vc_col-xs-4",
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> array( esc_html_x( 'Autoplay', 'backend', 'promosys' ) => true ),
			), // ['autoplay']                      Autoplay
            array(
                "type"				=> "placeholder",
                "param_name"		=> "placeholder",
                "edit_field_class" 	=> "vc_col-xs-8",
                "dependency"		=> array(
                    "element"	=> "autoplay",
                    "is_empty"	=> true
                ),
            ), //                                   Placeholder
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Autoplay Speed', 'backend', 'promosys' ),
                "param_name"		=> "autoplay_speed",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "autoplay",
                    "not_empty"	=> true
                ),
                "value"				=> "3000"
            ), // ['autoplay_speed']                Autoplay Speed
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Slides to Scroll', 'backend', 'promosys' ),
				"param_name"		=> "slides_to_scroll",
				"edit_field_class" 	=> "vc_col-xs-4",
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> array(
					esc_html_x( 'One', 'backend', 'promosys' )		=> '1',
					esc_html_x( 'Two', 'backend', 'promosys' )		=> '2',
					esc_html_x( 'Three', 'backend', 'promosys' )	=> '3',
					esc_html_x( 'Four', 'backend', 'promosys' )		=> '4',
				)
			), // ['slides_to_scroll']              Slides to Scroll
            
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Dot Pointer Color', 'backend', 'promosys' ),
                "param_name"		=> "pointer_color",
                "dependency"	    => array(
                    "element"		=> "carousel",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "#F4475C",
            ), // ['pointer_color']                 Dot Pointer Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Inactive Dots Color', 'backend', 'promosys' ),
                "param_name"		=> "dots_color",
                "dependency"	    => array(
                    "element"		=> "carousel",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-6",
                "value"				=> "#f2f2f2",
            ), // ['dots_color']                    Inactive Dots Color
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Active dots color type', 'backend', 'promosys' ),
                'param_name'		=> 'active_dots_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "carousel",
                    "not_empty"	=> true
                ),
                "std"               => "custom_gradient",
            ), // ['active_dots_color_type']        Active dots color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "active_dots_color",
                "dependency"		=> array(
                    "element"	=> "active_dots_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
            ), // ['active_dots_color']             Active dots Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "active_dots_gradient_start",
                "dependency"		=> array(
                    "element"	=> "active_dots_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
            ), // ['active_dots_gradient_start']    Active dots gradient start Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "active_dots_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "active_dots_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
            ), // ['active_dots_gradient_finish']   Active dots gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "active_dots_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "active_dots_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "90",
            ), // ['active_dots_gradient_angle']    Active dots gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "active_dots_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "active_dots_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(105.13deg, #FEDA75 -53.56%, #FA7E1E 35.31%, #D62976 76.67%, #962FBF 141.02%, #4F5BD5 188.52%);",
            ), // ['active_dots_gradient_custom']   Active dots custom gradient
            
            // Testimonial items
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Testimonials', 'backend', 'promosys' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
                	array(
						"type"				=> "attach_image",
						"heading"			=> esc_html_x( 'Image', 'CWS_VC_Image', 'promosys' ),
						"param_name"		=> "image",
					), // values['image']                   Image
                	array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Name', 'backend', 'promosys' ),
						"param_name"		=> "name",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					), // values['name']                    Name
                    array(
                        "type"				=> "textfield",
                        "admin_label"		=> true,
                        "heading"			=> esc_html_x( 'Position', 'backend', 'promosys' ),
                        "param_name"		=> "position",
                        "edit_field_class" 	=> "vc_col-xs-6",
                        "value"				=> ""
                    ), // values['position']                Position
					array(
						"type"				=> "textarea",
						"heading"			=> esc_html_x( 'Content', 'backend', 'promosys' ),
						"param_name"		=> "description",
						"value"				=> ""
					), // values['description']             Content
                ),
                "value"			=> "",
            ), // ['values']                        Testimonials
            
            // Extra classes
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			), // ['el_class']                      Extra classes
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
		"name"				=> esc_html_x( 'CWS Testimonials', 'backend', 'promosys' ),
		"base"				=> "cws_sc_testimonials",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Testimonials extends WPBakeryShortCode {
	    }
	}
?>