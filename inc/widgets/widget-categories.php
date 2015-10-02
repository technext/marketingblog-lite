<?php

/**
 * Custom Categories Widget
 * marketingblog Theme
 */
class marketingblog_categories extends WP_Widget
{
	 function marketingblog_categories(){

        $widget_ops = array('classname' => 'marketingblog-cats','description' => esc_html__( "marketingblog Categories" ,'marketingblog') );
		    parent::__construct('marketingblog-cats', esc_html__('marketingblog Categories','marketingblog'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Categories' , 'marketingblog');
        $enable_count = '';
        if(isset($instance['enable_count']))
        $enable_count = $instance['enable_count'] ? $instance['enable_count'] : 'checked';

        $limit = ($instance['limit']) ? $instance['limit'] : 4;


      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;

		/**
		 * Widget Content
		 */

		?>


    <div class="cats-widget">

        <ul><?php
        if($enable_count != '') {
              $args = array (
              'echo' => 0,
              'show_count' => 1,
              'title_li' => '',
              'depth' => 1 ,
              'orderby' => 'count' ,
              'order' => 'DESC' ,
              'number' => $limit
              );
        }
        else{
            $args = array (
              'echo' => 0,
              'show_count' => 0,
              'title_li' => '',
              'depth' => 1 ,
              'orderby' => 'count' ,
              'order' => 'DESC' ,
              'number' => $limit
              );
        }
    $variable = wp_list_categories($args);
    $variable = str_replace ( "(" , "<span>", $variable );
    $variable = str_replace ( ")" , "</span>", $variable );
    echo $variable; ?></ul>

    </div><!-- end widget content -->

		<?php

		echo $after_widget;
    }


    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Categories' , 'marketingblog');
      if(!isset($instance['limit'])) $instance['limit'] = 4;
      if(!isset($instance['enable_count'])) $instance['enable_count'] = '';


    	?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','marketingblog') ?></label>

        <input  type="text" value="<?php echo esc_attr($instance['title']); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                id="<?php $this->get_field_id('title'); ?>"
                class="widefat" />
      </p>

      <p><label for="<?php echo $this->get_field_id('limit'); ?>"> <?php esc_html_e('Limit Categories ','marketingblog') ?></label>

        <input  type="text" value="<?php echo esc_attr($instance['limit']); ?>"
                name="<?php echo $this->get_field_name('limit'); ?>"
                id="<?php $this->get_field_id('limit'); ?>"
                class="widefat" />
      </p>

      <p><label>
        <input  type="checkbox"
                name="<?php echo $this->get_field_name('enable_count'); ?>"
                id="<?php $this->get_field_id('enable_count'); ?>" <?php if($instance['enable_count'] != '') echo 'checked=checked '; ?>
         />
         <?php esc_html_e('Enable Posts Count','marketingblog') ?></label>
       </p>

    	<?php
    }
}

?>