<?php
defined( 'ABSPATH' ) or die();
?>

	<div id="post-<?php the_ID() ?>" <?php post_class( 'post' ) ?>>
		<div class="post-inner">
			<div class="post-header">
				<?php promosys__post_title() ?>
			</div>

			<?php echo promosys__post_featured() ?>

			<div class="post-content">
				<?php
					echo promosys__the_content(get_theme_mod('blog_chars_count'));
				?>

				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ): ?>
					<span class="post-comments">
						<?php comments_popup_link( esc_html__( '0', 'promosys' ), esc_html__( '1', 'promosys' ), esc_html__( '%', 'promosys' ) ); ?>
					</span>
				<?php endif ?>
			</div>
			
		</div>
	</div>
