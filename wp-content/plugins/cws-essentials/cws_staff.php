<?php

add_action( "init", "register_cws_staff_department", 4 );
add_action( "init", "register_cws_staff_position", 5 );
add_action( "init", "register_cws_staff", 6 );

//Register staff post type
function register_cws_staff (){
	$rewrite_slug = cws_get_slug('cws_staff');

	$labels = array(
		'name' => esc_html_x( 'Staff', 'backend', 'cws-essentials' ),
		'singular_name' => esc_html_x( 'Staff Item', 'backend', 'cws-essentials' ),
		'menu_name' => esc_html_x( 'Our team', 'backend', 'cws-essentials' ),
		'all_items' => esc_html_x( 'All', 'backend', 'cws-essentials' ),
		'add_new' => esc_html_x( 'Add New', 'backend', 'cws-essentials' ),
		'add_new_item' => esc_html_x( 'Add New Staff Item', 'backend', 'cws-essentials' ),
		'edit_item' => esc_html_x("Edit Staff Item’s Info", 'backend', 'cws-essentials' ),
		'new_item' => esc_html_x( 'New Staff Item', 'backend', 'cws-essentials' ),
		'view_item' => esc_html_x( "View Staff Item’s Info", 'backend', 'cws-essentials' ),
		'search_items' => esc_html_x( 'Find Staff Item', 'backend', 'cws-essentials' ),
		'not_found' => esc_html_x( 'No Staff Items Found', 'backend', 'cws-essentials' ),
		'not_found_in_trash' => esc_html_x( 'No Staff Items Found in Trash', 'backend', 'cws-essentials' ),
		'parent_item_colon' => '',
	);

	register_post_type( 'cws_staff', array(
		'label' => esc_html_x( 'Staff Items', 'backend', 'cws-essentials' ),
		'labels' => $labels,
		'public' => true,
		'rewrite' => array( 'slug' => $rewrite_slug ),
		'capability_type' => 'post',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'page-attributes',
			'thumbnail'
		),
		'menu_position' => 24,
		'menu_icon' => 'dashicons-groups',
		'taxonomies' => array( 'cws_staff_member_position', 'cws_staff_member_department' ),
		'has_archive' => true,
		'show_in_rest' => true
	));
}

//Register staff department taxonomy
function register_cws_staff_department(){
	$rewrite_slug = cws_get_slug('cws_staff');

	$labels = array(
		'name' => esc_html_x( 'Departments', 'backend', 'cws-essentials' ),
		'singular_name' => esc_html_x( 'Staff Department', 'backend', 'cws-essentials' ),
		'all_items' => esc_html_x( 'All Staff Departments', 'backend', 'cws-essentials' ),
		'edit_item' => esc_html_x( 'Edit Staff Department', 'backend', 'cws-essentials' ),
		'view_item' => esc_html_x( 'View Staff Department', 'backend', 'cws-essentials' ),
		'update_item' => esc_html_x( 'Update Staff Department', 'backend', 'cws-essentials' ),
		'add_new_item' => esc_html_x( 'Add Staff Department', 'backend', 'cws-essentials' ),
		'new_item_name' => esc_html_x( 'New Staff Department', 'backend', 'cws-essentials' ),
		'parent_item' => esc_html_x( 'Parent Staff Department', 'backend', 'cws-essentials' ),
		'parent_item_colon' => esc_html_x( 'Parent Staff Department:', 'backend', 'cws-essentials' ),
		'search_items' => esc_html_x( 'Search Staff Departments', 'backend', 'cws-essentials' ),
		'popular_items' => esc_html_x( 'Popular Staff Departments', 'backend', 'cws-essentials' ),
		'separate_items_width_commas' => esc_html_x( 'Separate with commas', 'backend', 'cws-essentials' ),
		'add_or_remove_items' => esc_html_x( 'Add or Remove Staff Departments', 'backend', 'cws-essentials' ),
		'choose_from_most_used' => esc_html_x( 'Choose from the most used Staff Departments', 'backend', 'cws-essentials' ),
		'not_found' => esc_html_x( 'No Staff Departments Found', 'backend', 'cws-essentials' )
	);
	register_taxonomy( 'cws_staff_member_department', 'cws_staff', array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $rewrite_slug . '-department' ),
		'show_in_rest' => true
	));
}

//Register staff position taxonomy
function register_cws_staff_position(){
	$rewrite_slug = cws_get_slug('cws_staff');

	$labels = array(
		'name' => esc_html_x( 'Positions', 'backend', 'cws-essentials' ),
		'singular_name' => esc_html_x( 'Staff Position', 'backend', 'cws-essentials' ),
		'all_items' => esc_html_x( 'All Staff Positions', 'backend', 'cws-essentials' ),
		'edit_item' => esc_html_x( 'Edit Staff Position', 'backend', 'cws-essentials' ),
		'view_item' => esc_html_x( 'View Staff Position', 'backend', 'cws-essentials' ),
		'update_item' => esc_html_x( 'Update Staff Position', 'backend', 'cws-essentials' ),
		'add_new_item' => esc_html_x( 'Add Staff Position', 'backend', 'cws-essentials' ),
		'new_item_name' => esc_html_x( 'New Staff Position', 'backend', 'cws-essentials' ),
		'search_items' => esc_html_x( 'Search Staff Positions', 'backend', 'cws-essentials' ),
		'popular_items' => esc_html_x( 'Popular Staff Positions', 'backend', 'cws-essentials' ),
		'separate_items_width_commas' => esc_html_x( 'Separate with commas', 'backend', 'cws-essentials' ),
		'add_or_remove_items' => esc_html_x( 'Add or Remove Staff Positions', 'backend', 'cws-essentials' ),
		'choose_from_most_used' => esc_html_x( 'Choose from the most used Staff Positions', 'backend', 'cws-essentials' ),
		'not_found' => esc_html_x( 'No Staff Member positions found', 'backend', 'cws-essentials' )
	);
	register_taxonomy( 'cws_staff_member_position', 'cws_staff', array(
		'labels' => $labels,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $rewrite_slug . '-position' ),
		'show_tagcloud' => false,
		'show_in_rest' => true
	));
}

//Add staff orders
function add_order_column( $columns ) {
  $columns['menu_order'] = "Order";
  return $columns;
}
add_action('manage_edit-cws_staff_columns', 'add_order_column');

//Show staff order on 'edit all' page
function show_order_column($name){
  global $post;
  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_cws_staff_posts_custom_column','show_order_column');

//Show staff thumbnails on 'edit all' page
function add_cws_staff_thumb_name ($columns) {
	$columns = array_slice($columns, 0, 1, true) +
				array('cws_staff_thumbnail' => esc_html_x('Thumbnails', 'backend', 'cws-essentials')) +
				array_slice($columns, 1, NULL, true);
	return $columns;
}
add_filter('manage_cws_staff_posts_columns', 'add_cws_staff_thumb_name');

function add_cws_staff_thumb ($column, $id) {
	if ('cws_staff_thumbnail' === $column) {
		echo the_post_thumbnail('thumbnail');
	}
}
add_action('manage_cws_staff_posts_custom_column', 'add_cws_staff_thumb', 5, 2);