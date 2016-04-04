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
// Previous events
//
// Get the latest event
$args = array(
	'post_type' 		=> 'events',
	'posts_per_page'	=> 3,
	'post__not_in'		=> array($event_ID)
);

$query = new WP_Query($args);

if ($query->have_posts()) : 

	while ($query->have_posts()) : $query->the_post(); 
		
	// Retrieve some metadata
	$next_event_ID 							= get_the_ID();
	$uxr_event_title 						= get_post_meta($next_event_ID, 'uxr_event_title', 			true);
	$uxr_event_theme 						= get_post_meta($next_event_ID, 'uxr_event_theme', 			true);
	$uxr_event_theme 						= wp_kses($uxr_event_theme, array( 'span' => array(), 'br' => array() ));

	// Date
	$uxr_event_date 						= get_post_meta($next_event_ID, 'uxr_event_date', 			true);
	$uxr_event_time 						= get_post_meta($next_event_ID, 'uxr_event_time', 			true);
	if ($uxr_event_time) $uxr_event_time 	= mb_strtolower(esc_html($uxr_event_time));

	// Extraire Y,M,D
	// @link https://www.gregoirenoyelle.com/acf-creer-une-date-intertionalisable/
	$y = substr($uxr_event_date, 0, 4);
	$m = substr($uxr_event_date, 4, 2);
	$d = substr($uxr_event_date, 6, 2);

	// Créer le format UNIX
	$time_d = strtotime("{$d}-{$m}-{$y}");

	// Today's date
	$today_date = date('Y-m-d', time());

	// Event date
	$event_date = date_i18n('Y-m-d', $time_d);

?>
<div class="uxr-previous-events">

	<div class="uxr-previous-event uxr-block-important js-clickbox">
		<div class="uxr-grid-container">

			<?php 

			//
			// EVENT TITLE
			//

			?>
			<h2 class="uxr-page-header_title">
				<?php if (isset($uxr_event_theme) && !empty($uxr_event_theme)) : ?>
				<em><?php echo $uxr_event_title; ?><?php if (isset($time_d)) : ?> &middot; <?php echo date_i18n('d F Y', $time_d); ?><?php endif; ?></em>
				<span class="uxr-visually-hidden"> : </span>
				<a href="<?php the_permalink(); ?>" class="uxr-link-block">
					<strong class="uxr-title-alpha"><?php echo $uxr_event_theme; ?></strong>
				</a>
				<?php else : ?>
				<?php if (isset($time_d)) : ?><em><?php echo date_i18n('d F Y', $time_d); ?></em><?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="uxr-link-block">
					<strong class="uxr-title-alpha"><?php the_title(); ?></strong>
				</a>
				<?php endif; ?>
			</h2>
			<p class="uxr-previous-event_link" aria-hidden="true">
				<span class="uxr-btn-alpha">
					<?php _e('Read the recap', 'uxrennes'); ?>
				</span>
			</p>

		</div>
	</div>
</div>
<?php

	endwhile;

endif;

wp_reset_query();

?>