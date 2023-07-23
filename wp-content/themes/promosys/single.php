<?php
defined( 'ABSPATH' ) or die();

?>
	<?php get_header() ?>
		<?php if ( have_posts() ): ?>
			<div class="single_content">
				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part( 'tmpl/post/content', 'single' ) ?>
				<?php endwhile ?>

				<?php get_template_part( 'tmpl/post/content-navigator' ) ?>
                
                <?php if( !empty(get_the_author_meta( 'description' )) ) : ?>
                    <div class="author-information">
                        <div class="author-image">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' ); ?>
                        </div>
                        <div class="author-content">
                            <?php
                                global $post;
                                $post_author_name = get_the_author_meta( 'display_name', $post->post_author );
                                if ( empty( $post_author_name ) ) {
                                    $post_author_name = get_the_author_meta('nickname', $post->post_author);
                                }
                                echo sprintf('<h6 class="author-name">%s</h6>', $post_author_name);
                            ?>
                            <p class="author-biography">
                                <?php echo get_the_author_meta( 'description' ); ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

				<?php promosys__related_posts() ?>

				<?php promosys__comments_list() ?>
			</div>
			
		<?php endif ?>
	<?php get_footer() ?>
