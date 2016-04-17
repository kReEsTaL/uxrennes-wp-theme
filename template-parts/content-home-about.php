<?php
/**
 * Template part for displaying the homepage
 *
 * @package uxrennes
 */

	// Retrieve some metadata
	$uxr_about_page 		= get_option('options_uxr_about_page', true);
	$post 					= get_post($uxr_about_page);
	$content 				= apply_filters('the_content', $post->post_content);
	
	if (isset($uxr_about_page) && !empty($uxr_about_page)) :

	?>
	<div class="uxr-home-about uxr-color-shadows">
		<div class="uxr-grid-container">
			<div class="uxr-contrib">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<?php 

	endif;

	wp_reset_postdata();
?>