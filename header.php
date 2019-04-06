<?php
/**
 * The header for our theme.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div id="page" class="site clearfix">

	<?php if ( ! is_404() ) : ?>

		<?php plate_announcement(); ?>

		<header id="masthead" class="site-header">

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'walker'         => new PlateClassMobileNavigationWalker(),
						)
					);
					?>
				</nav><!-- .main-navigation -->

				<div class="mobile-menu-toggle"><span></span><span></span><span></span></div>
			<?php endif; ?>

		</header><!-- .site-header -->

		<div id="content" class="site-content">

			<div id="site-hero" class="hero-content-area">

				<?php plate_site_logo(); ?>

				<?php plate_page_title(); ?>

				<div class="site-hero--image full--bg" <?php plate_video_hero(); ?>>

					<?php
					/*
	                 * Include the image header, if the Customizer option is set to 'image',
	                 * but also on other pages, if the 'video' option is selected, but the global option is deselected.
	                 */
					if ( get_theme_mod( 'plate_hero_format' ) == 'image' or get_theme_mod( 'plate_hero_video_global' ) == false and ! is_front_page() ) {
					?>
						<div class="site-hero--image--item" style="<?php echo esc_html( plate_background_image() ); ?>"></div>
					<?php } ?>

				</div>

				<?php plate_background_color(); ?>

		</div><!-- .hero-content-area -->

	<?php endif; ?>
