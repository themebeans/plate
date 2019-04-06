<?php
/**
 * The centered footer (theme default)
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

 plate_footer_logo(); ?>

<?php if ( has_nav_menu( 'footer' ) ) : ?>
	<nav id="footer-navigation" class="footer-navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'depth'          => '1',
			)
		);
?>
	</nav><!-- .footer-navigation -->
<?php endif; ?>
