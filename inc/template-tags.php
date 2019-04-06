<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

if ( ! class_exists( 'PlateClassMobileNavigationWalker' ) ) :
	/*
	* Custom wp_nav_menu function for the mobile navigational element.
	*/
	class PlateClassMobileNavigationWalker extends Walker_Nav_Menu {

		function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n" . $indent . '<ul class="sub_menu">' . "\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "$indent</ul>" . "\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$sub    = '';
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
			if ( $depth >= 0 && $args->has_children ) :
				$sub = ' has_sub';
			endif;

			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			$anchor = '';
			if ( $item->anchor != '' ) {
				$anchor = '#' . esc_attr( $item->anchor );
			}

			$active = '';
			if ( $item->anchor == '' && ( ( $item->current && $depth == 0 ) || ( $item->current_item_ancestor && $depth == 0 ) ) ) :
				$active = 'plate-active-item';
			endif;

			$output .= $indent . '<li id="mobile-menu-item-' . $item->ID . '" class="' . $class_names . ' ' . $active . $sub . '">';

			$current_a = '';
			// Attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ' href="' . esc_attr( $item->url ) . $anchor . '"';
			if ( ( $item->current && $depth == 0 ) || ( $item->current_item_ancestor && $depth == 0 ) ) :
				$current_a .= ' current ';
			endif;
			if ( esc_attr( $item->url ) === '#' ) {
				$current_a .= ' plate-mobile-no-link';
			}

			$attributes .= ' class="' . $current_a . '"';
			$item_output = $args->before;
			if ( $item->hide == '' ) {
				if ( $item->nolink == '' ) {
					$item_output .= '<a' . $attributes . '>';
				} else {
					$item_output .= '<h6>';
				}
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				if ( $item->nolink == '' ) {
					$item_output .= '</a>';
				} else {
					$item_output .= '</h6>';
				}

				if ( $args->has_children ) {
					$item_output .= '<span class="mobile-navigation--arrow"></span>';
				}
			}
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
endif;



if ( ! function_exists( 'plate_footer_credits' ) ) :
	/**
	 * Prints the footer copyright and theme information.
	 * Create your own plate_footer_credits() to override in a child theme.
	 */
	function plate_footer_credits() {
		/*
		 * If selected in the Customizer.
		 * The visibility classes area used to show/hide the elements in the Customizer live preview.
		 */
		$designer_visibility  = ( false == get_theme_mod( 'powered_by_plate' ) ) ? 'hidden' : '';
		$generator_visibility = ( false == get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : '';
		?>

		<div class="copyright">
		<span class="site-title">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
		<?php if ( get_theme_mod( 'footer_copyright_text' ) ) { ?>
			<span class="footer-text"><?php echo get_theme_mod( 'footer_copyright_text' ); ?></span>
		<?php } ?>
	</div>

	<?php if ( get_theme_mod( 'powered_by_plate' ) || is_customize_preview() ) : ?>
		<a href="https://themebeans.com/themes/plate/" rel="designer" class="powered-by-plate <?php echo esc_html( $designer_visibility ); ?>"><?php printf( esc_html__( 'Powered by %s', 'plate' ), 'Plate' ); ?></a>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'powered_by_wordpress' ) || is_customize_preview() ) : ?>
		<a href="http://wordpress.org/" rel="generator" class="powered-by-wordpress <?php echo esc_html( $generator_visibility ); ?>"><?php printf( esc_html__( '& %s', 'plate' ), 'WordPress' ); ?></a>
	<?php
	endif;
	}
endif;



if ( ! function_exists( 'plate_announcement' ) ) :
	/**
	 * Return the announcement bar.
	 *
	 * Create your own plate_announcement() to override in a child theme.
	 */
	function plate_announcement() {

		$announcement      = get_theme_mod( 'announcement_bar' );
		$announcement_text = get_theme_mod( 'announcement_bar_text' );

		/*
		 * Add the comments toggle, if selected in the Customizer.
		 * The $comments_visibility class is used to show/hide the .comments-area div in the Customizer.
		 */
		$announcement_visibility = ( false == get_theme_mod( 'announcement_bar' ) ) ? 'hidden' : '';

		if ( get_theme_mod( 'announcement_bar' ) || is_customize_preview() ) :
	?>

			<div class="announcement-bar <?php echo esc_html( $announcement_visibility ); ?>">
				<?php
				if ( $announcement_text ) {
					echo '<p>' . $announcement_text . '</p>'; }
?>
			</div>

		<?php

		endif;
	}
