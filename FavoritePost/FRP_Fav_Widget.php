<?php

    class FRP_Fav_Widget extends WP_Widget {
 
        function __construct() {
     
            $args = [
                'name' => 'Favorite Posts',
                'description' => 'Show favorite posts'
            ];

            parent::__construct('frp_fav_widget', '', $args);
     
        }

        //user part
        public function widget( $args, $instance ) {
            if( !is_user_logged_in( )) return;

            echo $args['before_widget'];
                echo $args['before_title'];
                    echo $instance['title'];
                echo $args['after_title'];
                
                $user_id = wp_get_current_user()->ID; 
                $favorites = get_user_meta( $user_id, "frp_favorites" );
                if(empty($favorites)){
                    echo __("Favorite Post List is empty");
                    return;
                }

                echo "<ul>";
                foreach($favorites as $fv) {
                    echo "<li>";

                    $link = get_permalink( $fv );
                    $title = get_the_title( $fv );
                    echo "<a target='_blank' href='" . $link . "'>" . $title . "</a>";
                    echo "</li>";       
                }
                echo "</ul>";

            echo $args['after_widget'];
        }
        
        //admin part
        public function form( $instance ) {     
            $title = !empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>">
            </p>
            <?php
     
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = array();
            $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';     
            return $instance;
        }
     
    }