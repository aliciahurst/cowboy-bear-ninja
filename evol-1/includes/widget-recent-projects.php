<?php

function tr_recent_projects() {
	register_widget( 'recent_projects' );
}
add_action( 'widgets_init', 'tr_recent_projects' );

class recent_projects extends WP_Widget {

	function recent_projects() {
		$widget_ops = array( 'classname' => 'widget_recent_projects', 'description' => 'The most recent projects.' );
		$control_ops = array( 'id_base' => 'recent_projects' );
		$this->WP_Widget( 'recent_projects', 'Recent Projects', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = $instance['number'];
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		echo '<ul>';
			query_posts( array( 'post_type' => 'portfolio', 'showposts' => $number ) );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				?>
				
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'portfolio' ); ?>
					</a>
				</li>
				
				<?php
				
			endwhile; endif;
			wp_reset_query();
		echo '</ul>';
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}
	
	function form( $instance ) {	
		
		$defaults = array( 'title' => 'Recent Projects', 'number' => '8' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Projects:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		
		<?php
	
	}

}

?>