<?php 

/**
 * Creating the "places" custom post type
 *
 * @package uxrennes
 */

add_action('init','register_places');
function register_places(){

	$labels = array(
		'name'					=> __('places', 'uxrennes'),
		'singular_name'			=> __('Place', 'uxrennes'),
		'add_new'				=> __('Add new', 'uxrennes'),
		'add_new_item'			=> __('Add new place', 'uxrennes'),
		'edit_item'				=> __('Edit place', 'uxrennes'),
		'new_item'				=> __('New place', 'uxrennes'),
		'all_items'				=> __('All places', 'uxrennes'),
		'view_item'				=> __('View place', 'uxrennes'),
		'search_items'			=> __('Search places', 'uxrennes'),
		'not_found'				=> __('No place found', 'uxrennes'),
		'not_found_in_trash'	=> __('No place found in trash', 'uxrennes'), 
		'parent_item_colon'		=> '',
		'menu_name'				=> __('Places', 'uxrennes')
	);
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> false,
		'hierarchical'			=> false,
		'show_ui'				=> true,
		'capability_type'		=> 'page',
		'query_var'				=> false,
		'menu_position'			=> 5,
		'supports'				=> array('title','thumbnail'),
		'has_archive'			=> false
	);
	
	register_post_type('places',$args);
	flush_rewrite_rules();
}
