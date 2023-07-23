<?php
defined( 'ABSPATH' ) or die(); ?>

<?php get_header() ?>
	<?php while ( have_posts() ): the_post(); ?>

		<?php
			$department = cws_get_taxonomy_links('cws_staff_member_department', ', ');
			$position = cws_get_taxonomy_links('cws_staff_member_position', ', ');
			$experience = cws_get_metabox('staff_experience');
			$email = cws_get_metabox('staff_email');
			$phone = cws_get_metabox('staff_phone');
			$biography = cws_get_metabox('staff_biography');
			$content = promosys__the_content('-1');

			$accent_background = !empty(get_theme_mod('cws_staff_single_accent_background')) ? wp_get_attachment_image_url(get_theme_mod('cws_staff_single_accent_background'), 'full') : '';
			$accent_background = !empty($accent_background) ? " style='background-image: url(".esc_url($accent_background).");'" : '';
		?>

		<div class="main_member_info" <?php echo sprintf('%s', $accent_background); ?>>
			<div class="image-wrapper">
				<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
			</div>
			<div class="text-information">
				<h2 class="name"><?php the_title() ?></h2>
                
                <div class="divider">
                    <div class="divider-inner"></div>
                </div>

				<?php if( !empty($position) ) : ?>
					<div class="pos">
						<?php echo sprintf('%s', $position); ?>
					</div>
				<?php endif; ?>

				<?php if( !empty($department) ) : ?>
					<div class="dep">
						<?php echo sprintf('%s', $department); ?>
					</div>
				<?php endif; ?>
                
                <?php if( !empty($experience) || !empty($email) || !empty($phone) ) : ?>
                    <div class="info">
                        <?php if( !empty($experience) ) : ?>
                            <div class="experience">
                                <span class="label">
                                    <?php echo esc_html_x('Experience:', 'frontend', 'promosys') ?>
                                </span>
                                <?php echo esc_html($experience) ?>
                            </div>
                        <?php endif; ?>
                        <?php if( !empty($email) ) : ?>
                            <div class="email">
                                <a href="mailto:<?php echo esc_attr($email) ?>">
                                    <?php echo esc_html($email) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if( !empty($phone) ) : ?>
                            <div class="phone">
                                <a href="tel:<?php echo esc_attr($phone) ?>">
                                    <?php echo esc_html($phone) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="social-icons-wrapper">
                    <div class="label"><?php echo esc_html_x('Contact ', 'frontend', 'promosys') . get_the_title() . esc_html_x(':', 'frontend', 'promosys'); ?></div>
                    <ul class="social-icons">
                        
                        <?php
                            $socials = (array)json_decode(cws_get_metabox('staff_socials'));
                            foreach( $socials as $key => $value ){
                                $value = (array)$value;
                                echo '<li>';
                                    echo '<a href="'.$value['social_url'].'" title="'.$value['social_title'].'" target="_blank">';
                                        echo '<i class="cwsicon-'.$value['social_icon'].'"></i>';
                                    echo '</a>';
                                echo '</li>';
                            }
                        ?>
                    </ul>
                </div>
			</div>
		</div>

		<?php if( !empty($biography) ) : ?>
			<div class="secondary_member_info">
                <div class="cws_textmodule with_divider align_left">
                    <div class="cws_textmodule_info_wrapper">
                        <h5 class="cws_textmodule_title">
                            <span class="cws_textmodule_title_text">
                                <?php echo esc_html_x('Biography', 'frontend', 'promosys') ?>
                            </span>
                        </h5>
                    </div>
                </div>
				<?php echo esc_html($biography) ?>
			</div>
		<?php endif; ?>

		<?php if( !empty($content) ) : ?>
			<div class="secondary_member_info">
                <div class="cws_textmodule with_divider align_left">
                    <div class="cws_textmodule_info_wrapper">
                        <h5 class="cws_textmodule_title">
                            <span class="cws_textmodule_title_text">
                                <?php echo esc_html_x('Personal Information', 'frontend', 'promosys') ?>
                            </span>
                        </h5>
                    </div>
                </div>
				<?php echo sprintf('%s', $content) ?>
			</div>
		<?php endif; ?>

	<?php endwhile ?>
<?php get_footer() ?>
