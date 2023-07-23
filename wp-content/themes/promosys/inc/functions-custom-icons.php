<?php
defined( 'ABSPATH' ) or die();

function cws_get_all_flaticon_icons() {
	$cwsfi = get_option('cwsfi');

	if( !empty($cwsfi) && isset($cwsfi['entries']) ){
		return $cwsfi['entries'];
	} else {
		global $wp_filesystem;

		$fi_content = '';
		$file = get_template_directory() . '/assets/fonts/flaticons/style.css';

		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		if( $wp_filesystem && $wp_filesystem->exists($file) ){
			$fi_content = $wp_filesystem->get_contents($file);

			if( preg_match_all( "/flaticon-((\w+|-?)+):before/", $fi_content, $matches, PREG_PATTERN_ORDER ) ){
				return $matches[1];
			}
		}
	}
}