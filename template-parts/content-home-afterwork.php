<?php
/**
 * Template part for displaying the homepage
 *
 * @package uxrennes
 */

	// Retrieve some metadata
	global $event_ID;
	$event_ID 								= get_the_ID();
	$uxr_event_title 						= get_post_meta($event_ID, 'uxr_event_title', 			true);
	$uxr_event_title						= explode('<br />', $uxr_event_title);

	function test_print($item2, $key)
	{
		echo "<span class='uxr-next-afterwork_title-block uxr-next-afterwork_title-block-$key'>$item2</span>";
	}


	$uxr_event_theme 						= get_post_meta($event_ID, 'uxr_event_theme', 			true);
	$uxr_event_theme 						= wp_kses($uxr_event_theme, array( 'span' => array(), 'br' => array() ));
	$uxr_event_rsvp 						= get_post_meta($event_ID, 'uxr_event_tickets', 		true);
	$uxr_event_type 						= get_post_meta($event_ID, 'uxr_event_type', true);

	// Date
	$uxr_event_date 						= get_post_meta($event_ID, 'uxr_event_date', 			true);
	$uxr_event_time 						= get_post_meta($event_ID, 'uxr_event_time', 			true);
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
<article id="post-<?php the_ID(); ?>" <?php post_class('uxr-next-afterwork'); ?>>
	<header role="banner" class="uxr-page-block">
		<div class="uxr-next-afterwork_layout">
		
			<?php 

			//
			// First columns
			//

			?>
			<div class="uxr-next-afterwork_col uxr-next-afterwork_info">
				<div class="uxr-icon uxr-next-afterwork_icon">
					<div class="uxr-icon_in-1">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="77px" height="66px" viewBox="0 0 77 66" style="enable-background:new 0 0 77 66;" xml:space="preserve">
							<g>
								<path class="st0" d="M59.6,28.8L58.3,26l0,0L59.6,28.8L59.6,28.8z M21.6,30.9c-0.9-0.4-1.9,0-2.3,0.9l-8.5,18.4
									c-0.4,0.9,0,1.9,0.8,2.3c0.2,0.1,0.5,0.2,0.7,0.2c0.7,0,1.3-0.4,1.6-1l8.5-18.4C22.9,32.3,22.5,31.3,21.6,30.9z M73.7,50.2
									l-0.3,0.2l0.1,0.2c0.7,1.5,0.7,3.1,0.2,4.6c-0.6,1.5-1.7,2.7-3.2,3.4l-14.8,6.8C54.8,65.8,54,66,53.1,66l0,0
									c-2.4,0-4.5-1.4-5.5-3.5l-9.1-19.7l-9,19.6c-1,2.1-3.2,3.5-5.5,3.5c-0.9,0-1.7-0.2-2.5-0.6L6.6,58.5c-1.5-0.7-2.6-1.9-3.2-3.4
									c-0.6-1.5-0.5-3.2,0.2-4.6l0.1-0.2l-0.3-0.2c-3-1.4-4.4-5-3-8.1l7-15.2c0.7-1.5,1.9-2.6,3.4-3.2c1.5-0.6,3.2-0.5,4.6,0.2l0.3,0.1
									l0.5-1.2l1.4-3c1.4-3.1,5.2-4.5,8.3-3.1c0,0,0.1,0,0.1,0c2.2-1.3,4.9-1.4,7.2-0.3c2.1,0.9,3.6,2.7,4.2,4.8c0.4,0.1,0.8,0.2,1.2,0.3
									c0.3-0.1,0.6-0.2,0.8-0.2c0.7-2.1,2.2-3.9,4.2-4.8c2.4-1.1,5-0.9,7.2,0.3c0,0,0.1,0,0.1,0c1.5-0.7,3.2-0.8,4.8-0.2
									c1.6,0.6,2.8,1.7,3.5,3.2l1.4,3l0,0l0.5,1.2l0.3-0.2c1.5-0.7,3.1-0.7,4.6-0.2c1.5,0.6,2.7,1.7,3.4,3.2l7,15.2
									C78.1,45.2,76.7,48.8,73.7,50.2z M45.9,25.1c-0.5,0.8-1.6,1-2.4,0.4c-0.1-0.1-0.3-0.2-0.4-0.3c0.2,0.3,0.3,0.7,0.5,1.1
									c0.3,0.8,0.5,1.6,0.5,2.4l12.9-5.9l-0.7-1.4c-0.3-0.7-0.9-1.2-1.6-1.4c-0.7-0.3-1.4-0.2-2.1,0.1c-0.2,0.1-0.4,0.2-0.5,0.3
									c-0.3,0.2-0.7,0.4-1.1,0.4c-0.4,0-0.8-0.1-1.1-0.4c-1.3-1.1-3.1-1.3-4.6-0.6c-0.9,0.4-1.6,1-2,1.8c0.8,0.2,1.6,0.6,2.3,1.1
									C46.3,23.3,46.5,24.3,45.9,25.1z M5.2,47.1l9.2-19.9L14,27.1c-1.3-0.6-2.9,0-3.5,1.3l-7,15.2c-0.6,1.3,0,2.9,1.3,3.5L5.2,47.1z
									 M38.3,34.9l-1.7-0.8l-0.1,0.1L36.4,34l-1.5-0.7l-1-0.4l-15.2-7l0,0l-0.6,1.4v1.5l0,0v-1.5l-0.6,1.4L8.3,48.6l-0.4,0.9l-1.1,2.3
									l-0.1,0.2c-0.3,0.6-0.3,1.3-0.1,2c0.2,0.7,0.7,1.2,1.4,1.5l14.8,6.8c0.3,0.2,0.7,0.2,1.1,0.2c1,0,1.9-0.6,2.4-1.5l10.3-22.3l1-2.1
									l0.6-1.2L38.3,34.9z M40.3,30.5c0.3-1,0.3-2-0.1-2.9c-0.3-0.9-0.9-1.6-1.6-2.1c-0.2-0.1-0.4-0.3-0.7-0.4c-0.4-0.2-0.8-0.3-1.2-0.4
									c-0.9-0.1-1.7,0-2.5,0.4c-0.2,0.1-0.4,0.2-0.6,0.4c-0.8,0.5-1.9,0.4-2.4-0.4c-0.5-0.8-0.4-1.9,0.4-2.4c0.7-0.5,1.5-0.8,2.3-1.1
									c-0.4-0.8-1.1-1.4-2-1.8c-1.5-0.7-3.3-0.5-4.6,0.6c-0.1,0.1-0.2,0.2-0.3,0.2c-0.6,0.3-1.4,0.2-1.9-0.2c-0.2-0.1-0.3-0.2-0.5-0.3
									c-1.4-0.6-3,0-3.7,1.4l-0.7,1.4l12.9,5.9l1.7,0.8l1.9,0.9l2,0.9L40.3,30.5z M70.3,52l-0.1-0.2l0,0l0,0L69.8,51L59.6,28.8L58.3,26v0
									L43,33.1l-0.8,1.7l-1.8,3.8L50.7,61c0.4,0.9,1.4,1.5,2.4,1.5l0,0c0.4,0,0.7-0.1,1.1-0.2L69,55.5c0.6-0.3,1.1-0.8,1.4-1.5
									C70.6,53.3,70.6,52.6,70.3,52z M73.5,43.6l-7-15.2c-0.6-1.3-2.1-1.9-3.5-1.3l-0.3,0.2l9.2,19.9l0.3-0.2
									C73.6,46.5,74.1,44.9,73.5,43.6z M52.2,34.4c-0.4-0.9-1.4-1.3-2.3-0.8c-0.9,0.4-1.3,1.4-0.8,2.3l8.5,18.4c0.3,0.6,0.9,1,1.6,1
									c0.2,0,0.5-0.1,0.7-0.2c0.9-0.4,1.3-1.4,0.9-2.3L52.2,34.4z M57.8,31.8c-0.4-0.9-1.4-1.3-2.3-0.8c-0.9,0.4-1.3,1.4-0.9,2.3
									l8.5,18.4c0.3,0.6,0.9,1,1.6,1c0.2,0,0.5-0.1,0.7-0.2c0.9-0.4,1.3-1.4,0.8-2.3L57.8,31.8z M46.7,36.9c-0.4-0.9-1.4-1.2-2.3-0.8
									c-0.9,0.4-1.3,1.4-0.8,2.3L52,56.8c0.3,0.6,0.9,1,1.6,1c0.2,0,0.5-0.1,0.7-0.2c0.9-0.4,1.3-1.4,0.8-2.3L46.7,36.9z M27.1,33.4
									c-0.9-0.4-1.9,0-2.3,0.8l-8.5,18.4c-0.4,0.9,0,1.9,0.8,2.3c0.2,0.1,0.5,0.2,0.7,0.2c0.7,0,1.3-0.4,1.6-1L28,35.7
									C28.4,34.9,28,33.8,27.1,33.4z M32.7,36c-0.9-0.4-1.9,0-2.3,0.8l-8.5,18.4c-0.4,0.9,0,1.9,0.8,2.3c0.2,0.1,0.5,0.2,0.7,0.2
									c0.7,0,1.3-0.4,1.6-1l8.5-18.4C33.9,37.4,33.5,36.4,32.7,36z M38.6,14.9c1,0,1.7-0.8,1.7-1.7V1.7c0-1-0.8-1.7-1.7-1.7
									c-1,0-1.7,0.8-1.7,1.7v11.4C36.9,14.1,37.6,14.9,38.6,14.9z M45.2,13.2c0.2,0.1,0.5,0.2,0.7,0.2c0.6,0,1.3-0.4,1.6-1l3.1-6.5
									C51,5,50.7,4,49.8,3.6c-0.9-0.4-1.9,0-2.3,0.8l-3.1,6.5C44,11.8,44.3,12.8,45.2,13.2z M29.3,12.4c0.3,0.6,0.9,1,1.6,1
									c0.3,0,0.5-0.1,0.7-0.2c0.9-0.4,1.2-1.4,0.8-2.3l-3.1-6.5c-0.4-0.9-1.4-1.2-2.3-0.8S25.8,5,26.2,5.9L29.3,12.4z"/>
							</g>
						</svg>
					</div>
				</div>
				<div class="uxr-next-afterwork_content">
					<p class="uxr-next-afterwork_subtitle">
						<?php 

						if ($today_date > $event_date) :

							_e('Previous event', 'uxrennes'); 

						else :

							_e('Next event', 'uxrennes'); 

						endif;

						?>
					</p>
					<?php 

					//
					// EVENT TITLE
					//

					?>
					<h2 class="uxr-next-afterwork_title">
						<?php if (isset($uxr_event_title) && !empty($uxr_event_title)) : ?>
						<strong class="uxr-title-so-big uxr-next-afterwork_title-in">
							<?php array_walk($uxr_event_title, 'test_print'); ?>
						</strong>
						<?php else : ?>
						<strong class="uxr-title-so-big uxr-next-afterwork_title-in">
							<?php the_title(); ?>
						</strong>
						<?php endif; ?>
					</h2>


					<?php 

					// 
					// EVENT LOCATION AND DATE
					// 
					$taxonomy			= 'event_place';
					$event_places		= get_the_terms($event_ID, $taxonomy);
					$places_ID			= [];
					$places_name		= [];

					if ( $event_places != null ) :
						foreach( $event_places as $event_place ) :
							$places_ID[]	= $event_place->term_id;
							$places_name[]	= $event_place->name;
						endforeach;
					endif;

					// Get place meta
					if ($places_ID) :
						
						// Event place ID
						$place_ID 					= array_values($places_ID)[0];

						// Place name
						$uxr_place_name				= array_values($places_name)[0];

						// Event place address
						$uxr_place 					= get_option($taxonomy . '_' . $place_ID . '_uxr_place_address', true);
						$uxr_place_address 			= $uxr_place['address'];
						$uxr_place_address 			= str_replace(', France', '', $uxr_place_address); 
						//$uxr_place_address 			= str_replace(', ', '<br />', $uxr_place_address); 
						$uxr_place_lat 				= $uxr_place['lat'];
						$uxr_place_lng 				= $uxr_place['lng'];
						$uxr_place_gmap_link		= 'https://www.google.com/maps/?q='.$uxr_place_lat.','.$uxr_place_lng;

						// Event place infos
						//$uxr_place_infos 			= get_option($taxonomy . '_' . $place_ID . '_uxr_place_infos', true);

						// Event place picture
						$uxr_place_picture 			= get_option($taxonomy . '_' . $place_ID . '_uxr_place_picture', true);
						$uxr_place_picture_src 		= wp_get_attachment_image_src($uxr_place_picture, 'uxr-square')[0];

					endif;

				

					//
					// Event date and time
					//
					if (isset($time_d)) :

					?>
					<p class="uxr-next-afterwork_date">
						<strong>
						
							<?php echo ucfirst(date_i18n('d F Y', $time_d));

							if (isset($uxr_event_time) && !empty($uxr_event_time)) : echo ', ' . $uxr_event_time; endif;

							?>

						</strong>
					</p>
					<?php
					
					endif;

					//
					// Address
					//

					if (isset($uxr_place_address) && !empty($uxr_place_address)) :

					?>
					<div class="uxr-next-afterwork_place">

						<?php echo $uxr_place_name; ?>
					
						<?php echo apply_filters('the_content', $uxr_place_address); ?>
					
						<?php /*if (isset($uxr_place_gmap_link) && !empty($uxr_place_gmap_link)) : ?>
						<p class="uxr-next-afterwork_gmaps">
							<a href="<?php echo esc_url($uxr_place_gmap_link); ?>" target="_blank">
								<span>
									<?php _e('See on Google Maps', 'uxrennes'); ?>
								</span>
							</a>
						</p>
						<?php endif;*/ ?>

					</div>
					<?php 

					endif; 

				
					//
					// Meetup or recap link
					//
					if (isset($uxr_event_rsvp) && !empty($uxr_event_rsvp)) : 

						$uxr_event_rsvp_id = basename($uxr_event_rsvp);

						if ($today_date < $event_date) :
						?>
						<p class="uxr-next-afterwork_link">
							<a href="<?php echo esc_url($uxr_event_rsvp); ?>"<?php /*if (isset($uxr_event_rsvp_id) && !empty($uxr_event_rsvp_id)) : ?> data-event="<?php echo $uxr_event_rsvp_id; ?>"<?php endif;*/ ?> class="<?php /*mu-rsvp-btn*/ ?>uxr-btn-alpha" target="_blank">
								<?php _e('RSVP on Meetup', 'uxrennes'); ?>
							</a>
						</p>

						<?php 

						endif;

					endif;

					?>
				</div>
			</div>

			<?php 

			//
			// Photo
			//
			if (isset($uxr_place_picture) && !empty($uxr_place_picture)) :

			?>
			<div class="uxr-next-afterwork_col uxr-next-afterwork_place-picture" style="background-image:url('<?php echo $uxr_place_picture_src; ?>');">
				<?php //echo wp_get_attachment_image($uxr_place_picture, 'uxr_square'); ?>
			</div>
			<?php

			endif;

			?>

			
		</div>
	</header>

	<?php get_template_part('template-parts/content-home', 'about'); ?>
	
</article>