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

	// Retrieve some metadata
	global $event_ID;
	$event_ID 								= get_the_ID();
	$uxr_event_title 						= get_post_meta($event_ID, 'uxr_event_title', 			true);
	$uxr_event_theme 						= get_post_meta($event_ID, 'uxr_event_theme', 			true);
	$uxr_event_theme 						= wp_kses($uxr_event_theme, array( 'span' => array(), 'br' => array() ));
	$uxr_event_tickets 						= get_post_meta($event_ID, 'uxr_event_tickets', 		true);
	$uxr_event_type 						= get_post_meta($page_ID, 'uxr_event_type', true);

	// Retrieve talks ID
	$uxr_event_talks 						= get_post_meta($event_ID, 'uxr_event_talks', 			true);

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
		<div class="uxr-grid-container">

			<div class="uxr-next-event_header">
				<?php 

				//
				// EVENT TITLE
				//

				?>
				<h2 class="uxr-page-header_title">
					<?php if (isset($uxr_event_theme) && !empty($uxr_event_theme)) : ?>
					<em><?php echo $uxr_event_title; ?><?php if (isset($time_d)) : ?> &middot; <?php echo date_i18n('d F Y', $time_d); ?><?php endif; ?></em>
					<span class="uxr-visually-hidden"> : </span>
					<strong class="uxr-title-giant"><?php echo $uxr_event_theme; ?></strong>
					<?php else : ?>
					<?php if (isset($time_d)) : ?><em><?php echo date_i18n('d F Y', $time_d); ?></em><?php endif; ?>
					<strong class="uxr-title-giant"><?php the_title(); ?></strong>
					<?php endif; ?>
				</h2>

				<?php 

				//
				// EVENT TALKS
				//

				if (isset($uxr_event_talks) && !empty($uxr_event_talks)) :

					// Setting up talks loop
					$talks_args = array(
						'post_type'             => 'talks',
						'post__in'              => $uxr_event_talks,
						'ignore_sticky_posts'   => true,
						'order'                 => 'ASC',
						'posts_per_page'        => '2',

						// cf. http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
						'orderby'               => 'post__in'
						//

					);

					// Talks loop
					$talks_query = new WP_Query( $talks_args );

					if ( $talks_query->have_posts() ) : 

					?>
					<ul class="uxr-next-event_talks">
					<?php

						while ( $talks_query->have_posts() ) : $talks_query->the_post();

						?>
						<li class="uxr-next-event_talk">
						<?php 

							//
							// TALK META
							//

							// Talk ID
							$talk_ID 			= get_the_ID();

							// Reset vars
							$uxr_talk_title					= false;
							$speaker_ID 					= false;
							$uxr_speaker_picture 			= false;
							$uxr_speaker_twitter 			= false;
							$uxr_speaker_twitter_nickname 	= false;
							$uxr_speaker_name				= false;


							// Talk title
							$uxr_talk_title		= get_post_meta($talk_ID, 'uxr_talk_title', true) ? get_post_meta($talk_ID, 'uxr_talk_title', true) : get_the_title();

							// Talk speakers
							$taxonomy			= 'talk_speakers';
							$talk_speakers		= get_the_terms($talk_ID, $taxonomy);
							$speakers_ID		= [];
							$speakers_name		= [];

							// Talk picture
							$uxr_talk_photo		= get_post_meta($talk_ID, 'uxr_talk_photo', true);

							if ( $talk_speakers != null ) :
								
								foreach( $talk_speakers as $talk_speaker ) :
									$speakers_ID[] 		= $talk_speaker->term_id;
									$speakers_name[] 	= $talk_speaker->name;
								endforeach;
							endif;

							// Get first speaker ID
							//if ($speakers_ID) :
								
								// Talk speaker ID
								//$speaker_ID 					= array_values($speakers_ID)[0];

								// // Talk speaker picture ID
								// $uxr_speaker_picture 			= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_picture', true); // talk_speakers_7_uxr_speaker_picture

								// // Talk speaker Twitter URL
								// $uxr_speaker_twitter 			= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_twitter', true);

								// if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter)) :
								// 	$uxr_speaker_twitter_nickname 	= str_replace('https://twitter.com/', 		'', $uxr_speaker_twitter);
								// 	$uxr_speaker_twitter_nickname 	= str_replace('https://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
								// 	$uxr_speaker_twitter_nickname 	= str_replace('http://twitter.com/', 		'', $uxr_speaker_twitter_nickname);
								// 	$uxr_speaker_twitter_nickname 	= str_replace('http://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
								// endif;

								// Talk speaker name
								// if ($speakers_name) :
									
								// 	$uxr_speaker_name = array_values($speakers_name)[0];

								// endif;

							//endif;

							// Talk speaker picture
							if ( $talk_speakers != null ) :

								$speacker_pic_counter = 0;

								if (isset($uxr_talk_photo) && !empty($uxr_talk_photo)) :

								?>
								<p class="uxr-next-event_talk-picture">
									<?php echo wp_get_attachment_image($uxr_talk_photo, 'uxr_speaker_medium'); ?>
								</p>
								<?php

								else :

									foreach( $talk_speakers as $speaker ) :

										// Get speaker meta
										$speaker_ID				= $speaker->term_id;
										$speaker_name 			= $speaker->name;

										// Talk speaker picture ID
										$uxr_speaker_picture 	= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_picture', true); // talk_speakers_7_uxr_speaker_picture

										if (isset($uxr_speaker_picture) && !empty($uxr_speaker_picture) && $speacker_pic_counter == 0) :

								?>
								<p class="uxr-next-event_talk-picture">
									<?php echo wp_get_attachment_image($uxr_speaker_picture, 'uxr_speaker_medium'); ?>
								</p>
								<?php 
										endif;

									endforeach;

								endif;

							endif;


							// Talk title
							if (isset($uxr_talk_title) && !empty($uxr_talk_title)) : 
							?>
							<h2 class="uxr-next-event_talk-title">
								<strong>
									<?php echo wp_kses($uxr_talk_title, array('br' => array())); ?>
								</strong>
								<?php 

									// Speakers
									if ( $talk_speakers != null ) :

										// Counters
										$speaker_total_count = count($talk_speakers);
										$speaker_count = 0;

										foreach( $talk_speakers as $speaker ) :

											$speaker_ID		= $speaker->term_id;
											$speaker_name 	= $speaker->name;

											// Talk speaker Twitter URL
											$uxr_speaker_twitter 			= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_twitter', true);

											if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter)) :
												$uxr_speaker_twitter_nickname 	= str_replace('https://twitter.com/', 		'', $uxr_speaker_twitter);
												$uxr_speaker_twitter_nickname 	= str_replace('https://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
												$uxr_speaker_twitter_nickname 	= str_replace('http://twitter.com/', 		'', $uxr_speaker_twitter_nickname);
												$uxr_speaker_twitter_nickname 	= str_replace('http://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
											endif;

											// Insert comma or "and"
											if ($speaker_count > 0 ) :
												if ($speaker_count == $speaker_total_count - 1) : echo ' ' . __('and', 'uxrennes') . ' ';
												else : echo ', '; 
												endif;
											endif;

											// Insert Twitter link
											if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter) && $uxr_speaker_twitter != '1') :
												echo '<a href="' . esc_url($uxr_speaker_twitter) .'" target="_blank">';
											endif;

											// Display speaker name
											echo '<span class="uxr-next-event_talk-speaker">' . $speaker_name . '</span>';

											// Close Twitter link
											if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter) && $uxr_speaker_twitter != '1') :
												echo '</a>';
											endif;

											$speaker_count++;

										endforeach;

									endif;

								?>
							</h2>
							<?php endif;

							/*if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter) && $uxr_speaker_twitter != '1') :

							?>
							<p class="uxr-next-event_speaker-twitter">
								<a href="<?php echo esc_url($uxr_speaker_twitter); ?>" target="_blank">
									<?php echo '@'. $uxr_speaker_twitter_nickname; ?>
								</a>
							</p>
							<?php

							endif;*/

						endwhile;

						?>
						</li>
						<?php

					endif;

					?>
					</ul>
					<?php

					wp_reset_query();

				?>


				<?php endif; ?>
			</div>
		</div>
	</header>

	<div class="uxr-main uxr-next-event_main">
		<div class="uxr-grid-container">
			<div class="uxr-contrib">

				<?php 

					// 
					// EVENT LOCATION AND DATE
					// 
					// Talk speakers
					$taxonomy			= 'event_place';
					$event_places		= get_the_terms($event_ID, $taxonomy);
					$places_ID			= [];
					//$places_name		= [];

					if ( $event_places != null ) :
						foreach( $event_places as $event_place ) :
							$places_ID[]	= $event_place->term_id;
							//$places_name[] 	= $event_place->name;
						endforeach;
					endif;

					// Get place meta
					if ($places_ID) :
						
						// Event place ID
						$place_ID 					= array_values($places_ID)[0];

						// Place name
						//$uxr_place_name				= array_values($places_name)[0];

						// Event place address
						$uxr_place 					= get_option($taxonomy . '_' . $place_ID . '_uxr_place_address', true);
						$uxr_place_address 			= $uxr_place['address'];
						$uxr_place_address 			= str_replace(', France', '', $uxr_place_address); 
						$uxr_place_address 			= str_replace(', ', '<br />', $uxr_place_address); 
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
					
						<?php echo ucfirst(date_i18n('l d F Y', $time_d));

						if (isset($uxr_event_time) && !empty($uxr_event_time)) : echo ', ' . $uxr_event_time; endif;

						?>

					</strong>
				</p>
				<?php
				
				endif;

				
				//
				// Meetup or recap link
				//
				if (isset($uxr_event_tickets) && !empty($uxr_event_tickets)) : 					

					if ($today_date > $event_date) :
					?>
					<p class="uxr-next-event_link">
						<a href="<?php the_permalink($event_ID); ?>" class="uxr-btn-alpha">
							<?php _e('Read the recap', 'uxrennes'); ?>
						</a>
					</p>
					<?php 

					else :	

					?>
					<p class="uxr-next-event_link">
						<a href="<?php echo esc_url($uxr_event_tickets); ?>" class="uxr-btn-alpha" target="_blank">
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
				
					<?php echo apply_filters('the_content', $uxr_place_address); ?>
				
					<?php if (isset($uxr_place_gmap_link) && !empty($uxr_place_gmap_link)) : ?>
					<p class="uxr-next-event_gmaps">
						<a href="<?php echo esc_url($uxr_place_gmap_link); ?>" target="_blank">
							<span>
								<?php _e('See on Google Maps', 'uxrennes'); ?>
							</span>
						</a>
					</p>
					<?php endif; ?>

				</div>
				<?php 

				endif; 

				?>

				<?php /*if (isset($uxr_place_infos) && !empty($uxr_place_infos)) : ?>
				<p>
					<strong>
						<?php _e('Directions','uxrennes'); ?>
					</strong>
				</p>
				<?php echo apply_filters('the_content', $uxr_place_infos); ?>
				<?php endif;*/ ?>
			</div>
		</div>
	</div>
</article>
<?php 

	endwhile;

endif; 

wp_reset_query();

?>

<?php get_template_part('template-parts/content-home', 'about'); ?>