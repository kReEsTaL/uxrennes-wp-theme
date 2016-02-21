<?php
/**
 * The template for displaying all single events.
 *
 * @package uxrennes
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'events' ); ?>

			<?php //the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>

		</main>
	</div>

<?php get_footer(); ?>
