<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

get_header(); ?>

<div id="primary" class="content-area has-background has-sidebar clearfix">
	<main id="main" class="site-main">
		<section class="hfeed content-wrap clearfix">

			<?php
			if ( have_posts() ) :

				echo '<div id="masonry-feed" class="masonry-feed">';

				// Start the loop.
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

					// End the loop.
				endwhile;

				echo '</div>';

				// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

			<?php
			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous', 'plate' ),
					'next_text'          => esc_html__( 'Next', 'plate' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'plate' ) . ' </span>',
				)
			);
			?>

			<div id="page_nav" class="hide">
				<?php next_posts_link(); ?>
			</div><!-- END #page_nav -->

		</section><!-- .hfeed -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
