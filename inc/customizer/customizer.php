<?php
/**
 * Theme Customizer functionality
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function plate_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'settings'        => array( 'blogname' ),
			'render_callback' => 'plate_customize_partial_blogname',
		)
	);

	/**
	 * Move, remove or rename controls.
	 */
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->get_control( 'header_image' )->section         = 'plate_hero_format_section';
	$wp_customize->get_control( 'header_image' )->label           = esc_html__( 'Hero Image', 'plate' );
	$wp_customize->get_control( 'header_image' )->active_callback = 'plate_hero_format_image_callback';

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel(
		'plate_theme_options', array(
			'title'       => esc_html__( 'Theme Options', 'plate' ),
			'description' => esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'plate' ),
			'priority'    => 30,
		)
	);

	/**
	 * Add the site logo max-width option to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => '250',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => '250',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Logo Max Width', 'plate' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 2,
				),
			)
		)
	);

		/**
		 * Add the hero section.
		 */
		$wp_customize->add_section(
			'plate_body', array(
				'title' => esc_html__( 'Colors', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'plate_background_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_background_color', array(
						'label'       => esc_html__( 'Background Color', 'plate' ),
						'description' => esc_html__( 'Select a background color for the site. This will be applied globally throughout the site.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_content_text_color', array(
					'default'           => '#6D6D73',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_content_text_color', array(
						'label'       => esc_html__( 'Text Color', 'plate' ),
						'description' => esc_html__( 'Select a text color for the site. This applies to all the text throughout the site.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

			$wp_customize->add_setting(
				'theme_accent_color', array(
					'default'           => '#50B29E',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'theme_accent_color', array(
						'label'       => esc_html__( 'Accent Color', 'plate' ),
						'description' => esc_html__( 'Select a accent color for the site, which is used throughout various elements in the theme.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_headers_color', array(
					'default'           => '#24252f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_headers_color', array(
						'label'       => esc_html__( 'Header Color', 'plate' ),
						'description' => esc_html__( 'Select a color for the site typography headers. For example: H1, H2, H3, H4, H5, H6.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_content_header_color', array(
					'default'           => '#24252f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_content_header_color', array(
						'label'       => esc_html__( 'Widget Header Color', 'plate' ),
						'description' => esc_html__( 'Select a color for the headers on the Home template and fullwidth footer area.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_404_background_color', array(
					'default'           => '#24252f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_404_background_color', array(
						'label'       => esc_html__( '404 Background Color', 'plate' ),
						'description' => esc_html__( 'Select a background color for the site 404 page.', 'plate' ),
						'section'     => 'plate_body',
					)
				)
			);

		/**
		 * Add the hero section.
		 */
		$wp_customize->add_section(
			'plate_hero', array(
				'title' => esc_html__( 'Hero', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'parallax_fade', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'parallax_fade', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Enable Parallax Fade', 'plate' ),
					'description' => esc_html__( 'Enable the parallax fade out attribute for the site hero area.', 'plate' ),
					'section'     => 'plate_hero',
				)
			);

			$wp_customize->add_setting(
				'image_zoom', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'image_zoom', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Enable Image Zoom', 'plate' ),
					'description' => esc_html__( 'Enable the image zoom attribute for the site hero area. This only works on image backgrounds.', 'plate' ),
					'section'     => 'plate_hero',
				)
			);

			$wp_customize->add_setting(
				'plate_hero_background_color_default', array(
					'default'           => '#26262F',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_hero_background_color_default', array(
						'label'       => esc_html__( 'Background', 'plate' ),
						'description' => esc_html__( 'Select the default background color of the hero area. You can override this color on individual pages via the page meta.', 'plate' ),
						'section'     => 'plate_hero',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_hero_header_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_hero_header_color', array(
						'label'       => esc_html__( 'Title Color', 'plate' ),
						'description' => esc_html__( 'Select the text color of the hero area header.', 'plate' ),
						'section'     => 'plate_hero',
					)
				)
			);

		/**
		 * Add the hero format section.
		 */
		$wp_customize->add_section(
			'plate_hero_format_section', array(
				'title' => esc_html__( 'Hero Format', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'plate_hero_format', array(
					'sanitize_callback' => 'plate_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'plate_hero_format', array(
					'type'     => 'select',
					'label'    => esc_html__( 'Hero Format', 'plate' ),
					'section'  => 'plate_hero_format_section',
					'priority' => 1,
					'choices'  => array(
						'image' => esc_html__( 'Image', 'plate' ),
						'video' => esc_html__( 'Video', 'plate' ),
					),
				)
			);

			$wp_customize->add_setting(
				'plate_hero_video_global', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'plate_hero_video_global', array(
					'type'            => 'checkbox',
					'label'           => esc_html__( 'Force the video on all pages.', 'plate' ),
					'section'         => 'plate_hero_format_section',
					'active_callback' => 'plate_hero_format_video_callback',
					'priority'        => 1,
				)
			);

			$wp_customize->add_setting(
				'plate_hero_video_poster', array(
					'sanitize_callback' => 'plate_sanitize_image',
					'default'           => get_header_image(),
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 'plate_hero_video_poster', array(
						'label'           => esc_html__( 'Poster Image', 'plate' ),
						'description'     => esc_html__( 'Upload a poster imag (.JPG) for your video, to show on mobile devices. Your video and poster must have the same file names.', 'plate' ),
						'section'         => 'plate_hero_format_section',
						'settings'        => 'plate_hero_video_poster',
						'active_callback' => 'plate_hero_format_video_callback',
						'priority'        => 2,
					)
				)
			);

			$wp_customize->add_setting(
				'plate_hero_video_mp4', array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Upload_Control(
					$wp_customize, 'plate_hero_video_mp4', array(
						'label'           => esc_html__( 'Upload Video MP4', 'plate' ),
						'section'         => 'plate_hero_format_section',
						'settings'        => 'plate_hero_video_mp4',
						'active_callback' => 'plate_hero_format_video_callback',
						'priority'        => 2,
					)
				)
			);

			$wp_customize->add_setting(
				'plate_hero_video_webm', array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Upload_Control(
					$wp_customize, 'plate_hero_video_webm', array(
						'label'           => esc_html__( 'Upload Video WebM', 'plate' ),
						'section'         => 'plate_hero_format_section',
						'settings'        => 'plate_hero_video_webm',
						'active_callback' => 'plate_hero_format_video_callback',
						'priority'        => 3,
					)
				)
			);

			$wp_customize->add_setting(
				'plate_hero_video_ovg', array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Upload_Control(
					$wp_customize, 'plate_hero_video_ovg', array(
						'label'           => esc_html__( 'Upload Video OVG', 'plate' ),
						'section'         => 'plate_hero_format_section',
						'settings'        => 'plate_hero_video_ovg',
						'active_callback' => 'plate_hero_format_video_callback',
						'priority'        => 4,
					)
				)
			);

		/**
		 * Add the navigation section.
		 */
		$wp_customize->add_section(
			'plate_navigation', array(
				'title' => esc_html__( 'Navigation', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'fixed_navigation', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'fixed_navigation', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Enable Fixed Navigation', 'plate' ),
					'description' => esc_html__( 'Enable the fixed navigation element on desktop.', 'plate' ),
					'section'     => 'plate_navigation',
				)
			);

			$wp_customize->add_setting(
				'plate_nav_a_color', array(
					'default'           => '#26262F',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_nav_a_color', array(
						'label'       => esc_html__( 'Color', 'plate' ),
						'description' => esc_html__( 'Select the default text color of links in the main navigational element of the theme.', 'plate' ),
						'section'     => 'plate_navigation',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_nav_fixed_background_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_nav_fixed_background_color', array(
						'label'           => esc_html__( 'Fixed Background', 'plate' ),
						'description'     => esc_html__( 'Select the background color of the active state of a link on the fixed navigation.', 'plate' ),
						'section'         => 'plate_navigation',
						'active_callback' => 'plate_fixed_navigation_callback',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_nav_fixed_a_color', array(
					'default'           => '#26262F',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_nav_fixed_a_color', array(
						'label'           => esc_html__( 'Fixed Color', 'plate' ),
						'description'     => esc_html__( 'Select the default text color of links in the fixed navigational element of the theme.', 'plate' ),
						'section'         => 'plate_navigation',
						'active_callback' => 'plate_fixed_navigation_callback',
					)
				)
			);

		/**
		 * Add the announcement section.
		 */
		$wp_customize->add_section(
			'plate_announcement', array(
				'title' => esc_html__( 'Announcement', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'announcement_bar', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'announcement_bar', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Enable Announcement Bar', 'plate' ),
					'description' => esc_html__( 'Enable the announcemnet bar above the site content throughout the website.', 'plate' ),
					'section'     => 'plate_announcement',
				)
			);

			$wp_customize->add_setting(
				'announcement_bar_text', array(
					'default'           => '',
					'sanitize_callback' => 'plate_sanitize_html',
				)
			);

			$wp_customize->add_control(
				'announcement_bar_text', array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Announcement Text', 'plate' ),
					'description' => esc_html__( 'Add the announcement text to be added to the announcement bar.', 'plate' ),
					'section'     => 'plate_announcement',
				)
			);

			$wp_customize->add_setting(
				'plate_announcement_bar_color', array(
					'default'           => '#24252f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_announcement_bar_color', array(
						'label'       => esc_html__( 'Background Color', 'plate' ),
						'description' => esc_html__( 'Select a color for background of the announcement bar.', 'plate' ),
						'section'     => 'plate_announcement',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_announcement_bar_text_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_announcement_bar_text_color', array(
						'label'       => esc_html__( 'Color', 'plate' ),
						'description' => esc_html__( 'Select a text color for the announcement bar paragraph text.', 'plate' ),
						'section'     => 'plate_announcement',
					)
				)
			);

	/**
	 * Add the blog section.
	 */
	$wp_customize->add_section(
		'plate_blog', array(
			'title' => esc_html__( 'Blog', 'plate' ),
			'panel' => 'plate_theme_options',
		)
	);

			$wp_customize->add_setting(
				'plate_post_layout', array(
					'default'           => 'layout_right_sidebar',
					'sanitize_callback' => 'plate_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'plate_post_layout', array(
					'type'    => 'select',
					'label'   => esc_html__( 'Post Layout', 'plate' ),
					'section' => 'plate_blog',
					'choices' => array(
						'layout_right_sidebar' => esc_html__( 'Right Sidebar', 'plate' ),
						'layout_fullwidth'     => esc_html__( 'Fullwidth', 'plate' ),
					),
				)
			);

			$wp_customize->add_setting(
				'post_categories', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'post_categories', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show post categories', 'plate' ),
					'description' => esc_html__( 'Enable post category meta beneath the single post in the entry footer.', 'plate' ),
					'section'     => 'plate_blog',
				)
			);

			$wp_customize->add_setting(
				'post_tags', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'post_tags', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show post tags', 'plate' ),
					'description' => esc_html__( 'Enable post tag meta beneath the single post in the entry footer.', 'plate' ),
					'section'     => 'plate_blog',
				)
			);

	/**
	 * Add the contact section.
	 */
	$wp_customize->add_section(
		'plate_contact', array(
			'title' => esc_html__( 'Contact', 'plate' ),
			'panel' => 'plate_theme_options',
		)
	);

			$wp_customize->add_setting(
				'contact_email', array(
					'default'           => '',
					'sanitize_callback' => 'is_email',
				)
			);

			$wp_customize->add_control(
				'contact_email', array(
					'type'        => 'email',
					'label'       => esc_html__( 'Email Address', 'plate' ),
					'description' => esc_html__( 'Enter the email address you would like the contact form to send to.', 'plate' ),
					'section'     => 'plate_contact',
				)
			);

			$wp_customize->add_setting(
				'contact_button', array(
					'default'           => '',
					'sanitize_callback' => 'plate_sanitize_nohtml',
				)
			);

			$wp_customize->add_control(
				'contact_button', array(
					'type'        => 'text',
					'label'       => esc_html__( 'Contact Button', 'plate' ),
					'description' => esc_html__( 'Enter the text of the contact form button.', 'plate' ),
					'section'     => 'plate_contact',
				)
			);

			$wp_customize->add_setting(
				'contact_map_shortcode', array(
					'default'           => '[google_maps id="XXX"]',
					'sanitize_callback' => 'plate_sanitize_html',
				)
			);

			$wp_customize->add_control(
				'contact_map_shortcode', array(
					'type'        => 'url',
					'label'       => esc_html__( 'Map Shortcode', 'plate' ),
					'description' => esc_html__( 'Add a map to your contact template via Google Maps Builder by adding in a map shortcode.', 'plate' ),
					'section'     => 'plate_contact',
				)
			);

			$wp_customize->add_setting(
				'contact_map_address', array(
					'default'           => '350 5th Avenue<br>New York NY10118',
					'sanitize_callback' => 'plate_sanitize_html',
				)
			);

			$wp_customize->add_control(
				'contact_map_address', array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Map Address', 'plate' ),
					'description' => esc_html__( 'Add your address to be overlaid on the contact template map section.', 'plate' ),
					'section'     => 'plate_contact',
				)
			);

			$wp_customize->add_setting(
				'contact_img', array(
					'sanitize_callback' => 'plate_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 'contact_img', array(
						'label'       => esc_html__( 'Image', 'plate' ),
						'description' => esc_html__( 'Upload an image to show on the contact template.', 'plate' ),
						'section'     => 'plate_contact',
						'settings'    => 'contact_img',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_address_circle_background', array(
					'default'           => '#26262f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_address_circle_background', array(
						'label'       => esc_html__( 'Address Background', 'plate' ),
						'description' => esc_html__( 'Select a background color for address circle overlay on the map.', 'plate' ),
						'section'     => 'plate_contact',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_address_circle_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_address_circle_color', array(
						'label'       => esc_html__( 'Address Text', 'plate' ),
						'description' => esc_html__( 'Select a text color for address circle overlay on the map.', 'plate' ),
						'section'     => 'plate_contact',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_contact_btn_background', array(
					'default'           => '#26262f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_contact_btn_background', array(
						'label'       => esc_html__( 'Contact Button', 'plate' ),
						'description' => esc_html__( 'Select a background color for contact form submit button.', 'plate' ),
						'section'     => 'plate_contact',
					)
				)
			);

		/**
		 * Add the footer section.
		 */
		$wp_customize->add_section(
			'plate_footer', array(
				'title' => esc_html__( 'Footer', 'plate' ),
				'panel' => 'plate_theme_options',
			)
		);

			$wp_customize->add_setting(
				'plate_footer_layout', array(
					'default'           => 'fullwidth',
					'sanitize_callback' => 'plate_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'plate_footer_layout', array(
					'type'        => 'select',
					'label'       => esc_html__( 'Layout', 'plate' ),
					'description' => esc_html__( 'Select a centered and fullwidth layout option, or a columned footer widget area.', 'plate' ),
					'section'     => 'plate_footer',
					'choices'     => array(
						'fullwidth' => esc_html__( 'Fullwidth, Centered', 'plate' ),
						'columns'   => esc_html__( 'Three Column, Widgets', 'plate' ),
					),
				)
			);

			$wp_customize->add_setting(
				'powered_by_plate', array(
					'default'           => true,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'powered_by_plate', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Powered by Plate', 'plate' ),
					'section' => 'plate_footer',
				)
			);

			$wp_customize->add_setting(
				'powered_by_wordpress', array(
					'default'           => false,
					'sanitize_callback' => 'plate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'powered_by_wordpress', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Powered by WordPress', 'plate' ),
					'section' => 'plate_footer',
				)
			);

			$wp_customize->add_setting(
				'footer_copyright_text', array(
					'default'           => '',
					'sanitize_callback' => 'plate_sanitize_html',
				)
			);

			$wp_customize->add_control(
				'footer_copyright_text', array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Copyright', 'plate' ),
					'description' => esc_html__( 'Add custom footer copy after the copyright.', 'plate' ),
					'section'     => 'plate_footer',
				)
			);

			$wp_customize->add_setting(
				'footer_logo', array(
					'sanitize_callback' => 'plate_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 'footer_logo', array(
						'label'    => esc_html__( 'Footer Logo', 'plate' ),
						'section'  => 'plate_footer',
						'settings' => 'footer_logo',
					)
				)
			);

			$wp_customize->add_setting(
				'footer_logo_width', array(
					'default'           => '102',
					'sanitize_callback' => 'plate_sanitize_nohtml',
				)
			);

			$wp_customize->add_control(
				'footer_logo_width', array(
					'type'        => 'text',
					'label'       => esc_html__( 'Retina Logo Width', 'plate' ),
					'description' => esc_html__( 'This value should be equal to half of the footer logo image width (in px).', 'plate' ),
					'section'     => 'plate_footer',
				)
			);

			$wp_customize->add_setting(
				'plate_footer_background', array(
					'default'           => '#24252f',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_background', array(
						'label'       => esc_html__( 'Background', 'plate' ),
						'section'     => 'plate_footer',
						'description' => esc_html__( 'Select the background color for the site footer element.', 'plate' ),
					)
				)
			);

			$wp_customize->add_setting(
				'plate_footer_color', array(
					'default'           => '#6D6D73',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_color', array(
						'label'           => esc_html__( 'Color', 'plate' ),
						'section'         => 'plate_footer',
						'description'     => esc_html__( 'Select the text color for the site footer element.', 'plate' ),
						'active_callback' => 'plate_footer_layout_fullwidth_callback',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_footer_title_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_title_color', array(
						'label'           => esc_html__( 'Widget Title Color', 'plate' ),
						'description'     => esc_html__( 'Select a color for the widget titles.', 'plate' ),
						'section'         => 'plate_footer',
						'active_callback' => 'plate_footer_layout_columns_callback',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_footer_widget_color', array(
					'default'           => '#6D6D73',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_widget_color', array(
						'label'           => esc_html__( 'Widget Text Color', 'plate' ),
						'description'     => esc_html__( 'Select a color for the widget text.', 'plate' ),
						'section'         => 'plate_footer',
						'active_callback' => 'plate_footer_layout_columns_callback',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_footer_link_color', array(
					'default'           => '#6D6D73',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_link_color', array(
						'label'           => esc_html__( 'Widget Link Color', 'plate' ),
						'description'     => esc_html__( 'Select a color for links within each widget.', 'plate' ),
						'section'         => 'plate_footer',
						'active_callback' => 'plate_footer_layout_columns_callback',
					)
				)
			);

			$wp_customize->add_setting(
				'plate_footer_link_hover_color', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'plate_footer_link_hover_color', array(
						'label'           => esc_html__( 'Widget Link Hover Color', 'plate' ),
						'description'     => esc_html__( 'Select a hover color for links within each widget.', 'plate' ),
						'section'         => 'plate_footer',
						'active_callback' => 'plate_footer_layout_columns_callback',
					)
				)
			);

	/**
	 * Set transports for the Customizer.
	 */
	$wp_customize->get_setting( 'plate_footer_background' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'plate_footer_color' )->transport                = 'postMessage';
	$wp_customize->get_setting( 'plate_background_color' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'plate_content_header_color' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'plate_content_text_color' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'plate_nav_a_color' )->transport                 = 'postMessage';
	$wp_customize->get_setting( 'plate_footer_title_color' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'plate_footer_widget_color' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'plate_footer_link_color' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'plate_footer_link_hover_color' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'plate_hero_header_color' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'post_categories' )->transport                   = 'postMessage';
	$wp_customize->get_setting( 'post_tags' )->transport                         = 'postMessage';
	$wp_customize->get_setting( 'plate_nav_fixed_background_color' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'plate_nav_fixed_a_color' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'announcement_bar' )->transport                  = 'postMessage';
	$wp_customize->get_setting( 'announcement_bar_text' )->transport             = 'postMessage';
	$wp_customize->get_setting( 'plate_announcement_bar_color' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'plate_announcement_bar_text_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'plate_headers_color' )->transport               = 'postMessage';
	$wp_customize->get_setting( 'powered_by_plate' )->transport                  = 'postMessage';
	$wp_customize->get_setting( 'powered_by_wordpress' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'footer_copyright_text' )->transport             = 'postMessage';
}

add_action( 'customize_register', 'plate_customize_register', 11 );


/**
 * Render the site title for the selective refresh partial.
 *
 * @see york_customize_register()
 *
 * @return void
 */
function plate_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Customizer Custom Callbacks
 *
 * Only displays the current skin customizer options, if neccessary.
 */
function plate_hero_format_video_callback( $control ) {
	if ( $control->manager->get_setting( 'plate_hero_format' )->value() === 'video' ) {
		return true;
	} else {
		return false;
	}
}

function plate_hero_format_image_callback( $control ) {
	if ( $control->manager->get_setting( 'plate_hero_format' )->value() === 'image' ) {
		return true;
	} else {
		return false;
	}
}

function plate_footer_layout_columns_callback( $control ) {
	if ( $control->manager->get_setting( 'plate_footer_layout' )->value() === 'columns' ) {
		return true;
	} else {
		return false;
	}
}

function plate_footer_layout_fullwidth_callback( $control ) {
	if ( $control->manager->get_setting( 'plate_footer_layout' )->value() === 'fullwidth' ) {
		return true;
	} else {
		return false;
	}
}

function plate_fixed_navigation_callback( $control ) {
	if ( $control->manager->get_setting( 'fixed_navigation' )->value() === true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function plate_customize_preview_js() {
	wp_enqueue_script( 'plate-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . PLATE_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'plate_customize_preview_js' );
