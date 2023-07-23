<?php
    // Variables
    $lang_switcher_footer = array();
    if ( function_exists('wpm_language_switcher') ) {
        $lang_switcher_footer = array(
            'lang_switcher_footer' => array(
                'default'   => true,
                'type'      => 'checkbox',
                'label'     => esc_html_x('Add Language Swither', 'customizer', 'promosys')
            ),
        );
    }
    
	return array(
        'footer_section' => array(
            'title'     => esc_html_x('Footer Appearance', 'customizer', 'promosys'),
            'layout'    => array_merge(
                array(
                    'sticky_footer' => array(
                        'type'          => 'checkbox',
                        'label'         => esc_html_x('Sticky Footer', 'customizer', 'promosys'),
                        'default'       => false,
                    ),
                    'footer_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Footer Spacing', 'customizer', 'promosys'),
                        'choices'       => array(
                            'top'  => array(
                                'placeholder' => esc_html_x('Top (px)', 'customizer', 'promosys'),
                                'value' => '25px'
                            ),
                            'bottom' => array(
                                'placeholder' => esc_html_x('Bottom (px)', 'customizer', 'promosys'),
                                'value' => '25px'
                            ),
                        )
                    ),
                    'footer_logotype' => array(
                        'type'          => 'wp_image',
                        'label'         => esc_html_x('Logo', 'customizer', 'promosys'),
                        'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size', 'customizer', 'promosys'),
                    ),
                    'footer_logo_dimensions' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Dimensions', 'customizer', 'promosys'),
                        'choices'       => array(
                            'width'  => array(
                                'placeholder' => esc_html_x('Width (px)', 'customizer', 'promosys'),
                                'value' => 158
                            ),
                            'height' => array(
                                'placeholder' => esc_html_x('Height (px)', 'customizer', 'promosys'),
                                'value' => 0
                            ),
                        )
                    ),
                    'footer_bg_type' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Background type', 'customizer', 'promosys'),
                        'default'       => 'simple_gradient',
                        'choices'       => array(
                            'none'              => esc_html_x('None', 'customizer', 'promosys'),
                            'color'             => esc_html_x('Color', 'customizer', 'promosys'),
                            'simple_gradient'   => esc_html_x('Simple gradient', 'customizer', 'promosys'),
                            'custom_gradient'   => esc_html_x('Custom gradient', 'customizer', 'promosys'),
                        ),
                        'separator' => "line-top"
                    ),
                    // BG type = 'simple_gradient'
                    'footer_bg_gradient_1' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Start color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'footer_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
                    'footer_bg_gradient_2' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Finish color', 'customizer', 'promosys'),
                        'default'           => SECONDARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'footer_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
                    'footer_bg_gradient_angle' => array(
                        'type'              => 'textfield',
                        'label'             => esc_html_x('Gradient angle', 'customizer', 'promosys'),
                        'default'           => "90",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'        => array(
                            'control'   => 'footer_bg_type',
                            'operator'  => '==',
                            'value'     => 'simple_gradient'
                        ),
                    ),
                    // BG type = 'color'
                    'footer_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Footer BG Color', 'customizer', 'promosys'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'dependency'    => array(
                            'control'   => 'footer_bg_type',
                            'operator'  => '==',
                            'value'     => 'color'
                        ),
                        'live_preview'      => array(
                            'trigger_class'     => '.site-footer',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    // BG type = 'custom_gradient'
                    'footer_bg_gradient_style' => array(
                        'type'              => 'textarea',
                        'label'             => esc_html_x('Please, enter css code of custom gradient', 'customizer', 'promosys'),
                        'dependency'        => array(
                            'control'   => 'footer_bg_type',
                            'operator'  => '==',
                            'value'     => 'custom_gradient'
                        ),
                        'default'           => "background: linear-gradient(90deg, #F76331 -8.57%, #C01FB8 184.64%);",
                    ),
                    
                    'copyright_color' => array(
                        'type'              => 'alpha-color',
                        'separator'         => "line-top",
                        'label'             => esc_html_x('Text Color', 'customizer', 'promosys'),
                        'default'           => "#ffffff",
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.site-footer',
                            'style_to_change'   => 'color',
                        ),
                    ),
                    'copyright_text' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Copyrights Notice', 'customizer', 'promosys'),
                        'default'   => "Coyrights © 2020 — All rights reserved.",
                        'separator' => "line"
                    ),
                    'custom_footer' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Custom Footer Template', 'customizer', 'promosys'),
                        'default'       => 'default',
                        'choices'       => array(
                            'default'   => esc_html_x('Default', 'customizer', 'promosys'),
                        ) + $custom_footers,
                        'description'   => esc_html_x('All settings above are applied for default footer template only', 'customizer', 'promosys')
                    )
                ),
                $lang_switcher_footer
            )
        ),
	)
?>