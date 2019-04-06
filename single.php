<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

get_header();

$post_layout = ( 'layout_right_sidebar' == get_theme_mod( 'plate_post_layout' ) ) ? 'has-sidebar' : 'fullwidth-post'; ?>

<div id="primary" class="content-area has-background <?php echo esc_html( $post_layout ); ?>">
	<main id="main" class="site-main">

		<div class="content-wrap clearfix">

			<?php plate_post_thumbnail(); ?>

			<div class="sidebar-main">
				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();

					// Include the single post content template.
					get_template_part( 'template-parts/content', 'single' );

					if ( ! is_singular( 'attachment' ) ) {
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}

					// End of the loop.
				endwhile;
				?>
			</div>

			<?php if ( get_theme_mod( 'plate_post_layout' ) == 'layout_right_sidebar' ) { ?>
				<div class="sidebar-right">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>

		</div><!-- .content-wrap -->

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
