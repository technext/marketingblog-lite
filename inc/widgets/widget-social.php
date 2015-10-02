<?php

/**
 * Social  Widget
 * marketingblog Theme
 */
class marketingblog_social_widget extends WP_Widget
{
	 function marketingblog_social_widget(){

        $widget_ops = array('classname' => 'marketingblog-social','description' => esc_html__( "marketingblog Social Widget" ,'marketingblog') );
		    parent::__construct('marketingblog-social', esc_html__('marketingblog Social Widget','marketingblog'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'marketingblog');

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;

		/**
		 * Widget Content
		 */
    ?>

    <!-- social icons -->
    <div class="social-icons sticky-sidebar-social">


    <?php marketingblog_social(true); ?>


    </div><!-- end social icons -->


		<?php

		echo $after_widget;
    }


    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'marketingblog');
    ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','marketingblog') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p>

    	<?php
    }

}

?>