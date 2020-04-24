<?php 

function cptt_register_post_type() {
	$labels = array(
		'name' => __("Books", "cptt"),
		'singular_name' => __("Book", "cptt"),
		'add_new' => __("Add New Book", "cptt"), 
		'edit_item' => __("Edit Book", "cptt"), 
		'new_item' => __("New Book", 'cptt'),
		'view_item' => __("View Book", 'cptt'),
		'search_items' => __("Search All Books", 'cptt'),
		'not_found_in_trash' => __("No Moons Found in Trash", 'cptt'),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'page-attributes'
		)
	);
	register_post_type('books', $args);
}
add_action( 'init' , 'cptt_register_post_type' );