endif;



if ( ! function_exists( 'plate_page_title' ) ) :
	/**
	 * Returns the page titles.
	 *
	 * Create your own plate_page_title() to override this function in a child theme.
	 */
	function plate_page_title() {

		global $post;

		$page_title = '';

		if ( is_singular( 'page' ) ) {

			$header = get_post_meta( $post->ID, '_plate_page_header', true );

			if ( $header == 'on' ) {
				$page_title = sprintf( '<h1 class="entry-title">%1$s</h2>', esc_html( get_the_title() ) );
			}
		} else {
			if ( is_archive() ) {
				if ( is_category() ) {
					$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Posted in', 'plate' ), esc_html( single_cat_title( '', false ) ) );
				} elseif ( is_tag() ) {
					$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Tagged', 'plate' ), esc_html( single_tag_title( '', false ) ) );
				} elseif ( is_date() ) {
					if ( is_month() ) {
						$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Archive:', 'plate' ), esc_html( get_the_time( 'F, Y' ) ) );
					} elseif ( is_year() ) {
						$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Archive:', 'plate' ), esc_html( get_the_time( 'Y' ) ) );
					} elseif ( is_day() ) {
						$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Archive:', 'plate' ), esc_html( get_the_time( get_option( 'date_format' ) ) ) );
					} else {
						$page_title = sprintf( '<h1 class="page-title">%1$s</h2>', esc_html( 'Archives', 'plate' ) );
					}
				} elseif ( is_author() ) {
					if ( get_query_var( 'author_name' ) ) {
						$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
					} else {
						$curauth = get_userdata( get_query_var( 'author' ) );
					}
					$author_name = $curauth->display_name;

					$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'By', 'plate' ), esc_html( $author_name ) );

				} elseif ( is_tax() ) {
					$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Archive:', 'plate' ), esc_html( single_term_title( '', false ) ) );
				} else {
					$page_title = single_term_title( '', false ); }
			} elseif ( is_search() ) {
				if ( have_posts() ) :
					$page_title = sprintf( '<h1 class="page-title">%1$s %2$s</h2>', esc_html( 'Search for', 'plate' ), esc_html( get_search_query() ) );
							else :
								$page_title = sprintf( '<h1 class="page-title">%1$s</h2>', esc_html( 'Nothing Found', 'plate' ) );
							endif;
			}
		}

		echo ' <header class="entry-header">' . $page_title . '</header>';

	}
endif;



if ( ! function_exists( 'plate_pagination' ) ) :
	/**
	 * Returns the pagination for index, search and archivial views.
	 *
	 * Checks if the Jetpack infinite-scroll module is activated.
	 * If not, use the standard the_posts_pagination function. Create your own
	 * plate_pagination() to override the the_posts_pagination function in a child theme.
	 *
	 * @see http://wptheming.com/2013/04/check-if-jetpack-modules-are-enabled/
	 * @see https://codex.wordpress.org/Function_Reference/the_posts_pagination
	 */
	function plate_pagination() {

		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) :
else :

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous', 'plate' ),
					'next_text'          => esc_html__( 'Next', 'plate' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'plate' ) . ' </span>',
				)
			);

		endif;
	}
endif;



if ( ! function_exists( 'plate_background_color' ) ) :
	/**
	 * Return the hero background image.
	 *
	 * Checks if a color is selected on the page meta.
	 * Create your own plate_background_color() to override in a child theme.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
	 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
	 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail
	 */
	function plate_background_color() {
		global $post;

		$option = get_theme_mod( 'parallax_fade' );

		if ( ! $option ) {
			return;
		}

		if ( ! have_posts() ) {
			return;
		}

		$background_color     = get_post_meta( $post->ID, '_plate_hero_background_color', true );
		$global_hero_bg_color = get_theme_mod( 'plate_hero_background_color_default' );

		if ( ! $background_color ) {
			$background_color = $global_hero_bg_color;
		}

		echo '<div class="site-hero--background-color" style="background-color:' . $background_color . ';"></div>';

	}
