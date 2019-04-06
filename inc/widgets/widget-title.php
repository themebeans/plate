<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Title' );
	}
);

class Plate_Title extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'Plate_Title', // Base ID
			esc_html__( 'Title Block', 'plate' ), // Name
			array(
				'classname'                   => 'widget--title widget--title-widget', // Classes
				'description'                 => esc_html__( 'Displays a title block. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title'            => '',
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
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before
		echo balanceTags( $before_widget );

		echo '<div class="widget-inner">';

			echo '<div class="widget-content">';

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

			echo '</div>';

		echo '</div>';

		if ( $instance['background_color'] ) {
			echo '<style>.widget--title.widget--title-widget {background-color:' . $instance['background_color'] . '}</style>';
		}

		if ( $instance['text_color'] ) {
			echo '<style>.widget--title.widget--title-widget .widget-content .widget-title {color:' . $instance['text_color'] . '}</style>';
		}

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['background_color'] = strip_tags( $new_instance['background_color'] );
		$instance['text_color']       = strip_tags( $new_instance['text_color'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'plate' ); ?>:</label>
		<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<div class="widget-color-container">
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Background Color:', 'plate' ); ?></label>
			<script type='text/javascript'>
				jQuery(document).ready(function($) {
					$('.widget-color-picker').wpColorPicker();
				});
			</script>
			<input class="widget-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
		</div>

		<div class="widget-color-container">
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_html_e( 'Text Color:', 'plate' ); ?></label>
			<input class="widget-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
		</div>


	<?php
	} //END form
} //END class
