<?php
/**
 * Template Name: Contact
 * The template for displaying the contact form.
 *
 * This template simply defaults to the standard page layout,
 * for which specialized content is loaded based on a is_page_template
 * check.
 *
 * Reference page.php and template-parts/content-page.php.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

get_header();

$image   = get_theme_mod( 'contact_img' );
$map     = get_theme_mod( 'contact_map_shortcode' );
$address = get_theme_mod( 'contact_map_address' );
?>

<div id="primary" class="content-area has-background">
	<main id="main" class="site-main">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
			?>

				<div class="contact-block-container">

					<div class="contact-block">
						<div class="center-vertical">
							<div class="center-vertical--inner">
								<div class="entry-content">
									<?php
										the_content();

										wp_link_pages(
											array(
												'before'   => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'plate' ) . '</span>',
												'after'    => '</div>',
												'link_before' => '<span>',
												'link_after' => '</span>',
												'pagelink' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'plate' ) . ' </span>%',
												'separator' => '<span class="screen-reader-text">, </span>',
											)
										);
									?>
								</div><!-- .entry-content -->
							</div><!-- .center-vertical--inner -->
						</div><!-- .center-vertical -->
					</div><!-- .contact-block -->

					<div class="contact-block contact-map">

						<?php if ( $address ) : ?>

							<div class="address-wrap">
								<span class="address-circle">
									<span><?php echo balanceTags( $address ); ?></span>
								</span>
							</div>

						<?php
						endif;

if ( $map ) {
	echo do_shortcode( $map );
}
						?>

					</div><!-- .contact-block -->

				</div><!-- .contact-block-container -->

				<div class="contact-block-container">

					<div class="contact-block contact-img">
							<?php
							if ( $image ) :
								  echo '<img src="' . $image . '">';
						 else :
								the_post_thumbnail();
						 endif;
							?>
					</div><!-- .contact-block -->

					<div class="contact-block contact-template-form">
						<div class="center-vertical">
							<div class="center-vertical--inner">

								<?php
								// Include the page content template.
								get_template_part( 'template-parts/content', 'form' );
								?>

							</div><!-- .center-vertical--inner -->
						</div><!-- .center-vertical -->
					</div><!-- .contact-block -->

				</div><!-- .contact-block-container -->

			<?php
			// End of the loop.
			endwhile;
			?>

		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