endif;



if ( ! function_exists( 'plate_background_image' ) ) :
	/**
	 * Return the hero background image.
	 *
	 * Checks if a featured image is uploaded and creates a background image CSS rule.
	 * Fallback uses the get_header_image uploaded in the Customizer.
	 * Create your own plate_background_image() to override in a child theme.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
	 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
	 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail
	 */
	function plate_background_image() {
		global $post;

		if ( has_post_thumbnail() or get_header_image() ) {

			$image = null;
			if ( ! has_post_thumbnail() and get_header_image() ) :
				// If no featured image, and a header image.
				$image = get_header_image();
				else :
					// If featured image, use that instead - that way each page could have one.
					$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				endif;

				// On the blog index view, and singular posts page we want to display the main header image.
				if ( is_home() or is_singular( 'post' ) or is_search() or is_archive() ) :
					$image = get_header_image();
				endif;

				$hero_bg_img = 'background-image: url(' . $image . ');';

				return $hero_bg_img;
		}
	}
endif;



if ( ! function_exists( 'plate_video_data' ) ) :
	/**
	 * Return the hero background video.
	 *
	 * Checks if the relevant video files are uploaded via the Customizer.
	 * Create your own plate_video_data() to override in a child theme.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
	 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
	 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail
	 */
	function plate_video_hero() {

		$layout = get_theme_mod( 'plate_hero_format' );

		// We don't need this if the layout is 'image'
		if ( $layout == 'image' ) {
			return;
		}

		$mp4    = get_theme_mod( 'plate_hero_video_mp4' );
		$webm   = get_theme_mod( 'plate_hero_video_webm' );
		$ovg    = get_theme_mod( 'plate_hero_video_ovg' );
		$poster = get_theme_mod( 'plate_hero_video_poster' );

		// Only return if there's at least one video file.
		if ( ! $mp4 and ! $webm and ! $ovg ) {
			return;
		}

		if ( $mp4 ) {
			$mp4 = 'mp4:' . $mp4 . ',';
		}

		if ( $webm ) {
			$webm = 'webm:' . $webm . ',';
		}

		if ( $ovg ) {
			$ovg = 'ovg:' . $ovg . '';
		}

		if ( $poster ) {
			$poster = 'poster:' . $poster . '';
		}

		$output = 'data-vide-bg="' . $mp4 . $webm . $ovg . '" "data-vide-options="posterType: jpg"';

		$global = get_theme_mod( 'plate_hero_video_global' );

		// Check if we need to output the video on only the home page, or globally.
		if ( $global ) {
			echo balanceTags( $output );
		} else {
			if ( is_front_page() ) {
				echo balanceTags( $output );
			}
		}
	}
endif;

if ( ! function_exists( 'plate_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function plate_site_logo() {

		if ( has_custom_logo() ) {

			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
			?>

		<?php } else { ?>
			<h1 class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
}
	}

endif;

if ( ! function_exists( 'plate_footer_logo' ) ) :
	/**
	 * Output an <img> tag of the footer logo.
	 *
	 * Checks if a uploaded image is available. If so, use it.
	 * If not, there's a fallback of site_logo in the Theme Customizer.
	 */
	function plate_footer_logo() {
		/*
		 * If the retina_logo Customizer option is not selected,
		 * return early without loading the footer section.
		 */
		if ( get_theme_mod( 'footer_logo' ) ) {
	?>
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img style="<?php plate_retina_logo( 'footer' ); ?>" src="<?php echo esc_url( get_theme_mod( 'footer_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-logo"></a>
			<?php } else { ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
}
	}
endif;



if ( ! function_exists( 'plate_retina_logo' ) ) :
	/**
	 * Output the width of the uploaded image, at 1/2 the original size.
	 *
	 * Create your own plate_retina_logo() to override in a child theme.
	 */
	function plate_retina_logo( $location ) {

		if ( $location == 'footer' ) {
			$data = get_theme_mod( 'footer_logo_width' );
		} else {
			$data = get_theme_mod( 'site_logo_width' );
		}

		$width = 'width:' . $data . 'px;';
		echo esc_html( $width );
	}
endif;



if ( ! function_exists( 'plate_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function plate_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		global $post;

		if ( is_singular() ) :
	?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</div><!-- .post-thumbnail -->

		<?php
	else :
		$grid_img = get_post_meta( $post->ID, '_plate_grid_image', true );
		?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php if ( $grid_img ) { ?>
				<img src="<?php echo esc_url( $grid_img ); ?>">
			<?php
} else {
	the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) );
}
			?>
		</a>

	<?php
	endif; // End is_singular()
	}
