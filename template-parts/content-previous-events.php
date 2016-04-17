<?php
/**
 * Template part for displaying previous events
 *
 * @package uxrennes
 */

global $event_ID;

// Get UX Deiz description
$uxr_ux_deiz_desc = get_option('options_uxr_ux_deiz_desc', true);

// Get the latest event
$args = array(
	'post_type' 		=> 'events',
	'posts_per_page'	=> 3,
	'post__not_in'		=> array($event_ID),

	// Only display UX Deiz (because afterworks don't have archive pages)
	'meta_query' => array(
		array(
			'key'     => 'uxr_event_type',
			'value'   => array('uxdeiz'),
			'compare' => 'IN',
		),
	),
);

$query = new WP_Query($args);

if ($query->have_posts()) : 

?>
<div class="uxr-previous-events uxr-color-blood">

	<div class="uxr-previous-events_intro">
		<div class="uxr-grid-container">
			<h2 class="uxr-title-beta">
				<?php _e('Our UX conferences', 'uxrennes'); ?>
			</h2>
			<?php if (isset($uxr_ux_deiz_desc) && !empty($uxr_ux_deiz_desc)) : ?>
			<div class="uxr-contrib uxr-contrib-limit">
				<?php echo apply_filters('the_content', $uxr_ux_deiz_desc); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	
	<?php 

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
	<div class="uxr-previous-event js-clickbox">
		<div class="uxr-grid-container">
			<?php 

			//
			// EVENT TITLE
			//

			?>
			<h3 class="uxr-page-header_title">
				<?php if (isset($uxr_event_theme) && !empty($uxr_event_theme)) : ?>
				<em><?php echo $uxr_event_title; ?><?php if (isset($time_d)) : ?> &middot; <?php echo date_i18n('d F Y', $time_d); ?><?php endif; ?></em>
				<span class="uxr-visually-hidden"> : </span>
				<a href="<?php the_permalink(); ?>" class="uxr-link-block">
					<strong class="uxr-title-delta"><?php echo $uxr_event_theme; ?></strong>
				</a>
				<?php else : ?>
				<?php if (isset($time_d)) : ?><em><?php echo date_i18n('d F Y', $time_d); ?></em><?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="uxr-link-block">
					<strong class="uxr-title-delta"><?php the_title(); ?></strong>
				</a>
				<?php endif; ?>
			</h3>
			<p class="uxr-previous-event_link" aria-hidden="true">
				<span class="uxr-btn-alpha uxr-btn-alpha-minor">
					<?php _e('Read the recap', 'uxrennes'); ?>
				</span>
			</p>
		</div>
	</div>
	<?php 

	endwhile; 

	?>
</div>
<?php

endif;

wp_reset_query();

?>