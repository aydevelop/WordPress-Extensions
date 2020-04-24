<?php 

function cptt_register_post_type_book() {
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
			'page-attributes',
			'taxonomies' => array('genres'),
		)
	);
    register_post_type('book', $args);    
}
add_action( 'init' , 'cptt_register_post_type_book' );

function cptt_register_taxonomy_genres() {
	$labels = array(
		'name' => __( 'Genres', 'cptt' ),
		'singular_name' => __ ( 'Genre', 'cptt' ),
		'search_items' => __( 'Search Genres', 'cptt' ),
		'all_items' => __( 'All Genres', 'cptt' ),
		'edit_item' => __( 'Edit Genre', 'cptt' ),
		'update_item' => __( 'Update Genre', 'cptt' ),
		'add_new_item' => __( 'Add New Genre', 'cptt' ),
		'new_item_name' => __( 'New Genre Name', 'cptt' ),
		'menu_name' => __('Genres', 'cptt' )
	);
	$args = array(
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'genres' ),
		'show_admin_column' => true,
		'labels' => $labels
	);
    register_taxonomy( 'genres', 'book', $args );    
}
add_action( 'init' , 'cptt_register_taxonomy_genres' );