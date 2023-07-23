<?php

    /* -----> STYLING TAB PROPERTIES <----- */
    $styles = array(
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_title",
            "value"			    => array( esc_html_x( 'Show Title Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Title Settings -                         $add_title
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
            "param_name"		=> "title_size",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "25px",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Size  -                                 $title_size
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Line Height', 'backend', 'promosys' ),
            "param_name"		=> "title_line_height",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "38px",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Line-Height -                           $title_line_height
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Title Margin Top', 'backend', 'promosys' ),
            "param_name"		=> "title_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "value"				=> "20px",
            "responsive"		=> 'all',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Margin Top -                            $title_margin
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
            "param_name"		=> "title_color",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> '#243238',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Color -                                 $title_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Title Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "title_color_hover",
            "dependency"		=> array(
                "element"	=> "add_title",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Title Color on Hover -                        $title_color_hover
        array(
            "type"			    => "separator",
            "param_name"	    => "title_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_tags",
            "value"			    => array( esc_html_x( 'Show Tags Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Tags Settings -                          $add_tags
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Tags text Color', 'backend', 'promosys' ),
            "param_name"		=> "tags_text_color",
            "dependency"		=> array(
                "element"	=> "add_tags",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> '#3b545f',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Tags text Color -                             $tags_text_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Tags text Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "tags_text_color_hover",
            "dependency"		=> array(
                "element"	=> "add_tags",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> '#ffffff',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Tags text Color on Hover -                    $tags_text_color_hover
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Tags background Color', 'backend', 'promosys' ),
            "param_name"		=> "tags_bg_color",
            "dependency"		=> array(
                "element"	=> "add_tags",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> 'rgba(242, 242, 242, 0.7)',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Tags background Color -                       $tags_bg_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Tags background Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "tags_bg_color_hover",
            "dependency"		=> array(
                "element"	=> "add_tags",
                "not_empty"	=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Tags background Color on Hover -              $tags_bg_color_hover
        array(
            "type"			    => "separator",
            "param_name"	    => "tags_separator",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_divider",
            "value"			    => array( esc_html_x( 'Show Divider Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Divider Settings -                       $add_divider
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Divider Margin Top', 'backend', 'promosys' ),
            "param_name"		=> "divider_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_divider",
                "not_empty"	=> true
            ),
            "value"				=> "10px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Divider Margin Top -                          $divider_margin
        array(
            "type"				=> "placeholder",
            "param_name"		=> "placeholder_1",
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
            "std"               => "custom_gradient",
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
            "type"			    => "separator",
            "param_name"	    => "divider_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_text",
            "value"			    => array( esc_html_x( 'Show Excerpt Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Excerpt Settings -                       $add_text
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
            "type"			    => "separator",
            "param_name"	    => "text_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_categories",
            "value"			    => array( esc_html_x( 'Show Categories Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Categories Settings -                    $add_categories
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Text Size', 'backend', 'promosys' ),
            "param_name"		=> "categories_size",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_categories",
                "not_empty"	=> true
            ),
            "value"				=> "16px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Categories Size -                             $categories_size
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Text Line-Height', 'backend', 'promosys' ),
            "param_name"		=> "categories_line_height",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_categories",
                "not_empty"	=> true
            ),
            "value"				=> "32px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Categories Line-Height -                      $categories_line_height
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Text Margin Top', 'backend', 'promosys' ),
            "param_name"		=> "categories_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_categories",
                "not_empty"	=> true
            ),
            "value"				=> "9px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Categories Margin Top -                       $categories_margin
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Categories Color', 'backend', 'promosys' ),
            "param_name"		=> "categories_color",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_categories",
                "not_empty"	=> true
            ),
            "value"				=> "#3b545f",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Categories Color -                            $categories_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Categories Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "categories_color_hover",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_categories",
                "not_empty"	=> true
            ),
            "value"				=> PRIMARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Categories Hover Color -                      $categories_color_hover
        array(
            "type"			    => "separator",
            "param_name"	    => "categories_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_meta",
            "value"			    => array( esc_html_x( 'Show Meta Settings', 'backend', 'promosys' ) => true ),
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Meta Settings -                          $add_meta
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Meta Margin Top', 'backend', 'promosys' ),
            "param_name"		=> "meta_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_meta",
                "not_empty"	=> true
            ),
            "value"				=> "38px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Meta Margin Top -                             $meta_margin
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Meta Border Color', 'backend', 'promosys' ),
            "param_name"		=> "meta_border_color",
            "edit_field_class" 	=> "vc_col-xs-8",
            "dependency"		=> array(
                "element"	=> "add_meta",
                "not_empty"	=> true
            ),
            "value"				=> "#fdeff9",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Meta Border Color -                           $meta_border_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Meta Text Color', 'backend', 'promosys' ),
            "param_name"		=> "meta_text_color",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_meta",
                "not_empty"	=> true
            ),
            "value"				=> "#3b545f",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Meta Text Color -                             $meta_text_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Meta Accent Color', 'backend', 'promosys' ),
            "param_name"		=> "meta_accent_color",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_meta",
                "not_empty"	=> true
            ),
            "value"				=> SECONDARY_COLOR,
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Meta Accent Hover -                           $meta_accent_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Meta Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "meta_text_color_hover",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_meta",
                "not_empty"	=> true
            ),
            "value"				=> "#3b545f",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Meta Text Hover -                             $meta_text_color_hover
        array(
            "type"			    => "separator",
            "param_name"	    => "meta_separator",
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
            "value"				=> '#ffffff',
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
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Border active color type', 'backend', 'promosys' ),
            'param_name'		=> 'border_color_type',
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
        ), // Border color type -                           $border_color_type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Border active Color', 'backend', 'promosys' ),
            "param_name"		=> "border_color",
            "dependency"		=> array(
                "element"	=> "border_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> '#f2f2f2',
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border Color -                                $border_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "border_gradient_start",
            "dependency"		=> array(
                "element"	=> "border_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> "#f2f2f2",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border gradient start Color -                 $border_gradient_start
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "border_gradient_finish",
            "dependency"		=> array(
                "element"	=> "border_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> "#f2f2f2",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border gradient finish Color -                $border_gradient_finish
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "param_name"		=> "border_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "border_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "90",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border gradient angle -                       $border_gradient_angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "border_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "border_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(90deg, #f2f2f2 -8.57%, #f2f2f2 184.64%);",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border custom gradient -                      $border_gradient_custom
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Border active color type', 'backend', 'promosys' ),
            'param_name'		=> 'border_active_color_type',
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
            "std"           => "custom_gradient",
        ), // Border active  color type -                   $border_active_color_type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Border active Color', 'backend', 'promosys' ),
            "param_name"		=> "border_active_color",
            "dependency"		=> array(
                "element"	=> "border_active_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border active Color -                         $border_active_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "param_name"		=> "border_active_gradient_start",
            "dependency"		=> array(
                "element"	=> "border_active_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> PRIMARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border active gradient start Color -          $border_active_gradient_start
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "param_name"		=> "border_active_gradient_finish",
            "dependency"		=> array(
                "element"	=> "border_active_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> SECONDARY_COLOR,
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border active gradient finish Color -         $border_active_gradient_finish
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "param_name"		=> "border_active_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "border_active_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "90",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border active gradient angle -                $border_active_gradient_angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "param_name"		=> "border_active_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "border_active_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(90deg, #f76331 -8.57%, #c01fb8 184.64%);",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Border active custom gradient -               $border_active_gradient_custom
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
            "std"               => "1",
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
            "value"				=> "20px 15px 25px rgba(80, 94, 100, 0.04)"
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
            "param_name"	    => "add_slider",
            "value"			    => array( esc_html_x( 'Show Slider Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
        ), // Show Slider Settings -                        $add_slider
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Inactive Dots Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "dots_color",
            "dependency"	    => array(
                "element"		=> "add_slider",
                "not_empty"		=> true
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#f2f2f2",
        ), // Inactive Dots Color -                         $dots_color
        array(
            "type"				=> "placeholder",
            "param_name"		=> "placeholder_4",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true
            ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Placeholder
        array(
            'type'				=> 'dropdown',
            'heading'			=> esc_html_x( 'Active dots color type', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            'param_name'		=> 'active_dots_color_type',
            "value"				=> array(
                esc_html_x( 'Simple', 'backend', 'promosys' )	        => 'simple',
                esc_html_x( 'Gradient', 'backend', 'promosys' )	        => 'gradient',
                esc_html_x( 'Custom gradient', 'backend', 'promosys' )	=> 'custom_gradient',
            ),
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true
            ),
            "std"               => "custom_gradient",
        ), // Active dots color type -                      $active_dots_color_type
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'BG Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "active_dots_color",
            "dependency"		=> array(
                "element"	=> "active_dots_color_type",
                "value"	    => array("simple"),
            ),
            "edit_field_class" 	=> "vc_col-xs-8",
            "value"				=> PRIMARY_COLOR,
        ), // Active dots Color -                           $active_dots_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Start Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "active_dots_gradient_start",
            "dependency"		=> array(
                "element"	=> "active_dots_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> PRIMARY_COLOR,
        ), // Active dots gradient start Color -            $active_dots_gradient_start
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Finish Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "active_dots_gradient_finish",
            "dependency"		=> array(
                "element"	=> "active_dots_color_type",
                "value"	    => array("gradient"),
            ),
            "edit_field_class" 	=> "vc_col-xs-2",
            "value"				=> SECONDARY_COLOR,
        ), // Active dots gradient finish Color -           $active_dots_gradient_finish
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Angle', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "active_dots_gradient_angle",
            "edit_field_class" 	=> "vc_col-xs-2",
            "dependency"		=> array(
                "element"	=> "active_dots_color_type",
                "value"	    => array("gradient"),
            ),
            "value"				=> "90",
        ), // Active dots gradient angle -                  $active_dots_gradient_angle
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Custom gradient', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "active_dots_gradient_custom",
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	=> "active_dots_color_type",
                "value"	    => array("custom_gradient"),
            ),
            "value"				=> "background-image: linear-gradient(105.13deg, #FEDA75 -53.56%, #FA7E1E 35.31%, #D62976 76.67%, #962FBF 141.02%, #4F5BD5 188.52%);",
        ), // Active dots custom gradient -                 $active_dots_gradient_custom
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Arrow Color', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "arrow_color",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true,
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#ffffff",
        ), // Arrow Color -                                 $arrow_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Arrow Background', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "arrow_bg_color",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true,
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "rgba(255, 255, 255, 0.4)",
        ), // Arrow BG Color -                              $arrow_bg_color
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Arrow Color on Hover', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "arrow_color_hover",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true,
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> SECONDARY_COLOR,
        ), // Arrow Color on Hover -                        $arrow_color_hover
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Arrow Background on Hover', 'backend', 'promosys' ),
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "param_name"		=> "arrow_bg_color_hover",
            "dependency"		=> array(
                "element"	=> "add_slider",
                "not_empty"	=> true,
            ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#ffffff",
        ), // Arrow BG Color on Hover -                     $arrow_bg_color_hover
        array(
            "type"			    => "separator",
            "param_name"	    => "slider_separator",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			    => "checkbox",
            "param_name"	    => "add_button",
            "value"			    => array( esc_html_x( 'Show Button Settings', 'backend', 'promosys' ) => true ),
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            "responsive"	    => 'all',
            "description"       => esc_html_x( "In new tab", 'backend', 'promosys' ),
        ), // Show Button Settings -                        $add_button
        array(
            "type"				=> "textfield",
            "heading"			=> esc_html_x( 'Meta Margin Top', 'backend', 'promosys' ),
            "param_name"		=> "button_margin",
            "edit_field_class" 	=> "vc_col-xs-4",
            "dependency"		=> array(
                "element"	=> "add_button",
                "not_empty"	=> true
            ),
            "value"				=> "30px",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Button Margin Top -                           $button_margin
        array(
            "type"			    => "separator",
            "param_name"	    => "button_separator",
            "responsive"	    => 'all',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
        ), // Separator
        
        array(
            "type"			=> "css_editor",
            "param_name"	=> "custom_styles",
            "group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "responsive"	=> "all"
        ), // Custom styles
    );
    
    /* -----> GET TAXONOMIES <----- */
    $post_type = "post";
    $taxonomies = array();
    
    $taxes = get_object_taxonomies ( $post_type, 'object' );
    $avail_taxes = array(
        esc_html_x( 'None', 'backend', 'promosys' )	=> '',
        esc_html_x( 'Titles', 'backend', 'promosys' )	=> 'title',
    );
    
    foreach ( $taxes as $tax => $tax_obj ){
        $tax_name = isset( $tax_obj->labels->name ) && !empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax;
        $avail_taxes[$tax_name] = $tax;
    }
    
    array_push( $taxonomies, array(
        "type"				=> "dropdown",
        "heading"			=> esc_html_x( 'Filter by', 'backend', 'promosys' ),
        "param_name"		=> "post_tax",
        "value"				=> $avail_taxes,
        "edit_field_class"	=> "vc_col-xs-4",
    ));
    array_push( $taxonomies, array(
        'type'				=> 'dropdown',
        'heading'			=> esc_html_x( 'Layout', 'backend', 'promosys' ),
        'param_name'		=> 'layout',
        "edit_field_class" 	=> "vc_col-xs-4",
        'value'				=> array(
            esc_html_x( 'Large Image', 'backend', 'promosys' ) 	=> 'large',
            esc_html_x( 'Small Image', 'backend', 'promosys' ) 	=> 'small',
            esc_html_x( 'Two Columns', 'backend', 'promosys' ) 	=> '2',
            esc_html_x( 'Three Columns', 'backend', 'promosys' ) 	=> '3',
            esc_html_x( 'Four Columns', 'backend', 'promosys' ) 	=> '4',
            esc_html_x( 'Checkerboard', 'backend', 'promosys' ) 	=> 'checkerboard',
        )
    ));
    
    foreach ( $avail_taxes as $tax_name => $tax ) {
        if ($tax == 'title'){
            global $wpdb;
            $results = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type LIKE %s and post_status = 'publish'", $post_type ) );
            $titles_arr = array(esc_html_x('None', 'backend', 'promosys') => '');
            foreach( $results as $index => $post ) {
                if ( function_exists('wpm') ) {
                    $post_title = wpm_translate_string($post->post_title);
                } else {
                    $post_title = $post->post_title;
                }
                $titles_arr[$post_title] = $post->ID;
            }
            array_push( $taxonomies, array(
                "type"				=> "cws_dropdown",
                "multiple"			=> "true",
                "heading"			=> esc_html_x( 'Titles', 'backend', 'promosys' ),
                "param_name"		=> "titles",
                'edit_field_class'	=> 'inside-box vc_col-xs-12',
                "dependency"		=> array(
                    "element"	=> "post_tax",
                    "value"		=> 'title'
                ),
                "value"				=> $titles_arr
            ));
        } else {
            $terms = get_terms( $tax );
            $avail_terms = array(esc_html_x('None', 'backend', 'promosys') => '');
            if ( !is_a( $terms, 'WP_Error' ) ){
                foreach ( $terms as $term ) {
                    $avail_terms[$term->name] = $term->slug;
                }
            }
            array_push( $taxonomies, array(
                "type"			=> "cws_dropdown",
                "multiple"		=> "true",
                "heading"		=> $tax_name,
                "param_name"	=> "{$post_type}_{$tax}_terms",
                "dependency"	=> array(
                    "element"	=> "post_tax",
                    "value"		=> $tax
                    ),
                "value"			=> $avail_terms
            ));
        }
    }
    
    /* -----> BUTTON TABS PROPERTIES <----- */
    $icons = cws_ext_icon_vc_sc_config_params('btn_add_icon', true, false, 'button');
    
    $button = cws_ext_merge_arrs( array(
        /* -----> BUTTON TAB <----- */
        array(
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
                "param_name"		=> "btn_title",
                "value"				=> esc_html_x( 'Read More', 'backend', 'promosys' ),
                "edit_field_class" 	=> "vc_col-xs-6",
                "group"			    => esc_html_x( "Button", 'backend', 'promosys' ),
                "dependency"		=> array(
                    "element"	=> "add_button",
                    "not_empty"	=> true
                ),
            ), // ['btn_title']                     Button title
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
                "std"               => true,
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
                "std"               => "custom_gradient",
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
                "value"				=> PRIMARY_COLOR,
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
                "value"				=> PRIMARY_COLOR,
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
                "value"				=> "90",
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
                "value"				=> '#ffffff',
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
                "value"				=> '',
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
                "value"				=> '',
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
    
    $styles_landscape =  cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
    $styles_portrait =  cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
    $styles_mobile =  cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());
    
    $params = cws_ext_merge_arrs( array(
        /* -----> GENERAL TAB <----- */
        $taxonomies,
        array(
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Order by', 'backend', 'promosys' ),
                'param_name'		=> 'orderby',
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "post_tax",
                    "value"		=> array( "title","category","post_tag","post_format", )
                ),
                'value'				=> array(
                    esc_html_x( 'Date', 'backend', 'promosys' ) 	=> 'date',
                    esc_html_x( 'Title', 'backend', 'promosys' ) 	=> 'title',
                ),
            ), // Order by -                    $orderby
            array(
                'type'				=> 'dropdown',
                'heading'			=> esc_html_x( 'Order', 'backend', 'promosys' ),
                'param_name'		=> 'order',
                "edit_field_class" 	=> "vc_col-xs-4",
                "dependency"		=> array(
                    "element"	=> "post_tax",
                    "value"		=> array( "title","category","post_tag","post_format", )
                ),
                'value'				=> array(
                    esc_html_x( 'DESC', 'backend', 'promosys' ) 	=> 'DESC',
                    esc_html_x( 'ASC', 'backend', 'promosys' ) 	=> 'ASC',
                ),
            ), // Order -                       $order
            array(
                'type'				=> 'checkbox',
                'param_name'		=> 'enable_masonry',
                "dependency"		=> array(
                    "element"	=> "layout",
                    "value"		=> array( "2","3","4" )
                ),
                'value'				=> array(
                    esc_html_x( 'Masonry', 'backend', 'promosys' ) => true
                ),
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
            ), // Masonry -                     $enable_masonry
            array(
                'type'				=> 'checkbox',
                'param_name'		=> 'enable_carousel',
                "dependency"		=> array(
                    "element"	=> "layout",
                    "value"		=> array("small", "2", "3", "4")
                ),
                'value'				=> array(
                    esc_html_x( 'Carousel', 'backend', 'promosys' ) => true
                ),
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
            ), // Carousel -                    $enable_carousel
            array(
                'type'				=> 'checkbox',
                'param_name'		=> 'post_hide_meta_override',
                'value'				=> array(
                    esc_html_x( 'Hide Meta Data', 'backend', 'promosys' ) => true
                ),
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
            ), // Hide Meta Data -              $post_hide_meta_override
            array(
                'type'			=> 'cws_dropdown',
                'multiple'		=> "true",
                'heading'		=> esc_html_x( 'Hide', 'backend', 'promosys' ),
                'param_name'	=> 'post_hide_meta',
                'dependency'	=> array(
                    'element'	=> 'post_hide_meta_override',
                    'not_empty'	=> true
                ),
                'value'			=> array(
                    esc_html_x( 'None', 'backend', 'promosys' )				=> '',
                    esc_html_x( 'Title', 'backend', 'promosys' )			=> 'title',
                    esc_html_x( 'Categories', 'backend', 'promosys' )		=> 'cats',
                    esc_html_x( 'Author', 'backend', 'promosys' )			=> 'author',
                    esc_html_x( 'Date', 'backend', 'promosys' )				=> 'date',
                    esc_html_x( 'Comments', 'backend', 'promosys' )			=> 'comments',
                    esc_html_x( 'Featured', 'backend', 'promosys' )			=> 'featured',
                    esc_html_x( 'Read More', 'backend', 'promosys' )		=> 'read_more',
                    esc_html_x( 'Excerpt', 'backend', 'promosys' )			=> 'excerpt',
                    esc_html_x( 'Tags', 'backend', 'promosys' )			    => 'tags',
                )
            ), // Hide -                        $post_hide_meta
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Items to display', 'backend', 'promosys' ),
                "description"		=> esc_html_x( 'Enter "-1" to show all posts', 'backend', 'promosys' ),
                "param_name"		=> "total_items_count",
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> '-1'
            ), // Items to display -            $total_items_count
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Items per Page', 'backend', 'promosys' ),
                "param_name"		=> "items_pp",
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> get_theme_mod('blog_posts_per_page'),
            ), // Items per page -              $items_pp
            array(
                'type'				=> 'textfield',
                'heading'			=> esc_html_x( 'Content Character Limit', 'backend', 'promosys' ),
                'param_name'		=> 'chars_count',
                "edit_field_class" 	=> "vc_col-xs-4",
                'value'				=> get_theme_mod('blog_chars_count'),
            ), // Content character limit -     $chars_count
            
            array(
                "type"			=> "textfield",
                "heading"		=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
                "description"	=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
                "param_name"	=> "el_class",
                "value"			=> ""
            ), // Extra class name -            $el_class
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
        "name"				=> esc_html_x( 'CWS Blog', 'backend', 'promosys' ),
        "base"				=> "cws_sc_blog",
        'category'			=> "By CWS",
        "weight"			=> 80,
        "icon"     			=> "cws_icon",
        "params"			=> $params
    ));
    
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_CWS_Sc_Blog extends WPBakeryShortCode {
        }
    }

?>