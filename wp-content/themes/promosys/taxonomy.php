<?php
get_header ();
	
	/* -----> Variables Declaration <----- */
	$taxonomy = get_query_var( 'taxonomy' );
	$term_slug = get_query_var( $taxonomy );

	/* -----> Taxonomy archive page <----- */
	switch( $taxonomy ){
		case 'cws_staff_member_position':
		case 'cws_staff_member_department':
			
			echo cws_vc_shortcode_sc_our_team( array(
				'tax' 				=> $taxonomy,
				'hide_meta'			=> true,
				$taxonomy.'_terms'	=> $term_slug
			));

			break;
		case 'cws_portfolio_tag':
		case 'cws_portfolio_cat':

			echo cws_vc_shortcode_sc_portfolio( array(
				'tax' 				=> $taxonomy,
				'hide_meta'			=> true,
				$taxonomy.'_terms'	=> $term_slug
			));

			break;
		default:
			break;
	}

get_footer ();