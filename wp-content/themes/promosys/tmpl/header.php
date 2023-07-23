<?php 
    defined( 'ABSPATH' ) or die();
?>

<?php
    $header_classes = get_theme_mod('header_svg_mask') ? ' masked' : '';
    $header_classes .= get_theme_mod('header_over_slider') && !empty( cws_get_metabox('slider_shortcode') ) ? ' header_over_slider' : '';
    $header_img = !empty(cws_get_metabox('title_image')) ? cws_get_metabox('title_image') : get_theme_mod('header_bg_image') ;
    
    $header_extra_styles = ' style="';
    $header_extra_styles .= get_theme_mod('header_bg_type') == 'custom_gradient' && !empty(get_theme_mod('header_bg_gradient_style')) ? esc_attr(get_theme_mod('header_bg_gradient_style')) : '';
    $header_extra_styles .= get_theme_mod('header_bg_type') == 'image' && !empty($header_img) ? 'background-image: url('.wp_get_attachment_image_src( $header_img, "full" )[0].');' : '';
    $header_extra_styles .= '"';
?>

	<div id="site-header" class="site-header<?php echo esc_attr($header_classes); ?>">
        <div class="header-bg"<?php echo sprintf('%s', $header_extra_styles); ?>></div>
        <div class="site-header-overlay"></div>
		<div class="header-content">
			<!-- Start Top Bar Box -->
			<?php 
				if( 
					!empty(get_theme_mod('top_bar_number')) || 
					!empty(get_theme_mod('top_bar_email')) || 
					!empty(get_theme_mod('top_bar_address'))
				) :
			?>
			<div class="top-bar-box">
				<div class="container <?php if( get_theme_mod('top_bar_wide') ) echo 'wide_container'; ?>">
					<div class="header_info_links">
						<?php if( !empty(get_theme_mod('top_bar_number')) ) : ?>
							<a class="top_bar_phone" href="tel:<?php echo esc_attr(get_theme_mod('top_bar_number')) ?>"><?php echo esc_html(get_theme_mod('top_bar_number')) ?></a>
						<?php 
							endif; 
							if( !empty(get_theme_mod('top_bar_email')) ) :
						?>
							<a class="top_bar_mail" href="mailto:<?php echo esc_attr(get_theme_mod('top_bar_email')) ?>"><?php echo esc_html(get_theme_mod('top_bar_email')) ?></a>
						<?php 
							endif;
						?>
					</div>
					<div class="header_icons">
						<?php get_template_part( 'tmpl/header-icons' ); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<!-- Start Menu Box -->
			<div class="menu-box">
				<div class="container <?php if( get_theme_mod('menu_wide') ) echo 'wide_container'; ?>">
					<div class="site_logotype">
						<a href="<?php echo esc_url(home_url( '/' )) ?>">
							<?php promosys_logo('logotype', 'logo_dimensions') ?>
						</a>
					</div>
     
					<nav class="menu-main-container header_menu" itemscope="itemscope">
						<?php wp_nav_menu( promosys__main_menu_args() ) ?>
                        
                        <?php
                            if( function_exists('wpm_language_switcher') && get_theme_mod('lang_switcher_header') ){
                                wpm_language_switcher ('dropdown', 'both');
                            }
                        ?>
                        <?php if( get_theme_mod('menu_icon_search') ) : ?>
                            <div class="search-trigger">
                                <?php if( get_theme_mod('menu_search_title') ) : ?>
                                    <span class="title"><?php echo esc_html(get_theme_mod('menu_search_title')); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if( class_exists('WooCommerce') && get_theme_mod('woo_cart') ) :
                            $cws_woocommerce = new Promosys_WooExt();
                        ?>
                            <?php echo sprintf('%s', $cws_woocommerce->cws_woocommerce_get_mini_cart()) ?>
                        <?php endif; ?>
					</nav>
     
					<div class="menu-right-info">
                        <?php if( get_theme_mod('menu_extra_button') && !empty(get_theme_mod('menu_extra_button_title')) ) : ?>
                            <div class="extra-button">
                               <a href="<?php echo !empty(get_theme_mod('menu_extra_button_url')) ? esc_url(get_theme_mod('menu_extra_button_url')) : '#'; ?>" class="cws_button small simple">
                                   <span><?php echo esc_html(get_theme_mod('menu_extra_button_title')); ?></span>
                               </a>
                            </div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
			<?php if( ( PROMOSYS__ACTIVE && !is_front_page() && cws_get_metabox('title_area_remove') != 'on' ) || ( !PROMOSYS__ACTIVE ) ) : ?>
				<?php
                    if ( cws_get_metabox('title_bg_type') == 'image' ) {
                        $title_img = !empty(cws_get_metabox('title_image')) ? cws_get_metabox('title_image') : get_theme_mod('title_area_bg');
                    } else {
                        $title_img = '';
                    }
					
					$title_extra_classes = get_theme_mod('title_mouse_animation') ? ' mouse_anim' : '';
					$title_extra_classes .= get_theme_mod('title_scroll_animation') ? ' scroll_anim' : '';

					$title_extra_styles = '';
					$title_extra_styles .= !empty(get_theme_mod('title_custom_gradient_css')) ? esc_attr(get_theme_mod('title_custom_gradient_css')) : '';
					$title_extra_styles .= !empty($title_img) ? 'background-image: url('.wp_get_attachment_image_src( $title_img, "full" )[0].');' : '';

					$title_hide = is_array(get_theme_mod('title_fields_hide')) ? implode(',', get_theme_mod('title_fields_hide')) : '';
				?>
				<?php if( empty(cws_get_metabox('slider_shortcode')) ): ?>
					<div class="page_title_container<?php echo esc_attr($title_extra_classes); ?>" <?php echo (!empty($title_extra_styles) ? ' style="' . esc_attr($title_extra_styles) . '"' : ''); ?>>
                        <div class="page_title_overlay"></div>
						<div class="page_title_wrapper container">
							<?php if( strripos($title_hide, 'title') === false ) : ?>
								<div class="page_title_customizer_size">
									<h1 class="page_title">
										<?php echo cws_get_page_title() ?>
									</h1>
								</div>
							<?php endif; ?>
                            <?php if( is_single() && get_post_type() == 'post' && strripos($title_hide, 'meta') === false ) : ?>
                                <div class="single_post_meta">
                                    <?php
                                        promosys__post_date('', 'simple');
                                    ?>
                                </div>
                            <?php endif; ?>
							<?php if( strripos($title_hide, 'divider') === false ) : ?>
								<span class="title_divider">
                                    <svg width="48" height="10" viewBox="0 0 48 10" fill="#000" xmlns="http://www.w3.org/2000/svg">
<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>
</svg>
                                </span>
							<?php endif; ?>
                            <?php
                                if( strripos($title_hide, 'breadcrumbs') === false ){
                                    get_template_part( 'tmpl/header-breadcrumbs' );
                                }
                            ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<!-- /.site-header-inner -->
	</div>
	<!-- /.site-header -->