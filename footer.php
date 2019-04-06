<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

/*
 * If the current page is a 404 error
 * return early without loading the page.
 */
if ( is_404() ) {
	wp_footer();
	return;
} ?>

	</div><!-- #content -->

	<?php plate_instagram_feed(); ?>

	<?php
	/*
     * Get the fullwidth footer widget area on all pages and posts.
     */
	get_sidebar( 'footer-fullwidth' );
	?>

	<footer id="colophon" class="site-footer
	<?php
	if ( get_theme_mod( 'plate_footer_layout' ) == 'columns' ) {
		echo 'columns-sidebar';}
?>
">

		<?php
		/*
         * Check to see what footer layout is selected via the Customizer.
         */
		if ( get_theme_mod( 'plate_footer_layout' ) == 'columns' ) :
			get_sidebar( 'footer-columns' );
		else :
			get_sidebar( 'footer-centered' );
		endif;
		?>

		<div class="colophon clearfix">

			<div class="site-footer--inner">

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav id="social-navigation" class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'plate' ); ?>">

						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => '1',
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . plate_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>

					</nav><!-- .social-navigation -->
				<?php endif; ?>

				<div class="site-info">
					<?php plate_footer_credits(); ?>
				</div><!-- .site-info -->

			</div><!-- .site-footer- -inner -->

		 </div><!-- .colophon -->

	</footer><!-- .site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
