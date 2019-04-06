<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Features_3_Col' );
	}
);

class Plate_Features_3_Col extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'plate_features_3_col', // Base ID
			esc_html__( 'Features, 3 Col', 'plate' ), // Name
			array(
				'classname'                   => 'widget--features--3col', // Classes
				'description'                 => esc_html__( 'Displays a 3 column feature set. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title_1' => '',
			'desc_1'  => '',
			'image_1' => '',
			'a_1'     => '',
			'title_2' => '',
			'desc_2'  => '',
			'image_2' => '',
			'a_2'     => '',
			'title_3' => '',
			'desc_3'  => '',
			'image_3' => '',
			'a_3'     => '',
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$title_1 = $instance['title_1'];
		$desc_1  = $instance['desc_1'];
		$image_1 = $instance['image_1'];
		$a_1     = $instance['a_1'];
		$title_2 = $instance['title_2'];
		$desc_2  = $instance['desc_2'];
		$image_2 = $instance['image_2'];
		$a_2     = $instance['a_2'];
		$title_3 = $instance['title_3'];
		$desc_3  = $instance['desc_3'];
		$image_3 = $instance['image_3'];
		$a_3     = $instance['a_3'];

		// Before
		echo balanceTags( $before_widget );

		// Content
		// Now you loop through each image
		for ( $x = 1; $x <= 3; $x++ ) {

			// Set the variables
			$title = $instance[ 'title_' . $x ];
			$desc  = $instance[ 'desc_' . $x ];
			$image = $instance[ 'image_' . $x ];
			$a     = $instance[ 'a_' . $x ];

			echo '<div class="feature-col feature-col-' . $x . '">';

			if ( $title ) {
				echo '<h6>' . esc_html( $title ) . '</h6>';
			}

			if ( $image ) {
				if ( $a ) {
					echo '<a href="' . esc_url( $a ) . '">'; }
					echo '<img src="' . esc_html( $image ) . '">';
				if ( $a ) {
					echo '</a>'; }
			}

			if ( $desc ) {
				echo '<p>' . balanceTags( $desc ) . '</p>';
			}

			  echo '</div>';
		}

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title_1'] = strip_tags( $new_instance['title_1'] );
		$instance['desc_1']  = stripslashes( $new_instance['desc_1'] );
		$instance['image_1'] = strip_tags( $new_instance['image_1'] );
		$instance['a_1']     = strip_tags( $new_instance['a_1'] );
		$instance['title_2'] = strip_tags( $new_instance['title_2'] );
		$instance['desc_2']  = stripslashes( $new_instance['desc_2'] );
		$instance['image_2'] = strip_tags( $new_instance['image_2'] );
		$instance['a_2']     = strip_tags( $new_instance['a_2'] );
		$instance['title_3'] = strip_tags( $new_instance['title_3'] );
		$instance['desc_3']  = stripslashes( $new_instance['desc_3'] );
		$instance['image_3'] = strip_tags( $new_instance['image_3'] );
		$instance['a_3']     = strip_tags( $new_instance['a_3'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		for ( $x = 1; $x <= 3; $x++ ) {

			$title_field_id = 'title_' . $x;
			$image_field_id = 'image_' . $x;
			$desc_field_id  = 'desc_' . $x;
			$a_field_id     = 'a_' . $x;
			?>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( $title_field_id ) ); ?>"><?php esc_html_e( 'Feature', 'plate' ); ?> <?php echo esc_html( $x ); ?>:</label>
					<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( $title_field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $title_field_id ) ); ?>" value="<?php echo esc_attr( $instance[ $title_field_id ] ); ?>" />
				</p>

				<p style="margin-top: -8px;">
					<textarea class="widefat" rows="2" cols="15" id="<?php echo esc_html( $this->get_field_id( $desc_field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $desc_field_id ) ); ?>"><?php echo balanceTags( $instance[ $desc_field_id ] ); ?></textarea>
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
		<?php
		}
	} //END form
} //END class
