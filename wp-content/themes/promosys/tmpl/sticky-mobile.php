<?php 
defined( 'ABSPATH' ) or die(); ?>

<!-- #site-sticky-mobile -->
<div id="site-sticky-mobile" class="site-sticky sticky-mobile<?php echo get_theme_mod('sticky_shadow') ? ' shadow' : '' ?>">
	<div class="container">
		<a class="site_logotype" href="<?php echo esc_url(home_url( '/' )) ?>">
			<?php promosys_logo('sticky_logotype', 'mobile_top_bar_logo_dimensions', 'h3') ?>
		</a>
		<div class="header_icons">
			<?php if( class_exists('WooCommerce') && get_theme_mod('mobile_show_minicart') ) :
				$cws_woocommerce = new Promosys_WooExt();
				echo sprintf('%s', $cws_woocommerce->cws_woocommerce_get_mini_cart());
			endif; ?>
			<div class="menu-trigger">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
</div>
<!-- \#site-sticky-mobile -->