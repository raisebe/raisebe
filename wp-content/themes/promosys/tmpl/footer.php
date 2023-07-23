<?php 
	defined( 'ABSPATH' ) or die();
    
    $footer_extra_styles = ' style="';
    $footer_extra_styles .= get_theme_mod('footer_bg_type') == 'custom_gradient' && !empty(get_theme_mod('footer_bg_gradient_style')) ? esc_attr(get_theme_mod('footer_bg_gradient_style')) : '';
    $footer_extra_styles .= '"';
?>

<!-- #site-footer -->
<div id="site-footer" class="site-footer<?php echo get_theme_mod("sticky_footer") ? " sticky_footer" : "" ?>"<?php echo sprintf('%s', $footer_extra_styles); ?>>
	<div class="container">
		<div class="footer-copyright">
            <div class="footer_logotype">
                <a class="footer-logo" href="<?php echo esc_url( home_url('') ) ?>">
                    <?php promosys_logo('footer_logotype', 'footer_logo_dimensions', 'h3') ?>
                </a>
            </div>
			<div class="copyright-info">
                <?php echo !empty(get_theme_mod('copyright_text')) ? '<p>' . esc_attr(get_theme_mod('copyright_text')) . '</p>' : ''; ?>
                <!-- Language Selector Place -->
                <?php
                    if( function_exists('wpm_language_switcher') && get_theme_mod('lang_switcher_footer') ){
                        wpm_language_switcher ('list', 'both');
                    }
                ?>
            </div>
		</div>
	</div>
</div>
<!-- /#site-footer -->