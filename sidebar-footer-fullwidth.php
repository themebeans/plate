<?php
/**
 * The footer fullwidth widget areas on posts and pages
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return; // If we get this far, we have widgets. Let do this.
}
?>

<div id="footer-fullwidth-widgets" class="footer-fullwidth-widgets">
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</div><!-- .content-bottom-widgets -->
