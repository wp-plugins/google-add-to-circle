<?php
/*
Plugin Name: Google Add to Circle Badge
Plugin URI: http://wordpress.org/extend/plugins/Google-Add-to-Circle/
Description: This plugin generates a widget badge on your wordpress blog, that let the users to add your Google+ Page to their circle directly from your website.
Version: 1.0
Author: Mallikarjun Yawalkar
Author URI: http://en.gravatar.com/yawlkar
*/

class Add_to_Circle_Badge extends WP_Widget {
	function Add_to_Circle_Badge() {
		$widget_ops = array( 'classname' => 'Add_to_Circle_Badge', 'description' => 'Place a Google Add to Circle Badge on your Wordpress blog as a widget.' );
		$control_ops = array( 'id_base' => 'add-to-cirlce-badge' );
		$this->WP_Widget( 'add-to-cirlce-badge', 'Google Add To Cirlce', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance) {
		extract( $args );
		$layout = empty($instance['layout']) ? 'standard' : $instance['layout'];
		if (!empty($instance['url'])) {
			$url = urlencode($instance['url']);
		} else {
			$url = urlencode('http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
		}
		echo $before_widget;
		if (!empty($instance['title'])) {	
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;	
		}		
		switch ($layout)
		{
			case 'standard':
				
				echo "<g:plus href=\"https://plus.google.com/".$url."/\" size=\"badge\"></g:plus>";

				break;
			case 'small':
				
				echo "<g:plus href=\"https://plus.google.com/".$url."/\" size=\"smallbadge\"></g:plus>";

				break;
			default:

				echo "<g:plus href=\"https://plus.google.com/".$url."/\" size=\"smallbadge\"></g:plus>";

				break;	
		}

		echo $after_widget;
	}
		
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['layout'] = $new_instance['layout'];
		$instance['url'] = strip_tags($new_instance['url']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => '', 'layout' => 'standard', 'url' => ''));
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title (<b>Optional</b> you may leave this empty):</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>">Badge Style:</label>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( "standard" == $instance['layout'] ) echo 'selected="selected"'; ?> value="standard">Standard Badge</option>
				<option <?php if ( "small" == $instance['layout'] ) echo 'selected="selected"'; ?> value="small">Small Badge</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>">Google Page ID </label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" />
		</p>	

		<p><hr />
			<label>If you like this plugin, Please contribute your like on facebook:  </label><br />

<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Fdigital.fair&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=subscribe&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>		

<iframe src="http://www.facebook.com/plugins/subscribe.php?href=http://www.facebook.com/yawalkar.nitin&amp;layout=button_count&amp;show_faces=false&amp; width=120px&amp;font&amp;colorscheme=light&amp;height=20px" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:20px;\" allowTransparency="true"></iframe>

<g:plus href="https://plus.google.com/117097395443656322380/" size="smallbadge"></g:plus>

	</p>	

		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("Add_to_Circle_Badge");'));
?>