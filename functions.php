<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

if ( ! defined( 'PLATE_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'PLATE_DEBUG', true );
endif;

if ( ! defined( 'PLATE_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'PLATE_DEBUG' ) || true === PLATE_DEBUG ) {
		define( 'PLATE_ASSET_SUFFIX', null );
	} else {
		define( 'PLATE_ASSET_SUFFIX', '.min' );
	}
endif;

if ( ! function_exists( 'plate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function plate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on @@pkg.name, use a find and replace
		 * to change 'plate' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'plate', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Filter Plate's custom-background support argument.
		 *
		 * @param array $args {
		 *     An array of custom-background support arguments.
		 * }
		 */
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 2000, 0, true );
			add_image_size( 'plate_port-full', 9999, 9999, false );
			add_image_size( 'plate_port-grid', 500, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'plate' ),
				'footer'  => esc_html__( 'Footer', 'plate' ),
				'social'  => esc_html__( 'Social', 'plate' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'video',
				'image',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style.
		 */
		add_editor_style( array( 'assets/css/editor' . PLATE_ASSET_SUFFIX . '.css', plate_fonts_url() ) );

		/*
		 * Enable support for Customizer Selective Refresh.
		 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for the WordPress default Theme Logo
		 * See: https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 200,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'plate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function plate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'plate_content_width', 700 );
}
add_action( 'after_setup_theme', 'plate_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function plate_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Single Post', 'plate' ),
			'id'            => 'sidebar-6',
			'description'   => esc_html__( 'Appears on the blogroll and single post pages.', 'plate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Single Page', 'plate' ),
			'id'            => 'sidebar-7',
			'description'   => esc_html__( 'Appears on the single pages if a widget area layout is selected.', 'plate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Home', 'plate' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears on the home template.', 'plate' ),
			'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'plate' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Appears above the fullwith footer, on all pages and posts. You may use widgets labeled "Home" here.', 'plate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Only add this widget area if the footer layout option is set to display these widget areas.
	if ( 'columns' === get_theme_mod( 'plate_footer_layout' ) ) :

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 1', 'plate' ),
				'id'            => 'sidebar-3',
				'description'   => esc_html__( 'Appears on the first column of the footer, on all pages and posts.', 'plate' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 2', 'plate' ),
				'id'            => 'sidebar-4',
				'description'   => esc_html__( 'Appears on the second column of the footer, on all pages and posts.', 'plate' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 3', 'plate' ),
				'id'            => 'sidebar-5',
				'description'   => esc_html__( 'Appears on the third column of the footer, on all pages and posts.', 'plate' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);

	endif;
}
add_action( 'widgets_init', 'plate_widgets_init' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function plate_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_enqueue_scripts', 'plate_javascript_detection', 0 );

if ( ! function_exists( 'plate_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function plate_scripts() {

		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'plate-fonts', plate_fonts_url(), array(), null );

		// Load theme styles.
		if ( is_child_theme() ) {
			wp_enqueue_style( 'plate-style', get_parent_theme_file_uri( '/style' . PLATE_ASSET_SUFFIX . '.css' ) );
			wp_enqueue_style( 'plate-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
		} else {
			wp_enqueue_style( 'plate-style', get_theme_file_uri( '/style' . PLATE_ASSET_SUFFIX . '.css' ) );
		}

		// Load the standard WordPress comments reply javascript.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'masonry' );

		/**
		 * Now let's check the same for the scripts.
		 */
		if ( SCRIPT_DEBUG || PLATE_DEBUG ) {
			wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'superslides', get_theme_file_uri( '/assets/js/vendors/superslides.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/js/vendors/slick.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'photoswipe', get_theme_file_uri( '/assets/js/vendors/photoswipe.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'photoswipe-ui', get_theme_file_uri( '/assets/js/vendors/photoswipe-ui-default.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'vide', get_theme_file_uri( '/assets/js/vendors/vide.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'lity', get_theme_file_uri( '/assets/js/vendors/lity.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'parallax', get_theme_file_uri( '/assets/js/vendors/parallax.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'superfish', get_theme_file_uri( '/assets/js/vendors/superfish.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'animsition', get_theme_file_uri( '/assets/js/vendors/animsition.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'plate-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );
		} else {
			wp_enqueue_script( 'plate-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'plate-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'plate_scripts' );
endif;

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v1.4.2 @@pkg.plate has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function plate_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'plate_child_scripts', 10 );
}
add_action( 'init', 'plate_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Register Google fonts for Plate.
 *
 * @return string Google fonts URL for the theme.
 */
function plate_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

	/* translators: If there are characters in your language that are not supported by PT Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Pt Sans font: on or off', 'plate' ) ) {
		$fonts[] = 'PT Sans:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'plate' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg(
			array(
				'family' => rawurlencode( implode( '|', $fonts ) ),
				'subset' => rawurlencode( $subsets ),
			), 'https://fonts.googleapis.com/css'
		);
	}

	return $fonts_url;
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls           URLs to print for resource hints.
 * @param  string $relation_type  The relation type the URLs are printed.
 * @return array  $urls           URLs to print for resource hints.
 */
function plate_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'plate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'plate_resource_hints', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function plate_enqueue_admin_style() {
	wp_enqueue_style( 'plate-admin-style', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version' );
}
add_action( 'admin_enqueue_scripts', 'plate_enqueue_admin_style' );

/**
 * Load required scripts for custom widgets.
 */
function plate_enqueue_admin_scripts() {
	global $pagenow, $wp_customize;

	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'widget-image-upload', get_theme_file_uri( '/assets/js/admin/admin.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_style( 'wp-color-picker' );

	}
}
add_action( 'admin_enqueue_scripts', 'plate_enqueue_admin_scripts' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function plate_meta_enqueue_admin_script( $hook ) {

	if ( 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
		return;
	}

	wp_enqueue_script( 'plate-post-meta', get_theme_file_uri( '/assets/js/admin/post-meta.js' ), array( 'jquery' ), '@@pkg.version', true );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'plate_meta_enqueue_admin_script' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function plate_body_classes( $classes ) {

	if ( get_theme_mod( 'fixed_navigation', false ) ) {
		$classes[] = 'fixed-navigation';
	}

	if ( get_theme_mod( 'parallax_fade', false ) ) {
		$classes[] = 'parallax-fade';
	}

	if ( get_theme_mod( 'image_zoom', false ) ) {
		$classes[] = 'image-zoom';
	}

	if ( get_theme_mod( 'announcement_bar', false ) ) {
		$classes[] = 'has-announcement';
	}

	return $classes;
}
add_filter( 'body_class', 'plate_body_classes' );

if ( ! function_exists( 'plate_browser_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array (Maybe) filtered body classes.
	 */
	function plate_browser_body_classes( $classes ) {
		global $is_lynx, $is_gecko, $is_ie, $is_opera, $is_ns4, $is_safari, $is_chrome, $is_iphone;

		if ( $is_lynx ) {
			$classes[] = 'lynx';
		} elseif ( $is_gecko ) {
			$classes[] = 'gecko';
		} elseif ( $is_opera ) {
			$classes[] = 'opera';
		} elseif ( $is_ns4 ) {
			$classes[] = 'ns4';
		} elseif ( $is_safari ) {
			$classes[] = 'safari';
		} elseif ( $is_chrome ) {
			$classes[] = 'chrome';
		} elseif ( $is_ie ) {
			$classes[] = 'ie';
			if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
				$classes[] = 'ie' . $browser_version[1];
			}
		} else {
			$classes[] = 'unknown';
		}

		if ( $is_iphone ) {
			$classes[] = 'iphone';
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'plate_browser_body_classes' );

if ( ! function_exists( 'plate_protected_title_format' ) ) :
	/**
	 * Filter the text prepended to the post title for protected posts.
	 * Create your own plate_protected_title_format() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
	 */
	function plate_protected_title_format( $title ) {
		return '%s';
	}
	add_filter( 'protected_title_format', 'plate_protected_title_format' );
endif;

if ( ! function_exists( 'plate_protected_form' ) ) :
	/**
	 * Filter the HTML output for the protected post password form.
	 * Create your own plate_protected_form() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
	 * @link https://codex.wordpress.org/Using_Password_Protection
	 */
	function plate_protected_form() {
		global $post;

		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	    <label for="' . $label . '">' . __( 'Password:', 'plate' ) . ' </label><input name="post_password" placeholder="' . __( 'Enter password here & press enter...', 'plate' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'plate' ) . '" />
	    </form>
	    ';

		return $o;
	}
	add_filter( 'the_password_form', 'plate_protected_form' );
endif;



if ( ! function_exists( 'plate_comments' ) ) :
	/**
	 * Define custom callback function for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 *
	 * Create your own plate_comments() to override in a child theme.
	 */
	function plate_comments( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;

		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		} ?>

		<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>

			<footer class="comment-meta">

				<div class="comment-author vcard">
					<div class="avatar-wrapper">
						<?php
						if ( $args['avatar_size'] != 0 ) {
							echo get_avatar( $comment, $args['avatar_size'] );}
?>
					</div>

					<div class="comment-metadata">
						<?php printf( __( '<b class="fn">%s</b> <span class="says">says:</span>', 'plate' ), get_comment_author_link() ); ?>

						<span class="comment-date">
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
								printf( esc_html__( '%1$s at %2$s', 'plate' ), get_comment_date(), get_comment_time() );
								?>
								</a>
								<?php
								edit_comment_link( __( 'Edit', 'plate' ), '', '' );
							?>
							<?php
							comment_reply_link(
								array_merge(
									$args, array(
										'add_below' => $add_below,
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
?>

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<span class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation', 'plate' ); ?></span>
							<?php endif; ?>
						</span>
					</div>

				</div>

			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

		<?php if ( 'div' != $args['style'] ) : ?>
			</article>
		<?php
		endif;
	}
endif;



/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function plate_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function plate_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'plate_widget_tag_cloud_args' );

if ( ! function_exists( 'plate_read_more_link' ) ) :
	/**
	 * Customizing the Read More.
	 * Create your own plate_read_more_link() to override in a child theme.
	 *
	 * @link https://codex.wordpress.org/Customizing_the_Read_More
	 */
	function plate_read_more_link() {}
	add_filter( 'the_content_more_link', 'plate_read_more_link' );
endif;

if ( ! function_exists( 'plate_custom_excerpt_length' ) ) :
	/**
	 * Filter the except length to 20 characters.
	 * Create your own plate_custom_excerpt_length() to override in a child theme.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	function plate_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'plate_custom_excerpt_length', 999 );
endif;

if ( ! function_exists( 'plate_excerpt_more' ) ) :
	/**
	 * Filter the excerpt "read more" string.
	 * Create your own plate_excerpt_more() to override in a child theme.
	 *
	 * @param string $more "Read more" excerpt string.
	 */
	function plate_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'plate_excerpt_more' );
endif;

if ( ! function_exists( 'plate_single_cpt_redirect' ) ) :
	/**
	 * No single views for Team and Portfolio Custom Post Types
	 * Create your own plate_single_cpt_redirect() in a child theme to override this behavior.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_redirect
	 */
	function plate_single_cpt_redirect() {

		$queried_post_type = get_query_var( 'post_type' );

		if ( is_single() && 'team' === $queried_post_type ) {
			wp_safe_redirect( esc_url( home_url( '/' ) ), 301 );
			exit;
		}

		if ( is_single() && 'portfolio' === $queried_post_type ) {
			wp_safe_redirect( esc_url( home_url( '/' ) ), 301 );
			exit;
		}
	}
endif;
add_action( 'template_redirect', 'plate_single_cpt_redirect' );

if ( ! function_exists( 'plate_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function plate_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'plate_pingback_header' );
endif;

/**
 * Post meta.
 */
require get_theme_file_path( '/inc/meta/metaboxes.php' );
require get_theme_file_path( '/inc/meta/meta-page.php' );
require get_theme_file_path( '/inc/meta/meta-team.php' );
require get_theme_file_path( '/inc/meta/meta-post.php' );

/**
 * Editor formats.
 */
require get_theme_file_path( '/inc/editor-formats.php' );

/**
 * Custom header.
 */
require get_theme_file_path( '/inc/custom-header.php' );

/**
 * Customizer.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Template tags.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Jetpack.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-ad.php' );
require get_theme_file_path( '/inc/widgets/widget-cta.php' );
require get_theme_file_path( '/inc/widgets/widget-location.php' );
require get_theme_file_path( '/inc/widgets/widget-page.php' );
require get_theme_file_path( '/inc/widgets/widget-page-fullwidth.php' );
require get_theme_file_path( '/inc/widgets/widget-grid-gallery.php' );
require get_theme_file_path( '/inc/widgets/widget-parallax-gallery.php' );
require get_theme_file_path( '/inc/widgets/widget-content-block.php' );
require get_theme_file_path( '/inc/widgets/widget-features-3col.php' );
require get_theme_file_path( '/inc/widgets/widget-split-screen.php' );
require get_theme_file_path( '/inc/widgets/widget-lightbox-video.php' );
require get_theme_file_path( '/inc/widgets/widget-fullscreen-title.php' );
require get_theme_file_path( '/inc/widgets/widget-title.php' );
require get_theme_file_path( '/inc/widgets/widget-column-blocks.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
