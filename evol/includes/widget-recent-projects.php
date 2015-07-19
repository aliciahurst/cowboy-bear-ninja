<?php

function register_recent_projects_widget() {
	register_widget( 'recent_projects_widget' );
}
add_action( 'widgets_init', 'register_recent_projects_widget' );

class recent_projects_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'recent_projects',
			'Recent Projects',
			array( 'description' => 'The most recent projects.' )
		);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = $instance['count'];

		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;

		echo '<ul>';
			$recent_projects_query = new WP_Query( array( 'post_type' => 'project', 'showposts' => $count ) );
			while ( $recent_projects_query->have_posts() ) : $recent_projects_query->the_post();
			?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</a>
				</li>
			<?php
			endwhile;
			wp_reset_postdata();
		echo '</ul>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {	
		$defaults = array(
			'title' => 'Recent Projects',
			'count' => '4'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of projects:</label>
			<select id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" class="widefat">
				<option <?php if ( '4' == $instance['count'] ) echo 'selected="selected"'; ?>>4</option>
				<option <?php if ( '8' == $instance['count'] ) echo 'selected="selected"'; ?>>8</option>
			</select>
		</p>

	<?php
	}
}