<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Tagline' );
	}
);

class Plate_Tagline extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'Plate_Tagline', // Base ID
			esc_html__( 'Tagline', 'plate' ), // Name
			array(
				'classname'                   => 'widget--tagline', // Classes
				'description'                 => esc_html__( 'Displays a tagline text area. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title'    => '',
			'desc'     => '',
			'btn_text' => '',
			'btn_url'  => '',
		);

	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc  = $instance['desc'];
		$btn   = $instance['btn_text'];
		$url   = $instance['btn_url'];

		// Before
		echo balanceTags( $before_widget );

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

		if ( $desc ) {
			echo '<p>' . balanceTags( $desc ) . '</p>';
		}

		if ( $btn ) {
			echo '<a href="' . esc_url( $url ) . '" class="button button--small">' . esc_html( $btn ) . '</a>';
		}

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['desc']     = stripslashes( $new_instance['desc'] );
		$instance['btn_text'] = stripslashes( $new_instance['btn_text'] );
		$instance['btn_url']  = stripslashes( $new_instance['btn_url'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo balanceTags( $instance['desc'] ); ?></textarea>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" value="<?php echo esc_attr( $instance['btn_text'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" value="<?php echo esc_attr( $instance['btn_url'] ); ?>" />
		</p>


	<?php
	} //END form
} //END class
