<?php

class popular_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'popular_post_list_widget',// ID
      __( 'Popular post list (tcd ver)', 'tcd-genesis' ),
      array(
        'classname' => 'popular_post_list_widget',
        'description' => __('Displays popular post list based on post views.', 'tcd-genesis')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $content_type = $instance['content_type'];
    $post_num = $instance['post_num'];
    $rank_range = $instance['rank_range'];

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
    $popular_post_list = get_posts_views_ranking( $rank_range, $args, 'WP_Query' );

?>
<ol class="popular_post_widget">
<?php
     if ($popular_post_list->have_posts()) {
       $i = 1;
       while ($popular_post_list->have_posts()) : $popular_post_list->the_post();
?>
 <li class="item">
  <a class="animate_background" href="<?php the_permalink(); ?>">
   <div class="rank"><?php echo esc_html($i); ?></div>
   <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
  </a>
 </li>
 <?php $i++; endwhile; wp_reset_query(); } else { ?>
 <li class="no_post"><?php _e('There is no registered post.', 'tcd-genesis');  ?></li>
 <?php }; ?>
</ol>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['content_type'] = $new_instance['content_type'];
    $instance['post_num'] = $new_instance['post_num'];
    $instance['rank_range'] = $new_instance['rank_range'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    global $blog_label;
    $defaults = array('title' => __('Recent post', 'tcd-genesis'), 'content_type' => 'post', 'post_num' => 3, 'rank_range' => 'all');
    $instance = wp_parse_args( (array) $instance, $defaults );
    $options = get_design_plus_option();
    $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-genesis' );
?>
<div class="styled_post_list_widget_option">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-genesis'); ?></h3>
 <input class="widefat design_post_list_title" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type'); ?>" class="styled_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type']); ?>><?php echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;">
  <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
  <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
 </select>
</div>

<div class="tcd_widget_content widget_rank_range">
 <h3 class="tcd_widget_headline"><?php _e('Range of ranking', 'tcd-genesis'); ?></h3>
 <select id="<?php echo $this->get_field_id('rank_range'); ?>" name="<?php echo $this->get_field_name('rank_range'); ?>" class="widefat" style="width:100%;">
  <option value="day" <?php selected('day', $instance['rank_range']); ?>><?php _e('Daily', 'tcd-genesis'); ?></option>
  <option value="week" <?php selected('week', $instance['rank_range']); ?>><?php _e('Weekly', 'tcd-genesis'); ?></option>
  <option value="month" <?php selected('month', $instance['rank_range']); ?>><?php _e('Monthly', 'tcd-genesis'); ?></option>
  <option value="year" <?php selected('year', $instance['rank_range']); ?>><?php _e('Yearly', 'tcd-genesis'); ?></option>
  <option value="" <?php selected('', $instance['rank_range']); ?>><?php _e('All time', 'tcd-genesis'); ?></option>
 </select>
</div>

</div>

<?php

  } // end function form

} // end class


function register_popular_post_list_widget() {
	register_widget( 'popular_post_list_widget' );
}
add_action( 'widgets_init', 'register_popular_post_list_widget' );


?>
