<?php
/**
 * Template part for displaying single events
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uxrennes
 */

// Retrieve some metadata
$event_ID 						= get_the_ID();
$uxr_event_title 				= get_post_meta($event_ID, 'uxr_event_title', 			true);
$uxr_event_theme 				= get_post_meta($event_ID, 'uxr_event_theme', 			true);
$uxr_event_theme				= wp_kses($uxr_event_theme, array( 'span' => array(), 'br' => array() ));
$uxr_event_flexible_content 	= get_post_meta($event_ID, 'uxr_event_flexible_content', true);
$uxr_event_talks 				= get_post_meta($event_ID, 'uxr_event_talks', 			true);
$uxr_event_sponsors				= get_the_terms($event_ID, 'event_sponsor');
$uxr_event_tickets				= get_post_meta($event_ID, 'uxr_event_tickets', 		true);

// Date
$uxr_event_date 				= get_post_meta($event_ID, 'uxr_event_date', 			true);

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
<article id="post-<?php the_ID(); ?>" <?php post_class('uxr-event'); ?>>
	<header role="banner" class="uxr-page-header">
		<div class="uxr-grid-container">

			<div class="uxr-event_header">
				<h1 class="uxr-page-header_title">
					<?php if (isset($uxr_event_theme) && !empty($uxr_event_theme)) : ?>
					<em><?php echo $uxr_event_title; ?><?php if (isset($time_d)) : ?> &middot; <?php echo date_i18n('d F Y', $time_d); ?><?php endif; ?></em>
					<span class="uxr-visually-hidden"> : </span>
					<strong class="uxr-title-alpha"><?php echo $uxr_event_theme; ?></strong>
					<?php else : ?>
					<?php if (isset($time_d)) : ?><em><?php echo date_i18n('d F Y', $time_d); ?></em><?php endif; ?>
					<strong class="uxr-title-alpha"><?php the_title(); ?></strong>
					<?php endif; ?>
				</h1>
			</div>
			
			<?php 

			//
			// Meetup or recap link
			//
			if (isset($uxr_event_tickets) && !empty($uxr_event_tickets)) : 					

				if ($today_date < $event_date) :
				?>
				<p class="uxr-next-event_link">
					<a href="<?php echo esc_url($uxr_event_tickets); ?>" class="uxr-btn-alpha" target="_blank">
						<?php _e('RSVP on Meetup', 'uxrennes'); ?>
					</a>
				</p>
				<?php 

				endif;

			endif;

			?>
		</div>
	</header>

	<div class="uxr-main uxr-event_main entry-content">
		<div class="uxr-grid-container">

			<?php 

			//
			// EVENT TALKS
			//

			if (isset($uxr_event_talks) && !empty($uxr_event_talks) ) :

			$talks_args = array(
				'post_type'             => 'talks',
				'post__in'              => $uxr_event_talks,
				'ignore_sticky_posts'   => true,
				'order'                 => 'ASC',
				'posts_per_page'        => '-1',

				// cf. http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
				'orderby'               => 'post__in'
				//

			);

			// Talks loop
			$talks_query = new WP_Query( $talks_args );

			if ( $talks_query->have_posts() ) : 

			?>
				<p class="uxr-title-beta uxr-event_subtitle">
					<?php

					if ($today_date > $event_date) :
						_e('Conference transcript','uxrennes');
					else :
						_e('Evening program','uxrennes');
					endif;

					?>
				</p>
				<?php 

				while ( $talks_query->have_posts() ) : $talks_query->the_post(); 

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
					$uxr_talk_links					= false;


					// Talk title
					$uxr_talk_title		= get_post_meta($talk_ID, 'uxr_talk_title', true) ? get_post_meta($talk_ID, 'uxr_talk_title', true) : get_the_title();
					$uxr_talk_title		= str_replace('<br />', ' ', $uxr_talk_title);

					// Talk transcript
					$uxr_talk_transcript 	= get_post_meta($talk_ID, 'uxr_talk_transcript', true);

					// Talk speakers
					$taxonomy			= 'talk_speakers';
					$talk_speakers		= get_the_terms($talk_ID, $taxonomy);
					$speakers_ID		= [];
					$speakers_name		= [];

					if ( $talk_speakers != null ) :
						foreach( $talk_speakers as $talk_speaker ) :
							$speakers_ID[] 		= $talk_speaker->term_id;
							$speakers_name[] 	= $talk_speaker->name;
						endforeach;
					endif;

					// Get first speaker ID
					if ($speakers_ID) :
						
						// Talk speaker ID
						$speaker_ID 						= array_values($speakers_ID)[0];

						// Talk speaker picture ID
						$uxr_speaker_picture 				= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_picture', true); // talk_speakers_7_uxr_speaker_picture

						// Talk speaker Twitter URL
						$uxr_speaker_twitter 				= get_option($taxonomy . '_' . $speaker_ID . '_uxr_speaker_twitter', true);

						if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter)) :
							$uxr_speaker_twitter_nickname 	= str_replace('https://twitter.com/', 		'', $uxr_speaker_twitter);
							$uxr_speaker_twitter_nickname 	= str_replace('https://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
							$uxr_speaker_twitter_nickname 	= str_replace('http://twitter.com/', 		'', $uxr_speaker_twitter_nickname);
							$uxr_speaker_twitter_nickname 	= str_replace('http://www.twitter.com/', 	'', $uxr_speaker_twitter_nickname);
						endif;

						// Talk speaker name
						//if ($speakers_name) :
							
							//$uxr_speaker_name = array_values($speakers_name)[0];
						// 	echo '<pre>';
						// 	print_r($speakers_name);
						// 	echo '</pre>';

						// endif;

					endif;

					// Talk links
					$uxr_talk_links = get_post_meta($talk_ID, 'uxr_talk_links', true);








				?>
				<div class="uxr-contrib">

					<?php 

					//
					// TALK TITLE
					//

					if (isset($uxr_talk_title) && !empty($uxr_talk_title)) : ?>
					<h2 class="uxr-event_talk-title">
						<?php echo wp_kses($uxr_talk_title, array()); ?>
						<?php if (isset($speakers_name) && !empty($speakers_name)) : ?>
						<span>
							<?php _e('by', 'uxrennes'); ?>
							<?php 

								$speaker_total_count = count($speakers_name);
								$speaker_count = 0;

								foreach ($speakers_name as $speaker) :

									if ($speaker_count == $speaker_total_count - 1 && $speaker_count != 0) echo __(' and ', 'uxrennes');
									elseif ($speaker_count > 0 ) echo ', '; 

									echo $speaker;
									$speaker_count++;
								endforeach;

							?>
						</span>
						<?php endif; ?>
					</h2>
					<?php if (isset($uxr_speaker_twitter) && !empty($uxr_speaker_twitter) && $uxr_speaker_twitter != '1') : ?>
					<p class="uxr-event_speaker-twitter">
						<a href="<?php echo esc_url($uxr_speaker_twitter); ?>" target="_blank">
							<?php echo '@'. $uxr_speaker_twitter_nickname; ?>
						</a>
					</p>
					<?php endif; ?>
					<?php endif; ?>

					<?php 

					// 
					// TALK SPEAKER PICTURE
					//
					if (isset($uxr_speaker_picture) && !empty($uxr_speaker_picture)) :

					?>
					<p class="uxr-next-event_talk-picture">
						<?php echo wp_get_attachment_image($uxr_speaker_picture, 'uxr_speaker_medium'); ?>
					</p>
					<?php endif;

					//
					// TALK TRANSCRIPT
					//
					if (isset($uxr_talk_transcript) && !empty($uxr_talk_transcript)) :
							 
						foreach( $uxr_talk_transcript as $count => $uxr_talk_transcript_block ) :

							switch( $uxr_talk_transcript_block ) :

								// 
								// WYSIWYG
								//
								case 'wysiwyg':

									$wysiwyg      = get_post_meta( $talk_ID, 'uxr_talk_transcript_' . $count . '_wysiwyg', true);
									 
									if ( isset($wysiwyg) && !empty($wysiwyg) ) 
										echo apply_filters('the_content', $wysiwyg);

								break;


								//
								// Image
								//
								case 'fullwidth_image':
						 
									$image_ID   = get_post_meta( $talk_ID, 'uxr_talk_transcript_' . $count . '_fullwidth_image', true );

									if (isset($image_ID) && !empty($image_ID)) :

										// Image source
										$img_src                = wp_get_attachment_image_url( $image_ID, 'uxr_fullwidth' );
										$img_srcset             = wp_get_attachment_image_srcset( $image_ID, 'uxr_fullwidth' );
										$img_sizes              = wp_get_attachment_image_sizes( $image_ID, 'uxr_fullwidth' );

										// Image meta
										$image_meta             = get_posts(array('p' => $image_ID, 'post_type' => 'attachment'));
										$image_caption          = $image_meta[0]->post_excerpt;
										$image_more_meta        = wp_get_attachment_metadata($image_ID, 'uxr_fullwidth');

										echo "\t".'</div>'."\n";
										echo '</div>'."\n";

										echo '<img src="'. esc_url( $img_src ) .'" srcset="'. esc_attr( $img_srcset ) .'" sizes="'. esc_attr($img_sizes).'" alt="" class="uxr-asset-fullwidth" />';

										echo '<div class="uxr-grid-container">'."\n";
										echo "\t".'<div class="uxr-contrib">'."\n";

									endif;
						 
								break;


								//
								// Links
								//
								case 'links':
						 
									$links   = get_post_meta( $talk_ID, 'uxr_talk_transcript_' . $count . '_links', true );

									if ($links) :

										echo '<h3>' . __('Links and resources', 'uxrennes') . '</h3>'."\n";
										echo '<ul>'."\n";

										for( $i = 0; $i < $links; $i++ ) :

											$link_title 	= esc_html(get_post_meta( $talk_ID, 'uxr_talk_transcript_' . $count . '_links_' . $i . '_title', true ));
											$link_url 		= esc_url( get_post_meta( $talk_ID, 'uxr_talk_transcript_' . $count . '_links_' . $i . '_url', true ));

											if (isset($link_title) && !empty($link_title) && isset($link_url) && !empty($link_url)) :

												echo '<li><a href="' . $link_url . '" target="_blank">' . $link_title . '</a>';

											endif;

										endfor;

										echo '</ul>';

									endif;
						 
								break;

							endswitch;

						endforeach;

					endif;


					//
					// TALK LINKS
					//
					// if( $uxr_talk_links ) :

					// 	echo '<ul>';

					// 	for( $i = 0; $i < $uxr_talk_links; $i++ ) :

					// 		$link_title 	= esc_html( get_post_meta( $talk_ID, 'uxr_talk_links_' . $i . '_link_title', true ) );
					// 		$link_url 		= esc_url( get_post_meta( $talk_ID, 'uxr_talk_links_' . $i . '_link_url', true ) );

					// 		if (isset($link_title) && !empty($link_title) && isset($link_url) && !empty($link_url)) :

					// 			echo '<li><a href="' . $link_url . '" target="_blank">' . $link_title . '</a>';

					// 		endif;

					// 	endfor;

					// 	echo '</ul>';

					// endif;

					?>
				</div>

				<?php endwhile; ?>

			<?php endif; endif; wp_reset_query();





			//
			// EVENT SPONSORS
			//

			if ( $uxr_event_sponsors != null ) :

			?>
		</div>
		<div class="uxr-grid-container">
			<h2 class="uxr-title-beta">
				<?php _e('Thanks to our sponsors','uxrennes'); ?>
			</h2>
			<div class="uxr-contrib">
				<ul class="uxr-event_sponsors">
				<?php 

				foreach( $uxr_event_sponsors as $uxr_event_sponsor ) : 

					$sponsor_ID 	= $uxr_event_sponsor->term_id;
					$sponsor_name 	= $uxr_event_sponsor->name;
					$sponsor_links	= get_option('event_sponsor_'. $sponsor_ID .'_uxr_sponsor_links', true); // event_sponsor_12_uxr_sponsor_links

				?>
				<li class="uxr-event_sponsor">
				<?php 

					if( $sponsor_links ) :

						for( $i = 0; $i < $sponsor_links; $i++ ) :

							if ($i != 0) echo ' – ';

							$link_title = esc_html( get_option('event_sponsor_'. $sponsor_ID .'_uxr_sponsor_links_' . $i . '_link_title', true ) );
							$link_url 	= esc_url( get_option('event_sponsor_'. $sponsor_ID .'_uxr_sponsor_links_' . $i . '_link_url', true ) );

							if ($link_title && !empty($link_title) && $link_url && !empty($link_url) ):

							?>
							<a href="<?php echo $link_url; ?>" target="_blank">
								<?php echo $link_title; ?>
							</a>
							<?php

							endif;

						endfor;

					else : 

						echo $sponsor_name;
						
					endif;

				?>
				</li>
				<?php

				endforeach;

				?>
				</ul>
			</div>
			<?php 

			endif;

			?>
		</div>
	</div>
</article>