<?php defined( 'ABSPATH' ) or die(); 

if( class_exists('WooCommerce') && is_woocommerce() ){
	echo '<div class="cws-woocommerce-ext">';
		woocommerce_breadcrumb();
		echo '<div class="woocommerce-notices-wrapper">';
			wc_print_notices();
		echo '</div>';
	echo '</div>';
} else {
	ob_start();
		promosys_breadcrumbs();
	$breadcrumbs = ob_get_clean();

	if( !empty($breadcrumbs) ){
		echo '<div class="breadcrumbs-wrapper">';
			echo '<div class="container">';
				echo sprintf('%s', $breadcrumbs);
			echo '</div>';
		echo '</div>';
	}
}

?>