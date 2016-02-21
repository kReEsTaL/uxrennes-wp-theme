<?php 

/**
 * Creating the "events" custom post type
 *
 * @package uxrennes
 */

add_action('init','register_events');
function register_events(){

	$labels = array(
		'name'					=> __('Events', 'uxrennes'),
		'singular_name'			=> __('Event', 'uxrennes'),
		'add_new'				=> __('Add new', 'uxrennes'),
		'add_new_item'			=> __('Add new event', 'uxrennes'),
		'edit_item'				=> __('Edit event', 'uxrennes'),
		'new_item'				=> __('New event', 'uxrennes'),
		'all_items'				=> __('All events', 'uxrennes'),
		'view_item'				=> __('View event', 'uxrennes'),
		'search_items'			=> __('Search events', 'uxrennes'),
		'not_found'				=> __('No event found', 'uxrennes'),
		'not_found_in_trash'	=> __('No event found in trash', 'uxrennes'), 
		'parent_item_colon'		=> '',
		'menu_name'				=> __('Events', 'uxrennes')
	);
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'hierarchical'			=> false,
		'rewrite'				=> array('slug' => __('events', 'uxrennes'),'with_front' => false),
		'show_ui'				=> true,
		'capability_type'		=> 'post',
		'query_var'				=> 'events',
		'menu_position'			=> 5,
		'supports'				=> array('title','excerpt','thumbnail','page-attributes'),
		//'taxonomies'			=> array('post_tag'),
		'has_archive'			=> __('events', 'uxrennes')
	);

	/* Taxonomies propres au events */
	register_taxonomy('event_type','events',
		array(
			'public'                => true,
			'hierarchical'          => false,
			'label'                 => __('Event types', 'uxrennes'),
			'singular_label'        => __('Event type', 'uxrennes'),
			'query_var'             => true,
			'rewrite'               => true,
			'show_tagcloud'			=> false,
			'rewrite'				=> false,
			'show_in_nav_menus'		=> false, // on ne veut pas l'afficher comme option de menu
			'choose_from_most_used'	=> __('Choose from most used types', 'uxrennes')
		)
	);

	register_taxonomy('event_place','events',
		array(
			'public'                => true,
			'hierarchical'          => false,
			'label'                 => __('Event places', 'uxrennes'),
			'singular_label'        => __('Event place', 'uxrennes'),
			'query_var'             => true,
			'rewrite'               => true,
			'show_tagcloud'			=> false,
			'rewrite'				=> false,
			'show_in_nav_menus'		=> false, // on ne veut pas l'afficher comme option de menu,
			'choose_from_most_used'	=> __('Choose from most used places', 'uxrennes')
		)
	);

	register_taxonomy('event_sponsor','events',
		array(
			'public'                => true,
			'hierarchical'          => false,
			'label'                 => __('Sponsors', 'uxrennes'),
			'singular_label'        => __('Sponsor', 'uxrennes'),
			'query_var'             => true,
			'rewrite'               => true,
			'show_tagcloud'			=> false,
			'rewrite'				=> false,
			'show_in_nav_menus'		=> false, // on ne veut pas l'afficher comme option de menu,
			'choose_from_most_used'	=> __('Choose from regular sponsors', 'uxrennes')
		)
	);
	
	
	// Translate Taxonomy Tag
	// add_filter('post_link', 'type_permalink', 10, 3);
	// add_filter('post_type_link', 'type_permalink', 10, 3);
	
	function type_permalink($permalink, $post_id, $leavename) {
	
		if (strpos($permalink, '%event_type%') === FALSE) return $permalink;
		if (strpos($permalink, '%event_place%') === FALSE) return $permalink;
		
		// Get post
		$post = get_post($post_id);
		if (!$post) return $permalink;
		
		// Get taxonomy terms
		$terms = wp_get_object_terms($post->ID, 'event_type');
		if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
		else $taxonomy_slug = 'no-type';
		return str_replace('%event_type%', $taxonomy_slug, $permalink);

		// Get taxonomy terms
		$terms = wp_get_object_terms($post->ID, 'event_place');
		if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
		else $taxonomy_slug = 'no-place';
		return str_replace('%event_place%', $taxonomy_slug, $permalink);
	}
	
	register_post_type('events',$args);
	flush_rewrite_rules();
}