endif;



if ( ! function_exists( 'plate_instagram_feed' ) ) :
	/**
	 * Detect Instagram Feed plugin. For use on Front End only.
	 * Create your own plate_instagram_feed() to override in a child theme.
	 */
	function plate_instagram_feed() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'instagram-feed/instagram-feed.php' ) ) {
			echo do_shortcode( '[instagram-feed]' );
		}
	}
endif;



if ( ! function_exists( 'plate_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * Create your own plate_entry_meta() to override in a child theme.
	 */
	function plate_entry_meta() {
		if ( 'post' == get_post_type() ) {
			$author_avatar_size = apply_filters( 'plate_author_avatar_size', 49 );
			printf(
				'<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a> %5$s </span></span>',
				esc_html_x( 'Drafted by', 'Used before post meta.', 'plate' ),
				esc_html_x( 'Author', 'Used before post author name.', 'plate' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() ),
				esc_html_x( 'on', 'Used after post author name.', 'plate' )
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) and is_singular() ) {
			plate_entry_date();
		}

		if ( 'post' == get_post_type() ) {
			plate_entry_categories();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'plate' ), get_the_title() ) );
			echo '</span>';
		}
	}
endif;



if ( ! function_exists( 'plate_entry_date' ) ) :
	/**
	 * Print HTML with date information for current post.
	 *
	 * Create your own plate_entry_date() to override in a child theme.
	 */
	function plate_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Posted on', 'Used before publish date.', 'plate' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;



if ( ! function_exists( 'plate_entry_categories' ) ) :
	/**
	 * Print HTML with categories for current post.
	 * Create your own plate_entry_categories() to override in a child theme.
	 */
	function plate_entry_categories() {

		if ( get_theme_mod( 'post_categories' ) == true || is_customize_preview() ) :

			$categories_list       = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'plate' ) );
			$categories_visibility = ( false == get_theme_mod( 'post_categories' ) ) ? 'hidden' : '';

			if ( $categories_list && plate_categorized_blog() ) {
				printf(
					' <div class="cat-links %1$s"><span> %2$s </span> %3$s</div> ',
					esc_html( $categories_visibility ),
					esc_html_x( 'in', 'Used before category names.', 'plate' ),
					$categories_list
				);
			}
		endif;
	}
endif;




if ( ! function_exists( 'plate_entry_tags' ) ) :
	/**
	 * Print HTML with tags for current post.
	 * Create your own plate_entry_tags() to override in a child theme.
	 */
	function plate_entry_tags() {

		if ( get_theme_mod( 'post_tags' ) == true || is_customize_preview() ) :

			$tags_list       = get_the_tag_list( '', esc_html_x( ' ', 'Used between list items, there is a space after the comma.', 'plate' ) );
			$tags_visibility = ( false == get_theme_mod( 'post_tags' ) ) ? 'hidden' : '';

			if ( $tags_list ) {
				printf(
					'<div class="tags-links %1$s">%2$s</div>',
					esc_html( $tags_visibility ),
					$tags_list
				);
			}
		endif;
	}
endif;




/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function plate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'plate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'plate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so plate_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so plate_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in { @see plate_categorized_blog() }.
 */
function plate_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'plate_categories' );
}
add_action( 'edit_category', 'plate_category_transient_flusher' );
add_action( 'save_post', 'plate_category_transient_flusher' );




if ( ! function_exists( 'plate_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 * Create your own plate_entry_tags() to override in a child theme.
	 */
	function plate_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'plate' ); ?></h2>
		<div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'plate' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'plate' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;
