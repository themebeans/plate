<?php
/**
 * Template Name: Home
 * The template for displaying the homepage layout.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main hfeed">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="widget-area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- .widget-area -->
			<?php endif; ?>

		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
