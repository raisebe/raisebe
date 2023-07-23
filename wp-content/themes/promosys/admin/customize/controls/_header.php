<?php
    // Get typography props
    $promosys_typography_control = array();
    if( function_exists('promosys_typography_control') ){
        $promosys_typography_control = promosys_typography_control( 'menu', 'Poppins', array('regular', '500'), 'latin', false, '16px', '24px' );
    }
    
    // Variables
    $lang_switcher_header = $lang_switcher_sticky = $lang_switcher_mobile = array();
    if ( function_exists('wpm_language_switcher') ) {
        $lang_switcher_header = array(
            'lang_switcher_header' => array(
                'default'   => true,
                'type'      => 'checkbox',
                'label'     => esc_html_x('Add Language Swither', 'customizer', 'promosys')
            ),
        );
        $lang_switcher_sticky = array(
            'lang_switcher_sticky' => array(
                'default'   => true,
                'type'      => 'checkbox',
                'label'     => esc_html_x('Add Language Swither', 'customizer', 'promosys')
            ),
        );
        $lang_switcher_mobile = array(
            'lang_switcher_mobile' => array(
                'default'   => true,
                'type'      => 'checkbox',
                'label'     => esc_html_x('Add Language Swither', 'customizer', 'promosys')
            ),
        );
    }

	return array(
        'header_general_section' => array(
            'title'     => esc_html_x('General', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'header_bg_type' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Background type', 'customizer', 'promosys'),
                        'default'       => 'custom_gradient',
                        'choices'       => array(
                            'none'              => esc_html_x('None', 'customizer', 'promosys'),
                            'color'             => esc_html_x('Color', 'customizer', 'promosys'),
                            'simple_gradient'   => esc_html_x('Simple gradient', 'customizer', 'promosys'),
                            'custom_gradient'   => esc_html_x('Custom gradient', 'customizer', 'promosys'),
                            'image'             => esc_html_x('Image', 'customizer', 'promosys'),
                        ),
                    ),
                    
                    // BG type = 'simple_gradient'
                    'header_bg_gradient_1' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Start color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
                    'header_bg_gradient_2' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Finish color', 'customizer', 'promosys'),
                        'default'           => SECONDARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
                    'header_bg_gradient_angle' => array(
                        'type'              => 'textfield',
                        'label'             => esc_html_x('Gradient angle', 'customizer', 'promosys'),
                        'default'           => "140",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
    
                    // BG type = 'color'
                    'header_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Header Background Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'color'
                        ),
                        'live_preview'      => array(
                            'trigger_class'     => '.header-bg',
                            'style_to_change'   => 'background-color',
                        )
                    ),
    
                    // BG type = 'custom_gradient'
                    'header_bg_gradient_style' => array(
                        'type'              => 'textarea',
                        'label'             => esc_html_x('Please, enter css code of custom gradient', 'customizer', 'promosys'),
                        'dependency'        => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'custom_gradient'
                        ),
                        'default'           => "background: linear-gradient(178.32deg, rgba(255, 255, 255, 0.5) -20.58%, rgba(255, 255, 255, 0) 97.59%), linear-gradient(140.43deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%); background-position: 0 -60%; background-size: 100% 267%; opacity: 0.8;",
                    ),
    
                    // BG type = 'image'
                    'header_bg_image' => array(
                        'type'              => 'wp_image',
                        'label'             => esc_html_x('Header Background Image', 'customizer', 'promosys'),
                        'dependency'        => array(
                            'control'   => 'header_bg_type',
                            'operator'  => '==',
                            'value'     => 'image'
                        ),
                    ),
    
                    'add_header_overlay' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Show header overlay', 'customizer', 'promosys'),
                    ),
                    'header_overlay_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Header Overlay Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'add_header_overlay',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                        'live_preview'      => array(
                            'trigger_class'     => '.site-header-overlay',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    
                    'header_svg_mask' => array(
                        'default'     => true,
                        'type'        => 'checkbox',
                        'label'       => esc_html_x('Apply header mask', 'customizer', 'promosys'),
                    ),
    
                    'header_over_slider' => array(
                        'default'     => false,
                        'type'        => 'checkbox',
                        'label'       => esc_html_x('Menu and logo overlays homepage slider', 'customizer', 'promosys'),
                        'description' => esc_html_x('This option will force the menu and logo sections to overlay the homepage slider. It is useful when using transparent menu.', 'customizer', 'promosys'),
                    ),
                )
            ),
        ),
		'top_bar_section' => array(
            'title'     => esc_html_x('Top Bar', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'top_bar_wide' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Apply full-width top bar', 'customizer', 'promosys'),
                    ),
                    'top_bar_number' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Phone Number', 'customizer', 'promosys'),
                        'default'   => "",
                    ),
                    'top_bar_email' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Email', 'customizer', 'promosys'),
                        'default'   => "",
                    ),
                    'top_bar_address' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Address', 'customizer', 'promosys'),
                        'default'   => "",
                        'separator' => 'line'
                    ),
                    
                    'top_bar_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Background', 'customizer', 'promosys'),
                        'default'           => '#243238',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.top-bar-box',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    'top_bar_border_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Bottom Border', 'customizer', 'promosys'),
                        'default'           => '',
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'top_bar_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Fonts & Icons Color', 'customizer', 'promosys'),
                        'default'           => '#ffffff',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.top-bar-box .container > * > a, .header_icons > .mini-cart > a',
                            'style_to_change'   => 'color',
                        )
                    ),
                    'top_bar_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Fonts & Icons Hover', 'customizer', 'promosys'),
                        'default'           => '#ffea74',
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'top_bar_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'promosys'),
                        'choices'       => array(
                            'top'  => array( 
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'promosys'),
                                'value' => '14px'
                            ),
                            'bottom' => array( 
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'promosys'),
                                'value' => '14px'
                            ),
                        )
                    ),
                    'icon_custom_sb' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Custom Sidebar Icon', 'customizer', 'promosys')
                    ),
                    'custom_sidebar' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Custom sidebar', 'customizer', 'promosys'),
                        'default'       => 'custom_sidebar',
                        'dependency'    => array(
                            'control'   => 'icon_custom_sb',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                        'choices'       => array_merge(
                            array(
                                'none'  => esc_html_x('None', 'customizer', 'promosys'),
                            ),
                            is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                        ),
                    ),
                )
            ),
        ),
        'logotype_section' => array(
            'title'     => esc_html_x('Logo', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'logotype' => array(
                        'type'          => 'wp_image',
                        'label'         => esc_html_x('Logo', 'customizer', 'promosys'),
                        'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size', 'customizer', 'promosys'),
                    ),
                    'logo_dimensions' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Dimensions', 'customizer', 'promosys'),
                        'choices'       => array(
                            'width'  => array(
                                'placeholder' => esc_html_x('Width (px)', 'customizer', 'promosys'),
                                'value' => '228px'
                            ),
                            'height' => array(
                                'placeholder' => esc_html_x('Height (px)', 'customizer', 'promosys'),
                                'value' => 0
                            ),
                        )
                    ),
                )
            ),
        ),
        'menu_section' => array(
            'title'     => esc_html_x('Menu Appearance', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'menu_wide' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Apply full-width menu', 'customizer', 'promosys'),
                    )
                ),
                $promosys_typography_control,
                array(
                    'menu_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'menu_accent_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Accent Font Color', 'customizer', 'promosys'),
                        'default'           => "#FFEA74",
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'submenu_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Submenu Font Color', 'customizer', 'promosys'),
                        'default'           => "#243238",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'submenu_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Submenu Font Hover', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'menu_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'promosys'),
                        'choices'       => array(
                            'top'  => array( 
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'promosys'),
                                'value' => '32px'
                            ),
                            'bottom' => array( 
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'promosys'),
                                'value' => '27px'
                            ),
                        )
                    ),
                    'menu_mode' => array(
                        'default'       => 'desktop',
                        'type'          => 'radio',
                        'label'         => esc_html_x('Show desktop menu on:', 'customizer', 'promosys'),
                        'choices'       => array(
                            'desktop'       => esc_html_x('Desktops', 'customizer', 'promosys'),
                            'landscape'     => esc_html_x('Tablets Landscape', 'customizer', 'promosys'),
                            'both'          => esc_html_x('Landscape & Portrait Tablets', 'customizer', 'promosys'),
                        ),
                        'separator'     => 'line'
                    ),
                    'menu_icon_search' => array(
                        'default'   => true,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Search Icon', 'customizer', 'promosys')
                    ),
                    'menu_search_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Search Title', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'menu_icon_search',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                ),
                $lang_switcher_header,
                array(
                    'menu_extra_button' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Extra Button', 'customizer', 'promosys')
                    ),
                    'menu_extra_button_url' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Link', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Title', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
    
                    'menu_extra_button_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color Hover', 'customizer', 'promosys'),
                        'default'           => "#000000",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_bd_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_bd_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color Hover', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'menu_extra_button_bg_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color Hover', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'menu_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                )
            )
        ),
        'title_area' => array(
            'title'     => esc_html_x('Title Area', 'customizer', 'promosys'),
            'layout'    => array(
                'title_area_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Title Spacing', 'customizer', 'promosys'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px)', 'customizer', 'promosys'),
                            'value' => '22px'
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px)', 'customizer', 'promosys'),
                            'value' => '129px'
                        ),
                    )
                ),
                'mobile_title_area_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x(' Mobile Title Spacing', 'customizer', 'promosys'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px)', 'customizer', 'promosys'),
                            'value' => '40px'
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px)', 'customizer', 'promosys'),
                            'value' => '40px'
                        ),
                    ),
                ),
                'title_archive_font_size' => array(
                    'type'          => 'textfield',
                    'label'         => esc_html_x('Title Font Size on Archive', 'customizer', 'promosys'),
                    'default'       => "50px",
                    'live_preview'      => array(
                        'trigger_class'     => 'body:not(.single) .page_title_container .page_title_customizer_size',
                        'style_to_change'   => 'font-size',
                    )
                ),
                'title_single_font_size' => array(
                    'type'          => 'textfield',
                    'label'         => esc_html_x('Title Font Size on Singles', 'customizer', 'promosys'),
                    'default'       => "50px",
                    'separator'     => 'line',
                    'live_preview'      => array(
                        'trigger_class'     => 'body.single .page_title_container .page_title_customizer_size',
                        'style_to_change'   => 'font-size',
                    )
                ),
                'add_title_overlay' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Title Area overlay', 'customizer', 'promosys'),
                ),
                'title_overlay' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Title Area Overlay Color', 'customizer', 'promosys'),
                    'default'           => "",
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'add_title_overlay',
                        'operator'  => '==',
                        'value'     => 'true'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_overlay',
                        'style_to_change'   => 'background-color',
                    )
                ),
    
    
                'title_bg_type' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Background type', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'              => esc_html_x('None', 'customizer', 'promosys'),
                        'color'             => esc_html_x('Color', 'customizer', 'promosys'),
                        'simple_gradient'   => esc_html_x('Simple gradient', 'customizer', 'promosys'),
                        'custom_gradient'   => esc_html_x('Custom gradient', 'customizer', 'promosys'),
                        'image'             => esc_html_x('Image', 'customizer', 'promosys'),
                    ),
                ),
                
                // BG type = 'simple_gradient'
                'title_background_gradient_1' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Start Color', 'customizer', 'promosys'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'simple_gradient'
                    ),
                ),
                'title_background_gradient_2' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Finish Color', 'customizer', 'promosys'),
                    'default'           => SECONDARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'simple_gradient'
                    ),
                ),
                'title_bg_gradient_angle' => array(
                    'type'              => 'textfield',
                    'label'             => esc_html_x('Gradient angle', 'customizer', 'promosys'),
                    'default'           => "140",
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'        => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'simple_gradient'
                    ),
                ),
    
                // BG type = 'color'
                'title_bg_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Title Area BG Color', 'customizer', 'promosys'),
                    'default'           => "",
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'color'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container',
                        'style_to_change'   => 'background-color',
                    )
                ),
    
                // BG type = 'custom_gradient'
                'title_custom_gradient_css' => array(
                    'type'          => 'textarea',
                    'label'         => esc_html_x('Please, enter css code of custom gradient', 'customizer', 'promosys'),
                    'dependency'    => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'custom_gradient'
                    ),
                    'default'       => "",
                ),
    
                // BG type = 'image'
                'title_area_bg' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Title Area Background', 'customizer', 'promosys'),
                    'dependency'    => array(
                        'control'   => 'title_bg_type',
                        'operator'  => '==',
                        'value'     => 'image'
                    ),
                ),
                
                'title_fields_hide' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x( 'None', 'customizer', 'promosys'),
                        'title'         => esc_html_x( 'Title', 'customizer', 'promosys' ),
                        'meta'          => esc_html_x( 'Meta', 'customizer', 'promosys' ),
                        'divider'       => esc_html_x( 'Divider', 'customizer', 'promosys' ),
                        'breadcrumbs'   => esc_html_x( 'Breadcrumbs', 'customizer', 'promosys' )
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    ),
                    'separator' => 'line-top'
                ),
                'title_title_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Title Color', 'customizer', 'promosys'),
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'title'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .page_title',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_divider_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Divider Color', 'customizer', 'promosys'),
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'divider'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .title_divider svg',
                        'style_to_change'   => 'fill',
                    )
                ),
                'title_text_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Text Color', 'customizer', 'promosys'),
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'meta'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .single_post_meta',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_text_color_hover' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Text Color on Hover', 'customizer', 'promosys'),
                    'default'           => '#FFEA74',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'meta'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .single_post_meta a:hover',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_scroll_animation' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Scroll Animation', 'customizer', 'promosys'),
                ),
            )
        ),
        'mobile_menu_section' => array(
            'title'     => esc_html_x('Mobile Menu', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'mobile_top_bar_logotype' => array(
                        'type'          => 'wp_image',
                        'label'         => esc_html_x('Top Bar Logotype', 'customizer', 'promosys'),
                        'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'promosys'),
                    ),
                    'mobile_top_bar_logo_dimensions' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Top Bar Logo Dimensions', 'customizer', 'promosys'),
                        'choices'       => array(
                            'width'  => array(
                                'placeholder' => esc_html_x('Width (px)', 'customizer', 'promosys'),
                                'value' => '130px'
                            ),
                            'height' => array(
                                'placeholder' => esc_html_x('Height (px)', 'customizer', 'promosys'),
                                'value' => ''
                            ),
                        ),
                        'separator'     => 'line'
                    ),
                    'mobile_menu_logotype' => array(
                        'type'          => 'wp_image',
                        'label'         => esc_html_x('Menu Logotype', 'customizer', 'promosys'),
                        'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'promosys'),
                    ),
                    'mobile_menu_logo_dimensions' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Menu Logo Dimensions', 'customizer', 'promosys'),
                        'choices'       => array(
                            'width'  => array(
                                'placeholder' => esc_html_x('Width (px)', 'customizer', 'promosys'),
                                'value' => '158px'
                            ),
                            'height' => array(
                                'placeholder' => esc_html_x('Height (px)', 'customizer', 'promosys'),
                                'value' => ''
                            ),
                        ),
                        'separator'     => 'line'
                    ),
                    'mobile_show_minicart' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Show Mini-Cart', 'customizer', 'promosys'),
                    ),
                    'mobile_show_custom_sidebar' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Show Custom Sidebar', 'customizer', 'promosys'),
                    )
                ),
                $lang_switcher_mobile,
                array(
                    'mobile_extra_button' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Extra Button', 'customizer', 'promosys')
                    ),
                    'mobile_extra_button_url' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Link', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Title', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
    
                    'mobile_extra_button_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color Hover', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_bd_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_bd_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color Hover', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'mobile_extra_button_bg_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color Hover', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'mobile_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    
                    
                    
                    
                    'mobile_menu_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'promosys'),
                        'choices'       => array(
                            'top'  => array(
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'promosys'),
                                'value' => '15px'
                            ),
                            'bottom' => array(
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'promosys'),
                                'value' => '35px'
                            ),
                        )
                    ),
                    'mobile_topbar_bg' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Top Bar Background', 'customizer', 'promosys'),
                        'default'           => "#fff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.site-header-mobile .top-bar-box',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    'mobile_icons_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Icons Color', 'customizer', 'promosys'),
                        'default'           => "#000",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.site-header-mobile .menu-trigger span',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    
                    'mobile_menu_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Menu Font Color', 'customizer', 'promosys'),
                        'default'           => "rgba(74,74,74,0.8)",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'mobile_accent_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Menu Accent Color', 'customizer', 'promosys'),
                        'default'           => "#fff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'mobile_menu_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Menu BG Color', 'customizer', 'promosys'),
                        'default'           => "#fff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'mobile_accent_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Menu Accent BG Color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'mobile_submenu_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Sub-Menu Font Color', 'customizer', 'promosys'),
                        'default'           => "rgba(74,74,74,0.8)",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'mobile_submenu_accent_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Sub-Menu Accent Color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                    )
                )
            )
        ),
        'sticky_menu_section' => array(
            'title'     => esc_html_x('Sticky Menu', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'sticky_wide' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Apply full-width sticky menu', 'customizer', 'promosys'),
                    ),
                    'sticky_logotype' => array(
                        'type'          => 'wp_image',
                        'label'         => esc_html_x('Sticky Logo', 'customizer', 'promosys'),
                        'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'promosys'),
                    ),
                    'sticky_logo_dimensions' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Sticky Logo Dimensions', 'customizer', 'promosys'),
                        'choices'       => array(
                            'width'  => array(
                                'placeholder' => esc_html_x('Width (px)', 'customizer', 'promosys'),
                                'value' => '158px'
                            ),
                            'height' => array(
                                'placeholder' => esc_html_x('Height (px)', 'customizer', 'promosys'),
                                'value' => ''
                            ),
                        )
                    ),
                    'sticky_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'promosys'),
                        'choices'       => array(
                            'top'  => array(
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'promosys'),
                                'value' => '0px'
                            ),
                            'bottom' => array(
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'promosys'),
                                'value' => '0px'
                            ),
                        )
                    ),
                    'sticky_shadow' => array(
                        'default'   => true,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Shadow', 'customizer', 'promosys'),
                    ),
                    'sticky_shadow_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Shadow Color', 'customizer', 'promosys'),
                        'default'           => 'rgba(16,1,148, 0.1)',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'           => array(
                            'control'   => 'sticky_shadow',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_background' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Background Color', 'customizer', 'promosys'),
                        'default'           => '#ffffff',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.site-sticky',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    'sticky_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'promosys'),
                        'default'           => "#243238",
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'sticky_accent_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Accent Color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'sticky_icon_search' => array(
                        'default'   => true,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Search Icon', 'customizer', 'promosys'),
                        'separator'     => 'line-top',
                    ),
                    'sticky_search_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Search Title', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'sticky_icon_search',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    )
                ),
                $lang_switcher_sticky,
                array(
                    'sticky_extra_button' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Extra Button', 'customizer', 'promosys')
                    ),
                    'sticky_extra_button_url' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Link', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Title', 'customizer', 'promosys'),
                        'default'   => esc_html_x('', 'customizer', 'promosys'),
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
    
                    'sticky_extra_button_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'promosys'),
                        'default'           => "#3B545F",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color Hover', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_bd_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color', 'customizer', 'promosys'),
                        'default'           => "#3B545F",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_bd_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Border Color Hover', 'customizer', 'promosys'),
                        'default'           => "#3B545F",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color', 'customizer', 'promosys'),
                        'default'           => "",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'sticky_extra_button_bg_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font BG Color Hover', 'customizer', 'promosys'),
                        'default'           => "#3B545F",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'sticky_extra_button',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                    ),
                    'custom_sticky' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Sticky Menu Template', 'customizer', 'promosys'),
                        'default'       => 'default',
                        'choices'       => array(
                            'default'   => esc_html_x('Default', 'customizer', 'promosys'),
                        ) + $custom_sticky_headers,
                        'separator'     => 'line-top',
                        'description'   => esc_html_x('All settings above are applied for default sticky template only', 'customizer', 'promosys'),
                    )
                )
            )
        ),
        'header_section' => array(
            'title'     => esc_html_x('Custom Header', 'customizer', 'promosys'),
            'layout'    => array(
                'custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Custom Header Template', 'customizer', 'promosys'),
                    'default'       => 'default',
                    'choices'       => array(
                        'default'   => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers,
                    'description'   => esc_html_x('The following tab settings will be ingnored if custom headers are applied: Top Bar, Logotype, Menu', 'customizer', 'promosys'),
                ),
            )
        )
	)
?>