<?php
    // Get typography props
    $promosys_typography_control = array();
    if( function_exists('promosys_typography_control') ){
        $promosys_typography_control = array_merge(
            promosys_typography_control( 'titles', 'Poppins', array('regular', 'italic', '500', '500italic', '600', '600italic',  '700', '700italic', '800', '800italic'), 'latin', '#243238',false,false ),
            promosys_typography_control( 'body', 'Work Sans', array('regular', '500', '600', '700', '800' ),
                'latin',
                '#3B545F',
                '16px', '32px' )
        );
    }

    // Set default sidebars
    $default_sidebars = array(
        'blog_sidebar'          => esc_html_x('Blog', 'customizer', 'promosys'),
        'blog_single_sidebar'   => esc_html_x('Blog Single', 'customizer', 'promosys'),
        'custom_sidebar'        => esc_html_x('Custom Sidebar', 'customizer', 'promosys'),
    );
    if( class_exists('WooCommerce') ){
        $default_sidebars['woocommerce'] = esc_html_x('Woocommerce', 'customizer', 'promosys');
        $default_sidebars['woocommerce_single'] = esc_html_x('Woocommerce Singe', 'customizer', 'promosys');
    }

	return array(
		'colors' => array(
            'title'     => esc_html_x('Theme Colors', 'customizer', 'promosys'),
            'layout'    => array(
                'primary_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Theme Color', 'customizer', 'promosys'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags'
                ),
                'secondary_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Second Color', 'customizer', 'promosys'),
                    'default'           => SECONDARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags'
                ),
            )
        ),
        'typography' => array(
            'title'     => esc_html_x('Typography', 'customizer', 'promosys'),
            'layout'    => array_merge(
                $promosys_typography_control,
                array(
                    'g_fonts_api' => array(
                        'type'          => 'custom-text',
                        'label'         => esc_html_x('Google Fonts Api Key', 'customizer', 'promosys'),
                        'transport'     => 'postMessage',
                        'function'      => 'promosys_update_fonts',
                        'description'   => esc_html_x('Enter Your Api Key and press Enter', 'customizer', 'promosys'),
                        'input_attrs'   => array(
                            'success'   => esc_html_x('Google Fonts updated. Please refresh the page to see the changes', 'customizer', 'promosys'),
                            'error'     => esc_html_x('Wrong API Key or Resource is unavailable', 'customizer', 'promosys')
                        )
                    )
                )
            )
        ),
        'blog_layout' => array(
            'title'     => esc_html_x('Blog Layout', 'customizer', 'promosys'),
            'layout'    => array(
                'blog_view' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Blog layout', 'customizer', 'promosys'),
                    'default'   => 'large',
                    'choices'   => array(
                        'large'     => esc_html_x('Large', 'customizer', 'promosys'),
                        'grid'      => esc_html_x('Grid', 'customizer', 'promosys'),
                        'masonry'   => esc_html_x('Masonry', 'customizer', 'promosys'),
                    )
                ),
                'blog_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Blog Columns', 'customizer', 'promosys'),
                    'default'   => '2',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'promosys'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'promosys'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_view',
                        'operator'  => '!=',
                        'value'     => 'large'
                    )
                ),
                'blog_chars_count' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Crop content', 'customizer', 'promosys'),
                    'default'       => '-1',
                    'description'   => esc_html_x('"-1" to SHOW whole content | empty or "0" to HIDE content', 'customizer', 'promosys'),
                    'input_attrs'   => array(
                        'min'   => '-1'
                    )
                ),
                'blog_read_more' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Read More Button Title', 'customizer', 'promosys'),
                    'default'       => esc_html_x('Read More', 'customizer', 'promosys'),
                ),
                'blog_posts_per_page' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Posts Per Page', 'customizer', 'promosys'),
                    'default'       => '-1',
                    'description'   => esc_html_x('"-1" to show all posts', 'customizer', 'promosys'),
                    'input_attrs'   => array(
                        'min'   => '-1'
                    )
                ),
                'blog_hide_meta' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide post meta', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x( 'None', 'customizer', 'promosys'),
                        'title'         => esc_html_x( 'Title', 'customizer', 'promosys' ),
                        'cats'          => esc_html_x( 'Categories', 'customizer', 'promosys' ),
                        'author'        => esc_html_x( 'Author', 'customizer', 'promosys' ),
                        'date'          => esc_html_x( 'Date', 'customizer', 'promosys' ),
                        'comments'      => esc_html_x( 'Comments', 'customizer', 'promosys' ),
                        'featured'      => esc_html_x( 'Featured', 'customizer', 'promosys' ),
                        'read_more'     => esc_html_x( 'Read More', 'customizer', 'promosys' ),
                        'excerpt'       => esc_html_x( 'Excerpt', 'customizer', 'promosys' ),
                        'tags'          => esc_html_x( 'Tags', 'customizer', 'promosys' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    )
                ),
                'blog_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'promosys'),
                    'default'       => 'blog_sidebar',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'promosys'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'blog_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'promosys'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'promosys'),
                        'left'  => esc_html_x('Left', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'blog_single_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select Single sidebar', 'customizer', 'promosys'),
                    'default'       => 'blog_single_sidebar',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'promosys'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'blog_single_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Single Position', 'customizer', 'promosys'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'promosys'),
                        'left'  => esc_html_x('Left', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_single_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'blog_related' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Related', 'customizer', 'promosys'),
                    'separator' => 'line-top'
                ),
                'blog_related_cropp' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Cropped Images', 'customizer', 'promosys'),
                ),
                'blog_related_title' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Title', 'customizer', 'promosys'),
                    'default'       => 'Latest Posts',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Related Columns', 'customizer', 'promosys'),
                    'default'   => '2',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'promosys'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'promosys'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_items' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Related Items', 'customizer', 'promosys'),
                    'default'       => '2',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_pick' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pick From', 'customizer', 'promosys'),
                    'default'       => 'latest',
                    'choices'       => array(
                        'category'      => esc_html_x( 'Same Categories', 'customizer', 'promosys' ),
                        'tags'          => esc_html_x( 'Same Tags', 'customizer', 'promosys' ),
                        'random'        => esc_html_x(' Random', 'customizer', 'promosys'),
                        'latest'        => esc_html_x( 'Latest', 'customizer', 'promosys' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_text_length' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Text Lenght', 'customizer', 'promosys'),
                    'default'       => '90',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_hide' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'promosys'),
                    'default'       => 'cats,comments,read_more,excerpt',
                    'choices'       => array(
                        'none'          => esc_html_x( 'None', 'customizer', 'promosys'),
                        'title'         => esc_html_x( 'Title', 'customizer', 'promosys' ),
                        'cats'          => esc_html_x( 'Categories', 'customizer', 'promosys' ),
                        'author'        => esc_html_x( 'Author', 'customizer', 'promosys' ),
                        'date'          => esc_html_x( 'Date', 'customizer', 'promosys' ),
                        'comments'      => esc_html_x( 'Comments', 'customizer', 'promosys' ),
                        'featured'      => esc_html_x( 'Featured', 'customizer', 'promosys' ),
                        'read_more'     => esc_html_x( 'Read More', 'customizer', 'promosys' ),
                        'excerpt'       => esc_html_x( 'Excerpt', 'customizer', 'promosys' ),
                        'tags'          => esc_html_x( 'Tags', 'customizer', 'promosys' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    ),
                    'dependency'    => array(
                        'control'       => 'blog_related',
                        'operator'      => '==',
                        'value'         => 'true'
                    )
                ),
                'blog_single_custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Header Template for Blog Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'separator'     => 'line-top',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Custom Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers
                ),
                'blog_single_custom_sticky_header' => array(
                    'type'           => 'select',
                    'label'          => esc_html_x('Sticky Template for Blog Single', 'customizer', 'promosys'),
                    'default'        => 'inherit',
                    'choices'        => array(
                        'inherit'       => esc_html_x('Inherit from Sticky Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_sticky_headers
                ),
                'blog_single_custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Footer Template for Blog Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Footer Appearance', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_footers
                ),
            )
        ),
        'page_layout' => array(
            'title'     => esc_html_x('Page Layout', 'customizer', 'promosys'),
            'layout'    => array(
                'page_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'promosys'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array() 
                    ),
                ),
                'page_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'promosys'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'promosys'),
                        'left'  => esc_html_x('Left', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'page_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
            )
        ),
        'portfolio_layout' => array(
            'title'     => esc_html_x('Portfolio Layout', 'customizer', 'promosys'),
            'layout'    => array(
                'cws_portfolio_layout' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Layout', 'customizer', 'promosys'),
                    'default'       => 'grid',
                    'choices'       => array(
                        'grid'              => esc_html_x( 'Grid', 'customizer', 'promosys' ),
                        'masonry'           => esc_html_x( 'Masonry', 'customizer', 'promosys' ),
                        'pinterest'         => esc_html_x( 'Pinterest', 'customizer', 'promosys' ),
                        'asymmetric'        => esc_html_x( 'Asymmetric', 'customizer', 'promosys' ),
                        'carousel'          => esc_html_x( 'Carousel', 'customizer', 'promosys' ),
                        'carousel_wide'     => esc_html_x( 'Carousel Wide', 'customizer', 'promosys' ),
                        'motion_category'   => esc_html_x( 'Motion Category', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_hover' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hover', 'customizer', 'promosys'),
                    'default'       => 'overlay',
                    'choices'       => array(
                        'overlay'       => esc_html_x( 'Overlay', 'customizer', 'promosys' ),
                        'slide_bottom'  => esc_html_x( 'Slide From Bottom', 'customizer', 'promosys' ),
                        'slide_left'    => esc_html_x( 'Slide From Left', 'customizer', 'promosys' ),
                        'swipe_right'   => esc_html_x( 'Swipe Right', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_orderby' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order By', 'customizer', 'promosys'),
                    'default'       => 'date',
                    'choices'       => array(
                        'date'          => esc_html_x( 'Date', 'customizer', 'promosys' ),
                        'menu_order'    => esc_html_x( 'Order ID', 'customizer', 'promosys' ),
                        'title'         => esc_html_x( 'Title', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_order' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order', 'customizer', 'promosys'),
                    'default'       => 'DESC',
                    'choices'       => array(
                        'ASC'   => esc_html_x( 'ASC', 'customizer', 'promosys' ),
                        'DESC'  => esc_html_x( 'DESC', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_columns' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Columns', 'customizer', 'promosys'),
                    'default'       => '4',
                    'choices'       => array(
                        '2' => esc_html_x( '2', 'customizer', 'promosys' ),
                        '3' => esc_html_x( '3', 'customizer', 'promosys' ),
                        '4' => esc_html_x( '4', 'customizer', 'promosys' ),
                        '5' => esc_html_x( '5', 'customizer', 'promosys' ),
                        '6' => esc_html_x( '6', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_items_pp' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Items per Page', 'customizer', 'promosys'),
                    'default'       => '12',
                ),
                'cws_portfolio_no_spacing' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Disable Spacings', 'customizer', 'promosys'),
                ),
                'cws_portfolio_pagination' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pagination', 'customizer', 'promosys'),
                    'default'       => 'standart',
                    'choices'       => array(
                        'standart'      => esc_html_x( 'Standard', 'customizer', 'promosys' ),
                        'load_more'     => esc_html_x( 'Load More', 'customizer', 'promosys' ),
                    )
                ),
                'cws_portfolio_hide_meta' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'promosys'),
                    'default'       => 'excerpt,tags',
                    'choices'       => array(
                        ''              => esc_html_x( 'None', 'backend', 'promosys' ),
                        'title'         => esc_html_x( 'Title', 'backend', 'promosys' ),
                        'excerpt'       => esc_html_x( 'Excerpt', 'backend', 'promosys' ),
                        'categories'    => esc_html_x( 'Categories', 'backend', 'promosys' ),
                        'tags'          => esc_html_x( 'Tags', 'backend', 'promosys' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    )
                ),
                'cws_reset_permalinks' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Reset Permalinks', 'customizer', 'promosys'),
                    'default'       => 'false',
                ),
                'cws_portfolio_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Slug', 'customizer', 'promosys'),
                    'default'       => 'Portfolio Archive',
                ),
                'cws_portfolio_single_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Single Slug', 'customizer', 'promosys'),
                    'default'       => 'Portfolio Single',
                ),
                'cws_portfolio_related' => array(
                    'default'   => true,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Related', 'customizer', 'promosys'),
                    'separator' => 'line-top'
                ),
                'cws_portfolio_related_title' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Title', 'customizer', 'promosys'),
                    'default'       => 'Related projects',
                    'dependency'    => array(
                        'control'   => 'cws_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'cws_portfolio_related_hover' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Related Hover', 'customizer', 'promosys'),
                    'default'       => 'overlay',
                    'choices'       => array(
                        'overlay'       => esc_html_x( 'Overlay', 'customizer', 'promosys' ),
                        'slide_bottom'  => esc_html_x( 'Slide From Bottom', 'customizer', 'promosys' ),
                        'slide_left'    => esc_html_x( 'Slide From Left', 'customizer', 'promosys' ),
                        'swipe_right'   => esc_html_x( 'Swipe Right', 'customizer', 'promosys' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'cws_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'cws_portfolio_related_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Related Columns', 'customizer', 'promosys'),
                    'default'   => '4',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'promosys'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'promosys'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'cws_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'cws_portfolio_related_items' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Related Items', 'customizer', 'promosys'),
                    'default'       => '4',
                    'dependency'    => array(
                        'control'   => 'cws_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'cws_portfolio_related_pick' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pick From', 'customizer', 'promosys'),
                    'default'       => 'category',
                    'choices'       => array(
                        'category'      => esc_html_x( 'Same Categories', 'customizer', 'promosys' ),
                        'tags'          => esc_html_x( 'Same Tags', 'customizer', 'promosys' ),
                        'random'        => esc_html_x( 'Random', 'customizer', 'promosys' ),
                        'latest'        => esc_html_x( 'Latest', 'customizer', 'promosys' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'cws_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'cws_portfolio_custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Header Template for Portfolio', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'separator'     => 'line-top',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Custom Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers
                ),
                'cws_portfolio_custom_sticky_header' => array(
                    'type'           => 'select',
                    'label'          => esc_html_x('Sticky Template for Portfolio', 'customizer', 'promosys'),
                    'default'        => 'inherit',
                    'choices'        => array(
                        'inherit'       => esc_html_x('Inherit from Sticky Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_sticky_headers
                ),
                'cws_portfolio_custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Footer Template for Portfolio', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Footer Appearance', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_footers
                ),
                'cws_portfolio_single_custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Header Template for Portfolio Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'separator'     => 'line-top',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Custom Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers
                ),
                'cws_portfolio_single_custom_sticky_header' => array(
                    'type'           => 'select',
                    'label'          => esc_html_x('Sticky Template for Portfolio Single', 'customizer', 'promosys'),
                    'default'        => 'inherit',
                    'choices'        => array(
                        'inherit'       => esc_html_x('Inherit from Sticky Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_sticky_headers
                ),
                'cws_portfolio_single_custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Footer Template for Portfolio Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Footer Appearance', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_footers
                ),
            ),
        ),
        'staff_layout' => array(
            'title'     => esc_html_x('Our Team Layout', 'customizer', 'promosys'),
            'layout'    => array(
                'cws_staff_order_by' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order by', 'customizer', 'promosys'),
                    'default'       => 'date',
                    'choices'       => array(
                        'date'          => esc_html_x('Date', 'customizer', 'promosys'),
                        'menu_order'    => esc_html_x('Order ID', 'customizer', 'promosys'),
                        'title'         => esc_html_x('Title', 'customizer', 'promosys'),
                    )
                ),
                'cws_staff_order' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order', 'customizer', 'promosys'),
                    'default'       => 'ASC',
                    'choices'       => array(
                        'ASC'   => esc_html_x('ASC', 'customizer', 'promosys'),
                        'DESC'  => esc_html_x('DESC', 'customizer', 'promosys'),
                    )
                ),
                'cws_staff_columns' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Columns', 'customizer', 'promosys'),
                    'default'       => '3',
                    'choices'       => array(
                        '2' => esc_html_x('2', 'customizer', 'promosys'),
                        '3' => esc_html_x('3', 'customizer', 'promosys'),
                        '4' => esc_html_x('4', 'customizer', 'promosys'),
                    )
                ),
                'cws_staff_items_pp' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Items per Page', 'customizer', 'promosys'),
                    'default'       => '6',
                ),
                'cws_staff_hide_meta' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'promosys'),
                    'default'       => 'department,experience,email,phone,biography,info',
                    'choices'       => array(
                        ''              => esc_html_x( 'None', 'customizer', 'promosys' ),
                        'photo'         => esc_html_x( 'Photo', 'customizer', 'promosys' ),
                        'name'          => esc_html_x( 'Name', 'customizer', 'promosys' ),
                        'position'      => esc_html_x( 'Position', 'customizer', 'promosys' ),
                        'department'    => esc_html_x( 'Department', 'customizer', 'promosys' ),
                        'experience'    => esc_html_x( 'Experience', 'customizer', 'promosys' ),
                        'email'         => esc_html_x( 'Email', 'customizer', 'promosys' ),
                        'phone'         => esc_html_x( 'Phone Number', 'customizer', 'promosys' ),
                        'socials'       => esc_html_x( 'Socials', 'customizer', 'promosys' ),
                        'biography'     => esc_html_x( 'Biography', 'customizer', 'promosys' ),
                        'info'          => esc_html_x( 'Personal Info', 'customizer', 'promosys' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    )
                ),
                'cws_staff_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'promosys'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array() 
                    ),
                ),
                'cws_staff_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'promosys'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'promosys'),
                        'left'  => esc_html_x('Left', 'customizer', 'promosys'),
                    ),
                    'dependency'    => array(
                        'control'   => 'cws_staff_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'cws_staff_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Slug', 'customizer', 'promosys'),
                    'default'       => 'Our Team Archive',
                ),
                'cws_staff_single_accent_background' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Single Accent Background', 'customizer', 'promosys'),
                ),
                'cws_staff_single_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Single Slug', 'customizer', 'promosys'),
                    'default'       => 'Our Team Single',
                ),
                'cws_staff_custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Header Template for Staff', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'separator'     => 'line-top',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Custom Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers
                ),
                'cws_staff_custom_sticky_header' => array(
                    'type'           => 'select',
                    'label'          => esc_html_x('Sticky Template for Staff', 'customizer', 'promosys'),
                    'default'        => 'inherit',
                    'choices'        => array(
                        'inherit'       => esc_html_x('Inherit from Sticky Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_sticky_headers
                ),
                'cws_staff_custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Footer Template for Staff', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Footer Appearance', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_footers
                ),
                'cws_staff_single_custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Header Template for Staff Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'separator'     => 'line-top',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Custom Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_headers
                ),
                'cws_staff_single_custom_sticky_header' => array(
                    'type'           => 'select',
                    'label'          => esc_html_x('Sticky Template for Staff Single', 'customizer', 'promosys'),
                    'default'        => 'inherit',
                    'choices'        => array(
                        'inherit'       => esc_html_x('Inherit from Sticky Header', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_sticky_headers
                ),
                'cws_staff_single_custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Footer Template for Staff Single', 'customizer', 'promosys'),
                    'default'       => 'inherit',
                    'choices'       => array(
                        'inherit'       => esc_html_x('Inherit from Footer Appearance', 'customizer', 'promosys'),
                        'default'       => esc_html_x('Default', 'customizer', 'promosys'),
                    ) + $custom_footers
                ),
            )
        ),
        'sidebars' => array(
            'title'     => esc_html_x('Sidebars', 'customizer', 'promosys'),
            'layout'    => array(
                'theme_sidebars' => array(
                    'type'          => 'repeater',
                    'label'         => esc_html_x('Sidebars', 'customizer', 'promosys'),
                    'add_label'     => esc_html_x('Add New', 'customizer', 'promosys'),
                    'save_label'    => esc_html_x('Apply', 'customizer', 'promosys'),
                    'default'       => $default_sidebars,
                ),
            )
        ),
        'site_layout' => array(
            'title'     => esc_html_x('Site Layout', 'customizer', 'promosys'),
            'layout'    => array(
                'sticky_sidebars' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Sticky Sidebars', 'customizer', 'promosys'),
                ),
                'boxed_layout' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Apply Boxed Layout', 'customizer', 'promosys'),
                ),
                'boxed_bg_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Content Background', 'customizer', 'promosys'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => 'body[data-boxed="true"] .site.wrap',
                        'style_to_change'   => 'background-color',
                    ),
                    'dependency'    => array(
                        'control'   => 'boxed_layout',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
            )
        ),
        'social_share' => array(
            'title'     => esc_html_x('Social Share', 'customizer', 'promosys'),
            'layout'    => array(
                'social_share_links' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Share to:', 'customizer', 'promosys'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x('None', 'customizer', 'promosys'),
                        'add.this'      => esc_html_x('Add.this', 'customizer', 'promosys'),
                        'blogger'       => esc_html_x('Blogger', 'customizer', 'promosys'),
                        'buffer'        => esc_html_x('Buffer', 'customizer', 'promosys'),
                        'diaspora'      => esc_html_x('Diaspora', 'customizer', 'promosys'),
                        'digg'          => esc_html_x('Digg', 'customizer', 'promosys'),
                        'douban'        => esc_html_x('Douban', 'customizer', 'promosys'),
                        'evernote'      => esc_html_x('Evernote', 'customizer', 'promosys'),
                        'getpocket'     => esc_html_x('Getpocket', 'customizer', 'promosys'),
                        'facebook'      => esc_html_x('Facebook', 'customizer', 'promosys'),
                        'flipboard'     => esc_html_x('Flipboard', 'customizer', 'promosys'),
                        'instapaper'    => esc_html_x('Instapaper', 'customizer', 'promosys'),
                        'line.me'       => esc_html_x('Line.me', 'customizer', 'promosys'),
                        'linkedin'      => esc_html_x('Linkedin', 'customizer', 'promosys'),
                        'livejournal'   => esc_html_x('LiveJournal', 'customizer', 'promosys'),
                        'hacker.news'   => esc_html_x('Hacker.news', 'customizer', 'promosys'),
                        'ok.ru'         => esc_html_x('Ok.ru', 'customizer', 'promosys'),
                        'pinterest'     => esc_html_x('Pinterest', 'customizer', 'promosys'),
                        'qzone'         => esc_html_x('Qzone', 'customizer', 'promosys'),
                        'reddit'        => esc_html_x('Reddit', 'customizer', 'promosys'),
                        'skype'         => esc_html_x('Skype', 'customizer', 'promosys'),
                        'tumblr'        => esc_html_x('Tumblr', 'customizer', 'promosys'),
                        'twitter'       => esc_html_x('Twitter', 'customizer', 'promosys'),
                        'vk'            => esc_html_x('Vk', 'customizer', 'promosys'),
                        'weibo'         => esc_html_x('Weibo', 'customizer', 'promosys'),
                        'xing'          => esc_html_x('Xing', 'customizer', 'promosys'),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true,
                        'size'          => 20
                    ),
                )
            )
        ),
        'sidebars' => array(
            'title'     => esc_html_x('Sidebars', 'customizer', 'promosys'),
            'layout'    => array(
                'theme_sidebars' => array(
                    'type'          => 'repeater',
                    'label'         => esc_html_x('Sidebars', 'customizer', 'promosys'),
                    'add_label'     => esc_html_x('Add New', 'customizer', 'promosys'),
                    'save_label'    => esc_html_x('Apply', 'customizer', 'promosys'),
                    'default'       => $default_sidebars,
                ),
            )
        ),
        'purchase_code' => array(
            'title'     => esc_html_x('Purchase Code', 'customizer', 'promosys'),
            'layout'    => array(
                'envato_purchase_code_promosys' => array(
                    'type'          => 'text',
                    'setting_type'  => 'option',
                    'label'         => esc_html_x('Please enter your purchase code', 'customizer', 'promosys'),
                    'default'       => '',
                ),
            )
        ),
        'help' => array(
            'title'     => esc_html_x('Help', 'customizer', 'promosys'),
            'layout'    => array(
                'documentation' => array(
                    'type'          => 'link',
                    'label'         => esc_html_x('Documentation', 'customizer', 'promosys'),
                    'default'       => 'https://'.get_option('stylesheet').'.cwsthemes.com/manual',
                    'input_attrs'   => array(
                        'icon'  => 'dashicons-welcome-widgets-menus'
                    )
                ),
                'tutorial' => array(
                    'type'      => 'link',
                    'label'     => esc_html_x('Video Tutorial', 'customizer', 'promosys'),
                    'default'   => 'https://www.youtube.com/user/cwsvideotuts/playlists',
                    'input_attrs'   => array(
                       'icon'  => 'dashicons-format-video'
                    )
                ),
            )
        )
	);
?>