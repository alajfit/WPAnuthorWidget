<?php
	/*
		Plugin Name: Posts Counter
		Description: A plugin which allows you to show total number of Articles on your blog.
		Author: Alan Fitzpatrick
		Author URI: http://www.theartofhacks.com/
		Plugin URI: http://www.theartofhacks.com/
		Version: 1.0
	*/

	add_action( 'widgets_init', 'add_posts_counter' );
	function add_posts_counter() {
		register_widget( 'WP_Widget_Posts_Counter' );
	}

	class WP_Widget_Posts_Counter extends WP_Widget {

		function WP_Widget_Posts_Counter() {
			$widget_ops = array('classname' =>  'widget_featured_entries', 'description' => __( "This widget will  show total no of articles in the Knowledge Base") );
			$this->WP_Widget('posts_counter', __('Posts Counter'), $widget_ops);
			$this->alt_option_name = 'posts_counter_widget';
		}

		function widget($args, $instance) {
			extract($args);
			$title = apply_filters('widget_title',
			empty($instance['title']) ? __('Posts Counter') : $instance['title'],  $instance, $this->id_base);
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;

			$num_posts = wp_count_posts( 'post' );
			echo '<p style="color:#428bca;">' . $num_posts->publish . '</p>';
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}

		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<input id="<?php echo  $this->get_field_id('title'); ?>"
				name="<?php echo  $this->get_field_name('title'); ?>"
				type="text" value="<?php  echo $title; ?>" /></p>

<?php
		}
	}
?>
