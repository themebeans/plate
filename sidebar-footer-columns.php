<?php
/**
 * The footer columns
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

if ( ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) && ! is_active_sidebar( 'sidebar-5' ) ) {
	return; // If we get this far, we have widgets. Let do this.
}
?>

<div id="content-bottom-widgets" class="content-bottom-widgets clearfix">
	<div class="site-footer--inner">
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-5' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
	</div><!-- .site-footer- -inner -->
</div><!-- .content-bottom-widgets -->
