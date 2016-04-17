<?php
/**
 * Template part for displaying the homepage
 *
 * @package uxrennes
 */

$page_ID = get_the_ID();

// Get the latest event
$args = array(
	'post_type' 		=> 'events',
	'posts_per_page'	=> 1
);

$query = new WP_Query($args);

if ($query->have_posts()) : 

	while ($query->have_posts()) : $query->the_post();

		$event_ID 		= get_the_ID();
		$uxr_event_type = get_post_meta($event_ID, 'uxr_event_type', true);

		get_template_part('template-parts/content-home', $uxr_event_type );

	endwhile;

endif; 

wp_reset_query();

//
// PREVIOUS EVENTS
//

get_template_part('template-parts/content-previous-events'); 

?>