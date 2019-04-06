<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Column_Blocks' );
	}
);

class Plate_Column_Blocks extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'plate_columns_blocks', // Base ID
			esc_html__( 'Column Blocks', 'plate' ), // Name
			array(
				'classname'                   => 'widget--col-blocks', // Classes
				'description'                 => esc_html__( 'Displays up to three blocks across. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title_1'          => '',
			'image_1'          => '',
			'a_1'              => '',
			'title_2'          => '',
			'image_2'          => '',
			'a_2'              => '',
			'title_3'          => '',
			'image_3'          => '',
			'a_3'              => '',
			'background_color' => '',
			'text_color'       => '',
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$title_1 = $instance['title_1'];
		$image_1 = $instance['image_1'];
		$a_1     = $instance['a_1'];
		$title_2 = $instance['title_2'];
		$image_2 = $instance['image_2'];
		$a_2     = $instance['a_2'];
		$title_3 = $instance['title_3'];
		$image_3 = $instance['image_3'];
		$a_3     = $instance['a_3'];

		// Before
		echo balanceTags( $before_widget );

		// Content
		if ( $instance['text_color'] ) {
			echo '<style>body .widget--col-blocks .col-block h6 {color:' . $instance['text_color'] . '}</style>';
		}

		// Now you loop through each image
		for ( $x = 1; $x <= 3; $x++ ) {

			// Set the variables
			$title = $instance[ 'title_' . $x ];
			$image = $instance[ 'image_' . $x ];
			$a     = $instance[ 'a_' . $x ];

			echo '<div class="col-block col-block-' . $x . '">';

			if ( $a ) {
				echo '<a href="' . esc_url( $a ) . '"></a>'; }

			if ( $title ) {
				echo '<h6>' . esc_html( $title ) . '</h6>';
			}

				echo '<div class="intrinsic">';
			if ( $image ) {
				echo '<div class="thumb" style="background-image:url(' . esc_url( $image ) . ');"></div>';
			}

					echo '<div class="image-overlay" style="background:' . $instance['background_color'] . '"></div>';

				echo '</div>';

			  echo '</div>';
		}

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title_1']          = strip_tags( $new_instance['title_1'] );
		$instance['image_1']          = strip_tags( $new_instance['image_1'] );
		$instance['a_1']              = strip_tags( $new_instance['a_1'] );
		$instance['title_2']          = strip_tags( $new_instance['title_2'] );
		$instance['image_2']          = strip_tags( $new_instance['image_2'] );
		$instance['a_2']              = strip_tags( $new_instance['a_2'] );
		$instance['title_3']          = strip_tags( $new_instance['title_3'] );
		$instance['image_3']          = strip_tags( $new_instance['image_3'] );
		$instance['a_3']              = strip_tags( $new_instance['a_3'] );
		$instance['background_color'] = strip_tags( $new_instance['background_color'] );
		$instance['text_color']       = strip_tags( $new_instance['text_color'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		for ( $x = 1; $x <= 3; $x++ ) {

			$title_field_id = 'title_' . $x;
			$image_field_id = 'image_' . $x;
			$a_field_id     = 'a_' . $x;
			?>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( $title_field_id ) ); ?>"><?php esc_html_e( 'Column', 'plate' ); ?> <?php echo esc_html( $x ); ?>:</label>
					<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( $title_field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $title_field_id ) ); ?>" value="<?php echo esc_attr( $instance[ $title_field_id ] ); ?>" />
				</p>

				<p style="margin-top: -8px;">
					<label for="<?php echo esc_attr( $this->get_field_id( $a_field_id ) ); ?>"><?php esc_html_e( 'Link', 'plate' ); ?>:</label>
					<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( $a_field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $a_field_id ) ); ?>" value="<?php echo esc_attr( $instance[ $a_field_id ] ); ?>" />
				</p>

				<p>
					<div class="widget-media-container">
						<div class="widget-media-inner">

							<?php $img_style    = ( $instance[ $image_field_id ] != '' ) ? '' : 'style=display:none;'; ?>
							<?php $no_img_style = ( $instance[ $image_field_id ] != '' ) ? 'style=display:none;' : ''; ?>

							<img id="<?php echo esc_attr( $this->get_field_id( $image_field_id ) ); ?>-preview" src="<?php echo esc_attr( $instance[ $image_field_id ] ); ?>" <?php echo esc_attr( $img_style ); ?> />
							<span class="widget-no-image" id="<?php echo esc_attr( $this->get_field_id( $image_field_id ) ); ?>-noimg" <?php echo esc_attr( $no_img_style ); ?>><?php esc_html_e( 'No image uploaded', 'plate' ); ?></span>
						</div>

						<input type="text" id="<?php echo esc_attr( $this->get_field_id( $image_field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $image_field_id ) ); ?>" value="<?php echo esc_attr( $instance[ $image_field_id ] ); ?>" class="widget-media-url" />
						<input type="button" value="<?php echo esc_html( 'Remove', 'plate' ); ?>" class="button widget-media-remove" id="<?php echo esc_attr( $this->get_field_id( $image_field_id ) ); ?>-remove" <?php echo esc_attr( $img_style ); ?> />
						<?php $button_text = ( $instance[ $image_field_id ] != '' ) ? esc_html__( 'Change Image', 'plate' ) : esc_html__( 'Select Image', 'plate' ); ?>
						<input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button widget-media-upload" id="<?php echo esc_attr( $this->get_field_id( $image_field_id ) ); ?>-button" />
						<br class="clear">
					</div>
				</p>

		<?php } ?>

				<p>
					<div class="widget-color-container">
						<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Overlay Color:', 'plate' ); ?></label>
						<script type='text/javascript'>
							jQuery(document).ready(function($) {
								$('.widget-color-picker').wpColorPicker();
							});
						</script>
						<input class="widget-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
					</div>
				</p>

				<p>
					<div class="widget-color-container">
						<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_html_e( 'Text Color:', 'plate' ); ?></label>
						<input class="widget-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
					</div>
				</p>
	<?php

	} //END form
} //END class
