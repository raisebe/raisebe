<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$background_properties = cws_module_background_props();

	$styles = cws_ext_merge_arrs( array(
		array(
            // Title Options
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_title",
                "value"			    => array( esc_html_x( 'Show Title Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // ['add_title']                     Show title settings
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "title_size",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> "25px",
            ), // ['title_size']                    Title size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Line Height', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "title_lh",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "38px",
            ), // ['title_lh']                      Title line height
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title Margin Bottom', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "title_margin_bottom",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "2px",
            ), // ['title_margin_bottom']           Title margin bottom
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Title color', 'backend', 'promosys' ),
                "param_name"		=> "title_color",
                "dependency"		=> array(
                    "element"	=> "add_title",
                    "not_empty"	=> true
                ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "",
            ), // ['title_color']                   Title color
            array(
                "type"			    => "separator",
                "param_name"	    => "title_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Description Options
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_description",
                "value"			    => array( esc_html_x( 'Show Description Settings', 'backend', 'promosys' ) => true ),
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // ['add_description']               Show Description Settings
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text size', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "text_size",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_description",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> "14px",
            ), // ['text_size']                     Text size
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text Line Height', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "text_lh",
                "responsive"	    => "all",
                "dependency"	    => array(
                    "element"		=> "add_description",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "18px",
            ), // ['text_lh']                       Text line height
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Text Margin Bottom', 'backend', 'promosys' ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"		=> "text_margin_bottom",
                "responsive"	    => "all",
                "dependency"		=> array(
                    "element"	=> "add_description",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "",
            ), // ['text_margin_bottom']            Text margin bottom
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Text color', 'backend', 'promosys' ),
                "param_name"		=> "text_color",
                "dependency"	    => array(
                    "element"		=> "add_description",
                    "not_empty"		=> true
                ),
                "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> "",
            ), // ['text_color']                    Text color
            array(
                "type"			    => "separator",
                "param_name"	    => "description_separator",
                "responsive"	    => 'all',
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Overlay Options
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_overlay",
                "value"			    => array( esc_html_x( 'Show Overlay Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ), // ['add_overlay']                   Show Overlay Settings
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
                    "element"	=> "add_overlay",
                    "not_empty"	=> true
                ),
                "std"               => "simple",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['overlay_color_type']            Overlay color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "overlay_bg_color",
                "dependency"		=> array(
                    "element"	=> "overlay_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['overlay_bg_color']              Overlay Color
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
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['overlay_gradient_start']        Overlay gradient start Color
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
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['overlay_gradient_finish']       Overlay gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "overlay_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "overlay_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "90",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ['overlay_gradient_angle']        Overlay gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "overlay_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "overlay_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "value"				=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
            ), // ['overlay_gradient_custom']       Overlay custom gradient
            array(
                "type"			    => "separator",
                "param_name"	    => "overlay_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Button Options
            array(
                "type"			    => "checkbox",
                "param_name"	    => "add_button",
                "value"			    => array( esc_html_x( 'Show Button Settings', 'backend', 'promosys' ) => true ),
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "description"       => esc_html_x( "In new tab", 'backend', 'promosys' ),
            ), // ['add_button']                    Add button
            array(
                "type"			    => "separator",
                "param_name"	    => "button_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            ), // ------------------------------
            
            // Minimum height
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Minimal module height', 'backend', 'promosys' ),
                "param_name"		=> "min_height",
                "responsive"	    => "all",
                "edit_field_class" 	=> "vc_col-xs-6",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "value"				=> "",
            ), // ['min_height']                    Module min-height
            array(
                "type"			    => "separator",
                "param_name"	    => "height_separator",
                "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
                "responsive"	    => "all",
            ), // ------------------------------
			
            // Custom Styles
			array(
				"type"			=> "css_editor",
				"param_name"	=> "custom_styles",
				"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
				"responsive"	=> 'all'
			) // ['custom_styles']                  Custom styles
		),
		$background_properties,
		array(
		    // Align Options
			array(
				"type"			    => "checkbox",
				"param_name"	    => "customize_align",
				"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
				"responsive"	    => "all",
				"value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			), // ['customize_align']               Customize align
			array(
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Text Alignment', 'backend', 'promosys' ),
				"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
				"param_name"	=> "module_alignment",
				"responsive"	=> "all",
				"dependency"	=> array(
					"element"		=> "customize_align",
					"not_empty"		=> true
				),
                "edit_field_class" 	=> "vc_col-xs-6",
				"value"			=> array(
					esc_html_x( "Left", 'backend', 'promosys' ) 	=> 'left',
					esc_html_x( "Center", 'backend', 'promosys' )   => 'center',
					esc_html_x( "Right", 'backend', 'promosys' ) 	=> 'right',
				),
			), // ['module_alignment']              Alignment
            array(
                "type"			=> "dropdown",
                "heading"		=> esc_html_x( 'Title Vertical Alignment', 'backend', 'promosys' ),
                "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
                "param_name"	=> "title_vertical",
                "dependency"	=> array(
                    "element"		=> "customize_align",
                    "not_empty"		=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-6",
                "value"			=> array(
                    esc_html_x( "Top", 'backend', 'promosys' ) 	    => 'top',
                    esc_html_x( "Middle", 'backend', 'promosys' )   => 'middle',
                    esc_html_x( "Bottom", 'backend', 'promosys' ) 	=> 'bottom',
                ),
            ), // ['title_vertical']                Vertical alignment
		)
	));

	/* -----> BUTTON TABS PROPERTIES <----- */
    $icons = cws_ext_icon_vc_sc_config_params('btn_add_icon', true, false, 'button');
    
    $button = cws_ext_merge_arrs( array(
        /* -----> BUTTON TAB <----- */
        array(
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "param_name"		=> "btn_title",
                "value"				=> "Click Me!",
                "edit_field_class" 	=> "vc_col-xs-6",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_title']                     Button title
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Button Position', 'backend', 'promosys' ),
                "param_name"		=> "button_pos",
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> array(
                    esc_html_x( 'Default', 'backend', 'promosys' )		=> 'default',
                    esc_html_x( 'Floated', 'backend', 'promosys' )		=> 'floated',
                ),
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['button_pos']                    Button position
            array(
                "type"			    => "separator",
                "param_name"	    => "btn_title_separator",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ------------------------------
        
            array(
                "type"			    => "dropdown",
                "heading"		    => esc_html_x( 'Button Style', 'backend', 'promosys' ),
                "param_name"	    => "btn_style",
                "value"			    => array(
                    esc_html_x( 'Arrow Fade In', 'backend', 'promosys' )		=> 'arrow_fade_in',
                    esc_html_x( 'Arrow Fade Out', 'backend', 'promosys' )		=> 'arrow_fade_out',
                    esc_html_x( 'Simple', 'backend', 'promosys' )				=> 'simple',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_style']                     Button style
            array(
                "type"			    => "dropdown",
                "heading"		    => esc_html_x( 'Button Size', 'backend', 'promosys' ),
                "param_name"	    => "btn_size",
                "value"			    => array(
                    esc_html_x( 'Large', 'backend', 'promosys' )		=> 'large',
                    esc_html_x( 'Medium', 'backend', 'promosys' )		=> 'medium',
                    esc_html_x( 'Small', 'backend', 'promosys' )		=> 'small',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "std"               => "medium",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_size']                      Button size
            array(
                "type"				=> "checkbox",
                "param_name"		=> "btn_add_shadow",
                "value"				=> array( esc_html_x( 'Add shadow', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox cws-inline vc_col-xs-4",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_add_shadow']                Add shadow
            array(
                "type"			    => "separator",
                "param_name"	    => "btn_settings_separator",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ------------------------------
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "btn_set_bg",
                "value"				=> array( esc_html_x( 'Set background color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_set_bg']                    Set BG color
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Background color type', 'backend', 'promosys' ),
                'param_name'		=> 'btn_bg_color_type',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "btn_set_bg",
                    "not_empty"	=> true
                ),
                "std"               => "simple",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_color_type']             BG color type
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_color",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> "rgba(255, 255, 255, 0.01)",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_color']                  BG Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_start",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_start']         BG gradient start Color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_finish",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_finish']        BG gradient finish Color
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_angle",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "90",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_angle']         BG gradient angle
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_custom",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type",
                    "value"	    => array("custom_gradient"),
                ),
                "value"				=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_custom']        BG custom gradient
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Background color type on Hover', 'backend', 'promosys' ),
                'param_name'		=> 'btn_bg_color_type_hover',
                "value"				=> array(
                    esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                    esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                    esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
                ),
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "btn_set_bg",
                    "not_empty"	=> true
                ),
                "std"               => "simple",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_color_type_hover']       BG color type on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_color_hover",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type_hover",
                    "value"	    => array("simple"),
                ),
                "edit_field_class" 	=> "vc_col-xs-8",
                "value"				=> "#ffffff",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_color_hover']            BG Color on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_start_hover",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> PRIMARY_COLOR,
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_start_hover']   BG gradient start Color on Hover
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_finish_hover",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "value"				=> SECONDARY_COLOR,
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_finish_hover']  BG gradient finish Color on Hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_angle_hover",
                "edit_field_class" 	=> "vc_col-xs-2",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type_hover",
                    "value"	    => array("gradient"),
                ),
                "value"				=> "154",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_bg_gradient_angle_hover']   BG gradient angle on Hover
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
                "param_name"		=> "btn_bg_gradient_custom_hover",
                "edit_field_class" 	=> "vc_col-xs-6",
                "dependency"		=> array(
                    "element"	=> "btn_bg_color_type_hover",
                    "value"	    => array("custom_gradient"),
                ),
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "value"				=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
            ), // ['btn_bg_gradient_custom_hover']  BG custom gradient on Hover
            array(
                "type"			    => "separator",
                "param_name"	    => "btn_background_separator",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ------------------------------
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "btn_set_color",
                "value"				=> array( esc_html_x( 'Set title color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_set_color']                 Set title color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_font_color",
                "value"				=> '#ffffff',
                "dependency"		=> array(
                    "element"	=> "btn_set_color",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_font_color']                Button title color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "btn_font_color_hover",
                "value"				=> '#000000',
                "dependency"		=> array(
                    "element"	=> "btn_set_color",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_font_color_hover']          Button title color on hover
            array(
                "type"			    => "separator",
                "param_name"	    => "btn_color_separator",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ------------------------------
            
            array(
                "type"				=> "checkbox",
                "param_name"		=> "btn_set_border",
                "value"				=> array( esc_html_x( 'Set border color', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_set_border']                Set border color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color', 'backend', 'promosys' ),
                "param_name"		=> "btn_border_color",
                "value"				=> '#ffffff',
                "dependency"		=> array(
                    "element"	=> "btn_set_border",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_border_color']              Button border color
            array(
                "type"				=> "colorpicker",
                "heading"			=> esc_html_x( 'Color on Hover', 'backend', 'promosys' ),
                "param_name"		=> "btn_border_color_hover",
                "value"				=> '#ffffff',
                "dependency"		=> array(
                    "element"	=> "btn_set_border",
                    "not_empty"	=> true
                ),
                "edit_field_class" 	=> "vc_col-xs-2",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
            ), // ['btn_border_color_hover']        Button border color on hover
            array(
                "type"			    => "separator",
                "param_name"	    => "btn_border_separator",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ------------------------------
            
            array(
                "type"			    => "checkbox",
                "param_name"	    => "btn_add_icon",
                "value"			    => array( esc_html_x( 'Add Icon to button', 'backend', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_add_icon'] Add icon to button
        ),
        $icons
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
                "type"				=> "textarea",
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "admin_label"		=> true,
                "param_name"		=> "title",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // ['title']                         Title
            array(
                "type"				=> "textarea",
                "heading"			=> esc_html_x( 'Description', 'backend', 'promosys' ),
                "param_name"		=> "description",
                "value"				=> "",
                "edit_field_class" 	=> "vc_col-xs-12",
            ), // ['description']                   Description
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Banner Url', 'backend', 'promosys' ),
				"param_name"		=> "banner_url",
				"edit_field_class" 	=> "vc_col-xs-9",
				"value"				=> "#"
			), // ['banner_url']                    URL
			array(
				"type"				=> "checkbox",
				"param_name"		=> "new_tab",
                "edit_field_class" 	=> "cws-checkbox cws-inline vc_col-xs-3",
				"value"				=> array( esc_html_x( 'Open Link in New Tab', 'backend', 'promosys' ) => true ),
			), // ['new_tab']                       Link target
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
		$styles_mobile,
        /* -----> BUTTON TAB <----- */
        $button
	));

	/* -----> MODULE DECLARATION <----- */
	vc_map( array(
		"name"				=> esc_html_x( 'CWS Banner', 'backend', 'promosys' ),
		"base"				=> "cws_sc_banners",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Banners extends WPBakeryShortCode {
	    }
	}
?>