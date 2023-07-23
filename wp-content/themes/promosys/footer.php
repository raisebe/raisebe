<?php
defined( 'ABSPATH' ) or die();
?>	

						</div>
						<!-- /.main-content-inner-wrap -->
					</div>
					<!-- /.main-content-inner -->
				<?php 
					if( class_exists('WooCommerce') && (is_shop() || is_product()) ){
						echo '</div>';
					} else {
						echo '</main>';
					}
				?>
				<!-- /.main-content -->		
			</div>
			<!-- /.site-content -->

			<?php
				if( has_action('cws_custom_footer') && !empty( get_post_meta(get_the_id(), 'cwshf_mb_post', true)['footer'] ) ){
					do_action('cws_custom_footer');
				} else {
					if( function_exists('cws_hf_init') ){
						switch( cws_get_post_type() ){
							case 'woo_single' :
								cws_print_template( 'woo_single_custom_footer', 'footer' );
								break;
							case 'woo_archive' :
								cws_print_template( 'woo_custom_footer', 'footer' );
								break;
                            case 'blog_single' :
                                cws_print_template( 'blog_single_custom_footer', 'footer' );
                                break;
							case 'staff_single' :
								cws_print_template( 'cws_staff_single_custom_footer', 'footer' );
								break;
							case 'staff_archive' :
								cws_print_template( 'cws_staff_custom_footer', 'footer' );
								break;
							case 'portfolio_single' :
								cws_print_template( 'cws_portfolio_single_custom_footer', 'footer' );
								break;
							case 'portfolio_archive' :
								cws_print_template( 'cws_portfolio_custom_footer', 'footer' );
								break;
							default :
								if( get_theme_mod('custom_footer') != 'default' ){
									cws_print_template( 'custom_footer', 'footer' );
								} else {
									get_template_part( 'tmpl/footer' );
								}
								break;
						}
					} else {
						get_template_part( 'tmpl/footer' );
					}
				}
			?>

			<div class="ajax_preloader body_loader">
				<div class="dots-wrapper">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="button-up"></div>
		</div>
		<!-- /.site-wrapper -->

		<div id="frame">
			<span class="frame_top"></span>
			<span class="frame_right"></span>
			<span class="frame_bottom"></span>
			<span class="frame_left"></span>
		</div>
		
		<?php wp_footer() ?>
	</body>
</html>