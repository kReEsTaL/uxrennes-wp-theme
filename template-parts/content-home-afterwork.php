<?php
/**
 * Template part for displaying the homepage
 *
 * @package uxrennes
 */

	// Retrieve some metadata
	$event_ID 								= get_the_ID();
	$uxr_event_title 						= get_post_meta($event_ID, 'uxr_event_title', 			true);
	$uxr_event_title						= explode('<br />', $uxr_event_title);

	// echo '<pre>';
	// print_r($uxr_event_title);
	// echo '<br />';
	// echo count($uxr_event_title);
	// echo '</pre>';

	function test_print($item2, $key)
	{
		echo "<span class='uxr-event-title_$key'>$item2</span>";
	}


	$uxr_event_theme 						= get_post_meta($event_ID, 'uxr_event_theme', 			true);
	$uxr_event_theme 						= wp_kses($uxr_event_theme, array( 'span' => array(), 'br' => array() ));
	$uxr_event_rsvp 						= get_post_meta($event_ID, 'uxr_event_tickets', 		true);
	$uxr_event_type 						= get_post_meta($event_ID, 'uxr_event_type', true);

	// Retrieve talks ID
	//$uxr_event_talks 						= get_post_meta($event_ID, 'uxr_event_talks', 			true);

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
<article id="post-<?php the_ID(); ?>" <?php post_class('uxr-next-event'); ?>>
	<header role="banner" class="uxr-page-header">
		

			<div class="uxr-next-event_header">
				<p>
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
				<h2 class="uxr-page-header_title">
					<?php if (isset($uxr_event_title) && !empty($uxr_event_title)) : ?>
					<strong class="uxr-title-giant"><?php array_walk($uxr_event_title, 'test_print'); ?></strong>
					<?php else : ?>
					<strong class="uxr-title-giant"><?php the_title(); ?></strong>
					<?php endif; ?>
				</h2>
				
			</div>
		
	</header>

	<div class="uxr-main uxr-next-event_main">
		<div class="uxr-grid-container">
			<div class="uxr-contrib">

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

					endif;

				

				//
				// Event date and time
				//
				if (isset($time_d)) :

				?>
				<p class="uxr-next-event_date">
					<strong>
					
						<?php echo ucfirst(date_i18n('d F Y', $time_d));

						if (isset($uxr_event_time) && !empty($uxr_event_time)) : echo ', ' . $uxr_event_time; endif;

						?>

					</strong>
				</p>
				<?php
				
				endif;

				
				//
				// Meetup or recap link
				//
				if (isset($uxr_event_rsvp) && !empty($uxr_event_rsvp)) : 

					$uxr_event_rsvp_id = basename($uxr_event_rsvp);

					if ($today_date < $event_date) :
					?>
					<p class="uxr-next-event_link">
						<a href="<?php echo esc_url($uxr_event_rsvp); ?>"<?php if (isset($uxr_event_rsvp_id) && !empty($uxr_event_rsvp_id)) : ?> data-event="<?php echo $uxr_event_rsvp_id; ?>"<?php endif; ?> class="mu-rsvp-btn uxr-btn-alpha" target="_blank">
							<?php _e('RSVP on Meetup', 'uxrennes'); ?>
						</a>
					</p>

					<?php 

					endif;

				endif;

				
				//
				// Address
				//

				if (isset($uxr_place_address) && !empty($uxr_place_address)) :

				?>
				<div class="uxr-next-event_place">

					<?php echo $uxr_place_name; ?>
				
					<?php echo apply_filters('the_content', $uxr_place_address); ?>
				
					<?php /*if (isset($uxr_place_gmap_link) && !empty($uxr_place_gmap_link)) : ?>
					<p class="uxr-next-event_gmaps">
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

				?>
			</div>
		</div>
	</div>
</article>