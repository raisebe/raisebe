<?php
defined( 'ABSPATH' ) or die();

global $post;

$first_post_loop = get_posts( 'post_type='.get_post_type().'&numberposts=1&order=ASC' );
$first_post = $first_post_loop[0];

$last_post_loop = get_posts( 'post_type='.get_post_type().'&numberposts=1' );
$last_post = $last_post_loop[0];

$next_post = get_next_post() ? get_next_post() : $first_post;
$prev_post = get_previous_post() ? get_previous_post() : $last_post;
$post_type = get_post_type_object( get_post()->post_type );

if ( !get_next_post() && !get_previous_post() ) {
	return;
}
?>

<nav class="navigation post-navigation">
	<ul class="nav-links">
		<?php if ( is_attachment() ): ?>
			<?php previous_post_link( '<li>%link</li>', sprintf( '<span class="meta-nav">%s</span> %%title', esc_html__( 'Published In', 'promosys' ) ) ); ?>
		<?php else: ?>

			<?php if ( $prev_post ): ?>
				<li class="prev-post">
                    <div class="post-nav-link">
                        <a href="<?php echo get_permalink( $prev_post ) ?>">
                            <?php echo esc_html_x('Previous Post', 'single page', 'promosys'); ?>
                        </a>
                    </div>
                    <div class="post-nav-item">
                        <?php
                            $thumbnail = get_the_post_thumbnail_url($prev_post->ID, 'thumbnail');
                        ?>
                        <a href="<?php echo get_permalink($prev_post) ?>" class="post-nav-image">
                        <?php if ( !empty($thumbnail) && ( !class_exists('WooCommerce') || !is_product() ) ) { ?>
                            <img src="<?php echo esc_url($thumbnail) ?>" alt="<?php echo esc_attr($prev_post->post_title) ?>"/>
                        <?php } ?>
                        </a>
                        <div class="post-nav-content">
                            <div class="post-nav-text-wrapper">
                                <a href="<?php echo get_permalink( $prev_post ) ?>">
                                <?php
                                    if ( function_exists('wpm') ) {
                                        echo '<span class="post-title">'.wpm_translate_string(wp_kses_post( $prev_post->post_title )).'</span>';
                                    } else {
                                        echo '<span class="post-title">'.wp_kses_post( $prev_post->post_title ).'</span>';
                                    }
                                ?>
                                </a>
                            </div>
                            <?php if( !empty(get_the_category_list( ', ', '', $prev_post->ID )) ) : ?>
                                <div class="post-nav-cats">
                                    <?php echo get_the_category_list( ', ', '', $prev_post->ID ); ?>
                                </div>
                            <?php endif; ?>
                            <?php
                                $categories = cws_get_taxonomy_links('cws_portfolio_cat', ', ', 'frontend', $prev_post->ID);
                                if( !empty($categories) ) :
                                    ?>
                                    <div class="post-nav-cats">
                                        <?php echo sprintf('%s', $categories); ?>
                                    </div>
                                <?php endif; ?>
                        </div>
                    </div>
				</li>
			<?php else: ?>
				<li class="prev-post disabled"></li>
			<?php endif ?>
            
            <li class="archive-dots">
                <a href="<?php echo get_post_type_archive_link(get_post()->post_type) ?>"><span></span></a>
            </li>

			<?php if ( $next_post ): ?>
				<li class="next-post">
                    <div class="post-nav-link">
                        <a href="<?php echo get_permalink( $next_post ) ?>">
                            <?php echo esc_html_x('Next Post', 'single page', 'promosys'); ?>
                        </a>
                    </div>
                    <div class="post-nav-item">
                        <?php
                            $thumbnail = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
                        ?>
                        <div class="post-nav-content">
                            <div class="post-nav-text-wrapper">
                                <a href="<?php echo get_permalink( $next_post ) ?>">
                                    <?php
                                        if ( function_exists('wpm') ) {
                                            echo '<span class="post-title">'.wpm_translate_string(wp_kses_post( $next_post->post_title )).'</span>';
                                        } else {
                                            echo '<span class="post-title">'.wp_kses_post( $next_post->post_title ).'</span>';
                                        }
                                    ?>
                                </a>
                            </div>
                            <?php if( !empty(get_the_category_list( ', ', '', $next_post->ID )) ) : ?>
                                <div class="post-nav-cats">
                                    <?php echo get_the_category_list( ', ', '', $next_post->ID ); ?>
                                </div>
                            <?php endif; ?>
                            <?php
                                $categories = cws_get_taxonomy_links('cws_portfolio_cat', ', ', 'frontend', $next_post->ID);
                                if( !empty($categories) ) :
                            ?>
                                <div class="post-nav-cats">
                                    <?php echo sprintf('%s', $categories); ?>
                                </div>
                            <?php endif; ?>
                        </div>
    
                        <a href="<?php echo get_permalink( $next_post ) ?>" class="post-nav-image">
                        <?php if ( !empty($thumbnail) && ( !class_exists('WooCommerce') || !is_product() ) ) { ?>
                            <img src="<?php echo esc_url($thumbnail) ?>" alt="<?php echo esc_attr($next_post->post_title) ?>" />
                        <?php } ?>
                        </a>
                    </div>
				</li>
			<?php else: ?>
				<li class="next-post disabled"></li>
			<?php endif ?>

		<?php endif; ?>
	</ul>
</nav>