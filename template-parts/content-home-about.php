<?php
/**
 * Template part for displaying the homepage
 *
 * @package uxrennes
 */

	// Retrieve some metadata
	$uxr_about_page 		= 	get_option('options_uxr_about_page', true);
	$post 					= 	get_post($uxr_about_page);
	$content 				= 	apply_filters('the_content', $post->post_content);
	$uxr_ulule				= 	get_option('options_uxr_ulule', true);
	$uxr_ulule 				= 	wp_kses(
									$uxr_ulule,
									array(
										'iframe' => array(
											'frameborder' 	=> array(),
											'width' 		=> array(),
											'height' 		=> array(),
											'src' 			=> array(),
											'scrolling' 	=> array(),
										)
									)
								);
	
	if (isset($uxr_about_page) && !empty($uxr_about_page)) :

	?>
	<div class="uxr-home-about uxr-color-shadows">
		<div class="uxr-grid-container">
			<div class="uxr-home-about_content">
				<div class="uxr-home-about_intro">
					<div class="uxr-contrib uxr-contrib-limit">
						<?php echo $content; ?>
					</div>
				</div>
				<?php if (isset($uxr_ulule) && !empty($uxr_ulule)) : ?>
				<div class="uxr-home-about_extra">
					<div class="uxr-ulule">
					<?php echo $uxr_ulule; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
	<?php 

	endif;

	wp_reset_postdata();
?>