<?php 
	defined( 'ABSPATH' ) or die();
?>

<!-- #site-sticky -->
<div id="site-sticky" class="site-sticky<?php echo get_theme_mod('sticky_shadow') ? ' shadow' : '' ?>">
	<div class="container<?php if( get_theme_mod('sticky_wide') ) echo ' wide_container'; ?>">
        <div class="site_logotype sticky-logo">
            <a href="<?php echo esc_url(home_url( '/' )) ?>">
                <?php promosys_logo('sticky_logotype', 'sticky_logo_dimensions', 'h3') ?>
            </a>
        </div>
		<nav class="menu-main-container header_menu" itemscope="itemscope">
			<?php wp_nav_menu( promosys__main_menu_args() ) ?>
            <?php
                if( function_exists('wpm_language_switcher') && get_theme_mod('lang_switcher_sticky') ){
                    wpm_language_switcher ('dropdown', 'both');
                }
            ?>
            <?php if( get_theme_mod('sticky_icon_search') ) : ?>
                <div class="search-trigger">
                    <?php if( get_theme_mod('sticky_search_title') ) : ?>
                        <span class="title"><?php echo esc_html(get_theme_mod('sticky_search_title')); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if( class_exists('WooCommerce') && get_theme_mod('woo_cart') ) :
                $cws_woocommerce = new Promosys_WooExt();
            ?>
                <?php echo sprintf('%s', $cws_woocommerce->cws_woocommerce_get_mini_cart()) ?>
            <?php endif; ?>
		</nav>
        <div class="sticky-right-info">
            <?php if( get_theme_mod('sticky_extra_button') && !empty(get_theme_mod('sticky_extra_button_title')) ) : ?>
                <div class="extra-button">
                    <a href="<?php echo !empty(get_theme_mod('sticky_extra_button_url')) ? esc_url(get_theme_mod('sticky_extra_button_url')) : '#'; ?>" class="cws_button small simple">
                        <span><?php echo esc_html(get_theme_mod('sticky_extra_button_title')); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>
<!-- /#site-sticky -->