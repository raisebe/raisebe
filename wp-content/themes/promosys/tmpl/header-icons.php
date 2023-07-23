<?php defined( 'ABSPATH' ) or die(); ?>

<!-- Top Bar Address Place -->
<?php
    if( !empty(get_theme_mod('top_bar_address')) ) : ?>
    <span class="top_bar_address"><?php echo esc_html(get_theme_mod('top_bar_address')) ?></span>
<?php endif; ?>

<!-- Call Sidebar Icon Place -->
<?php if( get_theme_mod('icon_custom_sb') ) : ?>
    <a href="#" class="custom_sidebar_trigger" data-sidebar="<?php echo esc_attr(get_theme_mod('custom_sidebar')); ?>">
        <span class="icon_sidebar_trigger">
            <span class="hamburger"></span>
        </span>
        <span class="hidden_title"></span>
    </a>
<?php endif; ?>