<?php

if ( ! class_exists( 'SCP_Widget' ) ) {

	//Add buttons to a widget
	class SCP_Widget extends WP_Widget {

		function SCP_Widget() {

			global $bit51scp;
			
			$widget_ops = array( 'classname' => 'SCP_Widget', 'description' => __( 'A widget for social sharing using the Share Center Pro Settings', $bit51scp->hook ) );
			$this->WP_Widget( 'SCP_Widget', 'Share Center Pro', $widget_ops );

		}
		
		function widget( $args, $instance ) {

			if ( is_page() || is_single() ) {

				global $bit51scp;

				extract( $args, EXTR_SKIP );

				echo $before_widget;

				$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );

				if ( !empty( $title ) ) { 
					echo $before_title . $title . $after_title; 
				}

				echo $bit51scp->scp_social_buttons();
				echo $after_widget;

			} else {

				echo '';

			}

		}
		
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			return $instance;

		}
		
		function form( $instance ) {

			global $bit51scp;

			$instance = wp_parse_args( ( array ) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
			$title = strip_tags( $instance['title'] );
			$entry_title = strip_tags( $instance['entry_title'] );
			$comments_title = strip_tags( $instance['comments_title'] );

			?>
				<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
				<p><?php _e( 'For more configuration visit the ', $bit51scp->hook ); ?><a href="/wp-admin/admin.php?page=share-center-pro"><?php _e( 'Options', $bit51scp->hook ); ?></a><?php _e( ' page.', $bit51scp->hook ); ?></p>
			<?php
		}

	}

}