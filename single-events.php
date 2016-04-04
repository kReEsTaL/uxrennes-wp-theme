<?php
/**
 * The template for displaying all single events.
 *
 * @package uxrennes
 */

$post_ID 		= get_the_ID();
$uxr_event_type = get_post_meta($post_ID, 'uxr_event_type', true);

if (isset($uxr_event_type) && $uxr_event_type == 'uxdeiz') :

	get_header(); 

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'events' ); ?>

			<?php //the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>

		</main>
	</div>

<?php get_footer();

else :

	// Do not print single post for events 
	// that are not uxdeiz
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".get_bloginfo('url'));
	exit();

endif; 

?>