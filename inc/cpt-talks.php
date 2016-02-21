<?php 

/**
 * Creating the "talks" custom post type
 *
 * @package uxrennes
 */

add_action('init','register_talks');
function register_talks(){

	$labels = array(
		'name'					=> __('Talks', 'uxrennes'),
		'singular_name'			=> __('Talk', 'uxrennes'),
		'add_new'				=> __('Add new', 'uxrennes'),
		'add_new_item'			=> __('Add new talk', 'uxrennes'),
		'edit_item'				=> __('Edit talk', 'uxrennes'),
		'new_item'				=> __('New talk', 'uxrennes'),
		'all_items'				=> __('All talks', 'uxrennes'),
		'view_item'				=> __('View talk', 'uxrennes'),
		'search_items'			=> __('Search talks', 'uxrennes'),
		'not_found'				=> __('No talk found', 'uxrennes'),
		'not_found_in_trash'	=> __('No talk found in trash', 'uxrennes'), 
		'parent_item_colon'		=> '',
		'menu_name'				=> __('Talks', 'uxrennes')
	);
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'hierarchical'			=> false,
		'rewrite'				=> array('slug' => __('talks', 'uxrennes'),'with_front' => false),
		'show_ui'				=> true,
		'capability_type'		=> 'post',
		'query_var'				=> 'talks',
		'menu_position'			=> 5,
		'supports'				=> array('title','excerpt','thumbnail','page-attributes'),
		//'taxonomies'			=> array('post_tag'),
		//'has_archive'			=> __('talks', 'uxrennes')
		'has_archive'			=> false
	);

	/* Taxonomies propres aux talks */
	register_taxonomy('talk_speakers','talks',
		array(
			'public'                => true,
			'hierarchical'          => false,
			'label'                 => __('Speakers', 'uxrennes'),
			'singular_label'        => __('Speaker', 'uxrennes'),
			'query_var'             => true,
			'rewrite'               => false,
			'show_tagcloud'			=> false,
			'rewrite'				=> false,
			'show_in_nav_menus'		=> false, // on ne veut pas l'afficher comme option de menu,
			'choose_from_most_used'	=> __('Choose from most current speakers', 'uxrennes')
		)
	);

	register_taxonomy('talk_themes','talks',
		array(
			'public'                => true,
			'hierarchical'          => false,
			'label'                 => __('Talk themes', 'uxrennes'),
			'singular_label'        => __('Talk theme', 'uxrennes'),
			'query_var'             => true,
			'rewrite'               => false,
			'show_tagcloud'			=> false,
			'rewrite'				=> false,
			'show_in_nav_menus'		=> false, // on ne veut pas l'afficher comme option de menu,
			'choose_from_most_used'	=> __('Choose from most used themes', 'uxrennes')
		)
	);

	
	register_post_type('talks',$args);
	flush_rewrite_rules();
}
