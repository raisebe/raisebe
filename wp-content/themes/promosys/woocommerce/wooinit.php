<?php

class Promosys_WooExt{

	public function __construct( $args = array() ){

		$this->def_args = array(
			'shop_catalog_image_size' 		=> array(),
			'shop_single_image_size'		=> array(),
			'shop_thumbnail_image_size'		=> array(),
			'shop_thumbnail_image_spacings'	=> array(),
			'shop_single_image_spacings'	=> array()
		);

		$this->args = wp_parse_args( $args, $this->def_args );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'woocommerce', $this->custom_image_sizes() );

		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_action( 'woocommerce_init', array( $this, 'woo_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_cws_ajax_add_to_cart', array( $this, 'ajax_add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_cws_ajax_add_to_cart', array( $this, 'ajax_add_to_cart' ) );

		add_filter('loop_shop_columns', array( $this, 'products_per_row'), 20 );
		add_filter('loop_shop_per_page', array( $this, 'products_per_page'), 20 );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'cws_related_products' ), 40 );
		add_filter( 'wc_add_to_cart_message_html', '__return_false' );
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ), 30, 1 );
		add_filter( 'woocommerce_paypal_icon', array( $this, 'my_new_paypal_icon' ) );
        
        add_action( 'customize_register', array( $this, 'remove_woo_gatalog_columns' ) );

		// Fix paypal broken button
		if( class_exists('WC_Gateway_PPEC_Plugin') ){
			add_filter( 'woocommerce_paypal_express_checkout_button_img_url' , array( $this, 'custom_paypal_image') );
		}

	}
	public function woo_init(){

        // Display 'Free' instead of zero price
        add_filter( 'woocommerce_get_price_html', array( $this, 'woocommerce_template_loop_display_free_price' ), 100, 2 );

        // Remove WooCommerce breadcrumbs
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
        
        // Price wrapper
        add_filter( 'woocommerce_get_price_html', array( $this, 'woocommerce_template_price_wrapper' ), 100, 2 );
        
        // WooCommerce Store Notice
        remove_action( 'wp_footer', 'woocommerce_demo_store' );
        add_action( 'wp_head', 'woocommerce_demo_store' );


		/* -----> Products loop hooks <----- */

		// Add wrapper to archive sort & results & grid-list
		add_action( 'woocommerce_before_shop_loop', array( $this, 'archive_info_open' ), 5 );
		add_action( 'woocommerce_before_shop_loop', array( $this, 'archive_info_close' ), 90 );

		// Customize product tags
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'cws_tags_wrapper_open' ), 1 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'cws_new_tags' ), 3 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'cws_tags_wrapper_close' ), 4 );

		// Replace opening <a> to <div> tag
        // Product
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'cws_template_loop_product_link_open' ), 10 );
		// Category
        remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
		add_action( 'woocommerce_before_subcategory', array( $this, 'cws_template_loop_product_link_open' ), 10 );

		// Replace closing </a> to </div> tag
        // Product
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'cws_template_loop_product_link_close' ), 20 );
        // Category
        remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 5 );
		add_action( 'woocommerce_before_subcategory_title', array( $this, 'cws_template_loop_product_link_close' ), 20 );

		// Create Information Wrapper
        // Product
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'cws_template_loop_product_info_open' ), 25 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'cws_template_loop_product_info_close' ), 25 );
		// Category
        add_action( 'woocommerce_before_subcategory_title', array( $this, 'cws_template_loop_product_info_open' ), 25 );
        add_action( 'woocommerce_after_subcategory', array( $this, 'cws_template_loop_product_info_close' ), 25 );

		// Transfer Title under image wrapper and add link to title
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'cws_template_loop_product_title' ), 30 );

		// Add link to category title
        remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
        add_action( 'woocommerce_shop_loop_subcategory_title', array( $this, 'cws_template_loop_category_title' ), 10 );

		// Add self <a> tag to the image
        // Product
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'product_link_open' ), 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );
		// Category
        add_action( 'woocommerce_before_subcategory_title', array( $this, 'product_link_open' ), 9 );
        add_action( 'woocommerce_before_subcategory_title', 'woocommerce_template_loop_product_link_close', 11 );

		// Move and add wrapper to rating
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_rating_open' ), 5 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 6 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_rating_close' ), 7 );

		// Move and add wrapper to 'Add to cart' button
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        add_action( 'woocommerce_after_shop_loop_item', array( $this, 'woocommerce_template_loop_add_to_cart_open' ), 30 );
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 32 );
        add_action( 'woocommerce_after_shop_loop_item', array( $this,'woocommerce_template_loop_add_to_cart_close' ), 34 );



		/* -----> Single product hooks <----- */

        // Remove product sidebar
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

		// Add wrapper for gallery & summary
		add_action( 'woocommerce_before_single_product_summary', array( $this, 'cws_product_gallery_summary_wrapper_open' ), 5 );
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'cws_product_gallery_summary_wrapper_close' ), 5 );

		// Customize product tags
		add_action( 'woocommerce_product_before_gallery', array( $this, 'cws_tags_wrapper_open' ), 5 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'woocommerce_product_before_gallery', array( $this, 'cws_new_tags' ), 6 );
		add_action( 'woocommerce_product_before_gallery', array( $this, 'cws_tags_wrapper_close' ), 7 );

		// Remove product meta
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

        // Add product categories
        add_action( 'woocommerce_single_product_summary', array( $this, 'cws_categories' ), 6 );

		// Customize product rating
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        add_action( 'woocommerce_single_product_summary', array( $this, 'woocommerce_template_custom_single_rating' ), 7 );

        // Customize related products and up-sells
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        add_action( 'woocommerce_after_single_product_summary', array( $this, 'cws_upsell_display' ), 15 );
        add_action( 'woocommerce_after_single_product_summary', array( $this, 'cws_output_related_products' ), 20 );

        // Customize reviews
        remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
        remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
        remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );

        add_action( 'woocommerce_review_before', array( $this, 'cws_review_display_gravatar' ), 10 );
        add_action( 'woocommerce_review_meta', array( $this, 'cws_review_display_meta' ), 10 );
        add_action( 'woocommerce_review_meta', 'woocommerce_review_display_rating', 12 );
        add_action( 'woocommerce_review_before_comment_meta', array( $this, 'cws_review_header_wrapper_open' ), 5 );
        add_action( 'woocommerce_review_meta', array( $this, 'cws_review_header_wrapper_close' ), 15 );

        add_filter( 'woocommerce_product_review_comment_form_args', array( $this, 'cws_product_review_form_args' ) );
        add_filter( 'comment_form_fields', array( $this, 'cws_product_review_form_fields' ) );
        add_filter( 'comment_form_fields', array( $this, 'cws_remove_comment_form_cookies_field' ) );



		/* -----> Ajax hooks <----- */
		add_action( 'wp_ajax_cws_woo_load_more', array( $this, 'cws_woo_load_more_ajax' ) );
		add_action( 'wp_ajax_nopriv_cws_woo_load_more', array( $this, 'cws_woo_load_more_ajax' ) );



		/* -----> Mini Cart hooks <----- */

		// Add wrapper to minicart
		add_action( 'woocommerce_before_mini_cart', array( $this, 'minicart_wrapper_open' ) );
		add_action( 'woocommerce_after_mini_cart', array( $this, 'minicart_wrapper_close' ) );



		/* -----> Cart hooks <----- */

		// Move cart totals from collaterals into woocommerce_after_cart_contents
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'woocommerce_after_cart_table', 'woocommerce_cart_totals', 10 );
	}

	/* -----> Construct functions <----- */
    public function remove_woo_gatalog_columns($wp_customize) {
        $wp_customize->remove_control('woocommerce_catalog_columns');
    }
	public function custom_paypal_image(){
		return 'https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-small.png';
	}
	public function custom_image_sizes(){
		return array(
			'thumbnail_image_width' => 570,
		);
	}
	public function enqueue_style(){
		wp_enqueue_style( 'woo-styles', get_template_directory_uri() . '/woocommerce/assets/css/woocommerce.css', array(), PROMOSYS__VERSION, 'all' );
		if( is_rtl() ){
			wp_enqueue_style( 'woo-rtl-styles', get_template_directory_uri() . '/woocommerce/assets/css/woocommerce-rtl.css', array(), PROMOSYS__VERSION, 'all' );
		}
	}
	public function enqueue_scripts(){
		global $wp_query;

		wp_enqueue_script( 'woo-scripts', get_template_directory_uri() . '/woocommerce/assets/js/woo.js', array( 'slick-slider', 'magnific-popup', 'waypoints', 'counterup' ), PROMOSYS__VERSION, 'all' );

		wp_localize_script( 'woo-scripts', 'woo_script_load_more_params', array(
			'posts' => json_encode( $wp_query->query_vars ),
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages
		) );
	}
	public function theme_supports(){
		add_theme_support( 'wc-product-gallery-zoom' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );
	}
	public function ajax_add_to_cart() {
		WC_AJAX::get_refreshed_fragments();
		wp_die();
    }
    public function header_add_to_cart_fragment( $fragments ) {
		ob_start();
			?>
				<i class='woo_mini-count'><?php echo '<span>'. WC()->cart->cart_contents_count .'</span>' ?></i>
			<?php
		$fragments['.woo_mini-count'] = ob_get_clean();

		ob_start();
			woocommerce_mini_cart();
		$fragments['div.woo_mini_cart'] = ob_get_clean();
		return $fragments;
	}
    public function products_per_row(){
		if( get_theme_mod('woo_archive_cols') ){
			$cols = (int)get_theme_mod('woo_archive_cols');
		} else {
			$cols = 3;
		}
	  return $cols;
	}
	public function products_per_page(){
		if( get_theme_mod('woo_archive_count') ){
			$cols = (int)get_theme_mod('woo_archive_count');
		} else {
			$cols = 9;
		}
	  return $cols;
	}
	public function cws_related_products( $args ) {
		$args['posts_per_page'] = get_theme_mod('woo_related_count') ? get_theme_mod('woo_related_count') : 3;

		return $args;
	}
	public function my_new_paypal_icon() {
		return get_template_directory_uri() . '/woocommerce/assets/img/paypal-logo.png';
	}

	/* -----> Products loop functions <----- */
	public function archive_info_open(){
		echo '<div class="shop_top_info_wrapper">';
	}
	public function archive_info_close(){
		echo '</div>';
	}
	public function cws_tags_wrapper_open(){
		echo '<div class="cws_tags_wrapper">';
	}
	public function cws_tags_wrapper_close(){
		echo '</div>';
	}
	public function woocommerce_template_loop_rating_open(){
		echo '<div class="cws_rating_wrapper">';
	}
	public function woocommerce_template_loop_rating_close(){
		echo '</div>';
	}
	public function woocommerce_template_loop_add_to_cart_open(){
        echo '<div class="cws_buttons_wrapper">';
    }
	public function woocommerce_template_loop_add_to_cart_close(){
        echo '</div>';
    }
    public function woocommerce_template_loop_display_free_price( $price, $product ) {
        if ( '' === $product->get_price() || 0 == $product->get_price() ) {
            $price = '<span class="woocommerce-Price-amount amount free">'.esc_html_x('Free', 'frontend', 'promosys').'</span>';
        }
        return $price;
    }
    public function woocommerce_template_price_wrapper( $price ) {
        $price = sprintf('<span class="cws-price-wrapper">%s</span>', $price);
        return $price;
    }
	public function cws_new_tags(){
		global $product;

		// Sale tag
		if( $product->is_on_sale() ){

			$default = esc_html_x('Sale!', 'Product tag', 'promosys');
			$regular = get_post_meta( $product->get_id(), '_regular_price', true);
			$sale = get_post_meta( $product->get_id(), '_sale_price', true);

			if( !empty($regular) && !empty($sale) ){
				$percent = 100 - ($sale * 100 / $regular);
				$text = '-'.(int)$percent.'%';
			} else {
				$text = $default;
			}

			echo '<span class="onsale" data-default="'.$default.'">'.$text.'</span>';
		}

		// HOT tag
		if( $product->is_featured() ){
			echo '<span class="cws_featured_product">'.esc_html_x("Hot", "Product tag", "promosys").'</span>';
		}

		// FREE tag
        if( '' === $product->get_price() || 0 == $product->get_price() ) {
            echo '<span class="cws_free_product">'.esc_html_x("Free", "Product tag", "promosys").'</span>';
        }

		// NEW tag
		$postdate      = get_the_time( 'Y-m-d' );
		$postdatestamp = strtotime( $postdate );
		$newness       = get_theme_mod( 'woo_tag_lifetime' ) ? get_theme_mod( 'woo_tag_lifetime' ) : 14;
		if( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ){
			echo '<span class="cws_new_product">' . esc_html_x( 'New', 'Product tag', 'promosys' ) . '</span>';
		}
	}
	public function woocommerce_template_custom_single_rating(){
        global $product;
        if ( post_type_supports( 'product', 'comments' ) && wc_review_ratings_enabled() ) {
            $rating_count = $product->get_rating_count();
            $review_count = $product->get_review_count();
            $average      = $product->get_average_rating();
            if ( $rating_count > 0 ) {
                echo '<div class="woocommerce-product-rating">';
                    echo wc_get_rating_html( $average, $rating_count );
                    if ( comments_open() ) { ?>
			            <a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                            <?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'promosys' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>
                        </a>
                    <?php }
                echo '</div>';
            }
        }
    }
    public function cws_categories(){
        global $product;
        echo '<div class="product_categories">';
            echo wc_get_product_category_list( $product->get_id(), ', ', _n('Category: ', 'Categories: ', count($product->get_category_ids()), 'promosys' ), '');
        echo '</div>';
    }
	public function product_link_open(){
		global $product;
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

		echo '<a href="' . esc_url( $link ) . '" class="product_link">';
	}
	public function cws_template_loop_product_link_open() {
		echo '<div class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
	}
	public function cws_template_loop_product_link_close() {
		echo '</div>';
	}
	public function cws_template_loop_product_info_open() {
		echo '<div class="woocommerce-information-wrapper">';
	}
	public function cws_template_loop_product_info_close() {
		echo '</div>';
	}
	public function cws_template_loop_product_title() {
        global $product;
        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

        echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . esc_url( $link ) . '">' . get_the_title() . '</a></h2>';
    }
    public function cws_template_loop_category_title($category) {
        global $product;
        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

        echo '<h2 class="woocommerce-loop-category__title">';
            echo '<a href="' . esc_url( $link ) . '">';
                echo esc_html( $category->name );
            echo '</a>';
            if ( $category->count > 0 ) {
                echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $category->count ) . ')</mark>', $category );
            }
        echo '</h2>';
    }

	/* -----> Single product functions <----- */
	public function cws_product_gallery_summary_wrapper_open(){
		echo '<div class="cws_gallery_summary_wrapper">';
	}
	public function cws_product_gallery_summary_wrapper_close(){
		echo '</div>';
	}
	public function cws_upsell_display( $limit = '-1', $columns = 4, $orderby = 'rand', $order = 'desc' ){
        global $product;
        if ( $product ) {
            $args = apply_filters(
                'woocommerce_upsell_display_args',
                array(
                    'posts_per_page' => $limit,
                    'orderby'        => $orderby,
                    'columns'        => $columns,
                )
            );
            wc_set_loop_prop( 'name', 'up-sells' );
            wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );
            $orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
            $limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
            $upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
            $upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

            if ( $upsells ) {
                echo '<section class="up-sells upsells products">';
                    echo '<div class="cws_textmodule">';
                        echo '<div class="cws_textmodule_info_wrapper">';
                            echo '<h5 class="cws_textmodule_title">';
                                echo '<span class="cws_textmodule_title_text">';
                                    echo esc_html_x( 'You may also like', 'frontend', 'promosys' );
                                echo '</span>';
                            echo '</h2>';
                        echo '</div>';
                    echo '</div>';
                woocommerce_product_loop_start();
                foreach ( $upsells as $upsell ) {
                    $post_object = get_post( $upsell->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    wc_get_template_part( 'content', 'product' );
                }
                woocommerce_product_loop_end();
                echo '</section>';
            }
            wp_reset_postdata();
        }
    }
	public function cws_output_related_products(){
        $args = array(
            'posts_per_page' => 4,
            'columns'        => 4,
            'orderby'        => 'rand',
        );
        global $product;
        if ( $product ) {
            $defaults = array(
                'posts_per_page' => 2,
                'columns'        => 2,
                'orderby'        => 'rand',
                'order'          => 'desc',
            );
            $args = wp_parse_args( $args, $defaults );
            $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
            $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
            wc_set_loop_prop( 'name', 'related' );
            wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );

            if ( $args['related_products'] ) {
                echo '<section class="related products">';
                    echo '<div class="cws_textmodule">';
                        echo '<div class="cws_textmodule_info_wrapper">';
                            echo '<h5 class="cws_textmodule_title">';
                                echo '<span class="cws_textmodule_title_text">';
                                    echo esc_html_x( 'Related products', 'frontend', 'promosys' );
                                echo '</span>';
                            echo '</h5>';
                        echo '</div>';
                    echo '</div>';
                    woocommerce_product_loop_start();
                    foreach ( $args['related_products'] as $related_product ) {
                        $post_object = get_post( $related_product->get_id() );
                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        wc_get_template_part( 'content', 'product' );
                    }
                    woocommerce_product_loop_end();
                echo '</section>';
            }
            wp_reset_postdata();
        }
    }
    public function cws_review_display_meta() {
        global $comment;
        $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
        if ( '0' === $comment->comment_approved ) {
            echo '<p class="meta">';
                echo '<em class="woocommerce-review__awaiting-approval">';
                    echo esc_html_x( 'Your review is awaiting approval', 'frontend', 'promosys' );
                echo '</em>';
            echo '</p>';
        } else {
            echo '<p class="meta">';
                echo '<strong class="meta-item woocommerce-review__author">';
                    comment_author();
                echo '</strong>';
                if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                    echo '<em class="meta-item woocommerce-review__verified verified">(' . esc_html_x( 'verified owner', 'frontend', 'promosys' ) . ')</em> ';
                }
                echo '<time class="meta-item woocommerce-review__published-date" datetime="'. esc_attr( get_comment_date('c') ) . '">';
                    echo sprintf(__('%s ago', 'promosys'), human_time_diff(get_comment_time('U'), current_time('timestamp')));
                echo '</time>';
            echo '</p>';
        }
    }
    public function cws_review_display_gravatar($comment){
        echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '' );
    }
    public function cws_review_header_wrapper_open() {
	    echo '<div class="comment-header">';
	        echo '<div class="comment-header-content">';
    }
    public function cws_review_header_wrapper_close() {
	        echo '</div>';
	    echo '</div>';
    }
    public function cws_product_review_form_args($args) {
        $args = wp_parse_args( $args );
        if ( ! isset( $args['format'] ) )
            $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
        
        $args['title_reply_before'] = '<div class="cws_textmodule"><div class="cws_textmodule_info_wrapper"><h5 class="cws_textmodule_title"<span class="cws_textmodule_title_text">';
		$args['title_reply_after'] = '</span></h5></div></div>';
        $args['class_submit'] = 'submit cws_button simple shadow';
        $args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" maxlength="65525" aria-required="true" placeholder="'.esc_attr_x( 'Write your review', 'frontend', 'promosys' ).'"></textarea></p>';
    
        $commenter = wp_get_current_commenter();
        $req      = get_option( 'require_name_email' );
        $html_req = ( $req ? " required" : '' );
        $html5    = 'html5' === $args['format'];
        
        $args['fields']['author'] = '<p class="comment-form-rating"><label for="rating">' . esc_html_x( 'Your Rating', 'frontend', 'promosys' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html_x( 'Rate&hellip;', 'frontend', 'promosys' ) . '</option>
						<option value="5">' . esc_html_x( 'Perfect', 'frontend', 'promosys' ) . '</option>
						<option value="4">' . esc_html_x( 'Good', 'frontend', 'promosys' ) . '</option>
						<option value="3">' . esc_html_x( 'Average', 'frontend', 'promosys' ) . '</option>
						<option value="2">' . esc_html_x( 'Not that bad', 'frontend', 'promosys' ) . '</option>
						<option value="1">' . esc_html_x( 'Very poor', 'frontend', 'promosys' ) . '</option>
					</select></p>'.'<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="' .
            esc_attr_x('Your name', 'comments', 'promosys' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' />' . '</p>';
        $args['fields']['email'] = '<p class="comment-form-email">' . '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"') . ' placeholder="' . esc_attr_x('E-mail', 'comments', 'promosys') . '" value="' . esc_attr($commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' />' . '</p>';
    
        return $args;
    }
    public function cws_product_review_form_fields($fields) {
        if( function_exists('is_product') && is_product()  ){
            $comment_field = $fields['comment'];
            unset( $fields['comment'] );
            $fields['comment'] = $comment_field;
        }
        return $fields;
    }
    public function cws_remove_comment_form_cookies_field( $fields ) {
        unset( $fields['cookies'] );
        return $fields;
    }


	/* -----> Load More function <----- */
	public function cws_woo_load_more_ajax(){
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged'] = $_POST['page'] + 1;
		$args['post_status'] = 'publish';

		$woo_posts = get_posts( $args );

		foreach($woo_posts as $post) : setup_postdata($post);
	 		wc_get_template_part( 'content', 'product' );
		endforeach;

		wp_die();
	}

	/* -----> Mini Cart functions <----- */
	public function minicart_wrapper_open (){
		echo "<div class='woo_mini_cart'>";

		if( get_theme_mod('woocommerce_mini_cart') == 'sidebar-view' ){
			$bag_text = WC()->cart->cart_contents_count;
			echo "<div class='woo_items_count'>" . sprintf( esc_html_x('My Bag (%s)', 'frontend', 'promosys'), $bag_text ) . "</div>";
			echo "<i class='close_mini_cart'></i>";
		}
	}
	public function minicart_wrapper_close (){
		echo "</div>";
	}
	public function cws_woocommerce_get_mini_cart_icon(){
		ob_start(); ?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mini_cart_trigger">
			<i class='woo_mini-count'>
				<?php 
					echo '<span>'. WC()->cart->cart_contents_count .'</span>';
				?>
			</i>
		</a>
		<?php return ob_get_clean();
	}
	public function cws_woocommerce_get_mini_cart(){
		ob_start(); ?>
		<div class="mini-cart <?php echo esc_attr(get_theme_mod('woocommerce_mini_cart'));?> ">
			<?php
				echo sprintf('%s', $this->cws_woocommerce_get_mini_cart_icon());
				woocommerce_mini_cart();
			?>
		</div>
		<?php 
		return ob_get_clean();
	}

}

global $seoes_woo_ext;
$seoes_woo_ext = new Promosys_WooExt();

?>