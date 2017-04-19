<?php
/**
 * Plugin Name: Buddypress RoB widget
 * Author: captapp
 * Author URI:http://captapp.com
 * Version:1.0
 * Plugin URI:http://captapp.com
 * Description:Show stats of profile views, friends, post, and mentions count by all members only or all viewers (members and guests).
 * License: GPL
 * Tested with Buddypress 1.5+
 * Date: 5-8-16
 */
    // Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Buddy Press Stats Widget', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Buddy Press Stats Widget Views, Post, Friends and Mentions', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo'<div class="grid"><div class="friend"><p><i class="fa fa-user" aria-hidden="true"></i></p><h3>'; 
$nama = bp_total_friend_count( bp_displayed_user_id());
echo'</h3><p>Friends</p></div><div class="mentions"><p><i class="fa fa-bell" aria-hidden="true"></i></p><h3>';
$name = bp_total_mention_count_for_user( bp_displayed_user_id());
echo'</h3><p>Mentions</p></div><div class="post"><p><i class="fa fa-users" aria-hidden="true"></i></p><h3>';
$nami = bp_total_site_member_count( bp_displayed_user_id());
echo'</h3><p>Total Users</p></div><div class="members"><p><i class="fa fa fa-file-text-o" aria-hidden="true"></i></p><h3>';
$namo = bp_total_blog_count( bp_displayed_user_id());
echo'</h3><p>Post</p></div><div class="clear"></div></div><div class="clear"></div>';
echo $args['after_widget'];
}
    
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
  
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
  register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

?>
<style type="text/css">
  .stats{min-height: 200px;}
  .stats .grid {margin:15px 0 5px;} 
  .stats .grid .fa{font-size: 24px; color: #999;}
  .stats .grid .fa:hover{font-size: 24px; color: #333; cursor: pointer;}
  .stats .grid div{width: 48%; float: left; text-align: center; color: #333;padding: 5px;}
  .stats .grid h3{margin: 0;}
  .stats .grid p{font-size: 11px;}
  .friend{border-bottom: solid 1px #aaa; border-right: solid 1px #aaa}
  .stats .post{border-top: solid 1px #eee; border-right: solid 1px #aaa}
  .stats .members{border-top: solid 1px #eee; border-left: solid 1px #eee}
  .stats .mentions{border-bottom: solid 1px #aaa; border-left: solid 1px #eee}
</style>





