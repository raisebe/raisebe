<?php
defined( 'ABSPATH' ) or die();

?>

	<?php get_header() ?>

    <?php if( !empty(get_the_author_meta( 'description' )) ) : ?>
        <div class="author-information">
            <div class="author-image">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 170 ); ?>
            </div>
            <div class="author-content">
                <h2 class="author-name">
                    <?php echo get_the_author_meta( 'display_name' ); ?>
                </h2>
                <p class="author-biography">
                    <?php echo get_the_author_meta( 'description' ); ?>
                </p>
                <?php if ( !empty(get_the_author_meta( 'url' )) ) { ?>
                    <p class="author-site">
                        <?php
                        $url_text = str_replace('https://', '', get_the_author_meta( 'url' ));
                        $url_text = str_replace('http://', '', $url_text);
                        $url_text = str_replace('//','', $url_text);
                        echo esc_html_x('You can find all of his/her works at ', 'frontend', 'promosys') .
                            '<a href="'.esc_url(get_the_author_meta( 'url' )).'">'.esc_html($url_text).'</a>';
                        ?>
                    </p>
                <?php } ?>
                <div class="author-meta">
                    <?php if ( get_the_author_posts() > 0 ) {
                        echo '<div class="author-meta-item">';
                        echo get_the_author_posts() . (get_the_author_posts() == 1 ? esc_html_x(' post', 'frontend', 'promosys') : esc_html_x(' posts', 'frontend', 'promosys'));
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

		<?php if ( have_posts() ): ?>
            <div class="cws_textmodule with_divider align_left">
                <div class="cws_textmodule_info_wrapper">
                    <h4 class="cws_textmodule_title single-content-title">
                        <span class="cws_textmodule_divider divider-left"></span>
                        <span class="cws_textmodule_title_text">
                                <?php echo esc_html_x( 'Latest posts', 'frontend', 'promosys' ) ?>
                            </span>
                        <span class="cws_textmodule_divider divider-right"></span>
                    </h4>
                </div>
            </div>
			<?php
				if( get_theme_mod('blog_view') == 'large' ){
					get_template_part( 'tmpl/post/loop-large' );
				} else {
					get_template_part( 'tmpl/post/loop-grid' );
				}
			?>
		<?php else: ?>
			<div class="content">
                <p<?php echo esc_html_x('No posts by this author.', 'frontend', 'promosys'); ?>></p>
			</div>
		<?php endif ?>

	<?php get_footer(); ?>
