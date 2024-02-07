<?php

class tab_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tab_post_list_widget',// ID
      __('Tab post list (tcd ver)', 'tcd-genesis'),
      array(
        'classname' => 'tab_post_list_widget',
        'description' => __('Display three type of post list by tab.', 'tcd-genesis')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    $options = get_design_plus_option();

    extract( $args );

    // Before widget //
    echo $before_widget;

    // Title of widget //

    // Widget output //
?>

 <?php
    $title_count = 0;
    for ( $i = 1; $i <= 3; $i++ ) :
      $title = apply_filters('widget_title', $instance['title'.$i]);
      if($title){ $title_count++; }
    endfor;
    if($title_count>1):
 ?>
<div class="widget_tab_post_list_button clearfix">
 <?php
      for ( $i = 1; $i <= 3; $i++ ) :
        $title = apply_filters('widget_title', $instance['title'.$i]);
        if($title){
 ?>
 <div class="tab<?php echo $i; if($i == 1){ echo ' active'; }; ?>"><?php echo esc_html($title); ?></div>
 <?php
        };
      endfor;
 ?>
</div>
 <?php
    else:
      for ( $i = 1; $i <= 3; $i++ ) :
        $title = apply_filters('widget_title', $instance['title'.$i]);
        if ( $title ) { echo $before_title . $title . $after_title; }
      endfor;
    endif;
 ?>


<?php
      for ( $i = 1; $i <= 3; $i++ ) :
        $title = apply_filters('widget_title', $instance['title'.$i]);
        if($title){
          $post_num = (isset($instance['post_num']))? $instance['post_num'] : 3;
          $post_type = $instance['post_type'.$i];
          $post_order = $instance['post_order'.$i];
          $rank_range = $instance['rank_range'.$i];
          $content_type = $instance['content_type'.$i];
          if($post_type == 'recent_post') {
            $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
            $post_list = new WP_Query($args);
          } elseif($post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3') {
            $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
            $post_list = new WP_Query($args);
          } else {
            $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
            $post_list = get_posts_views_ranking( $rank_range, $args, 'WP_Query' );
          };
?>
<ol class="widget_tab_post_list widget_tab_post_list<?php echo $i; if($i == 1){ echo ' active'; }; ?> <?php echo $content_type; ?>">
 <?php
      if ($post_list->have_posts()) {
        while ($post_list->have_posts()) : $post_list->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_list->ID ), 'size1' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/no_image1.gif";
          }
 ?>
 <li>
  <a class="animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <div class="title_area">
    <p class="title"><span><?php the_title_attribute(); ?></span></p>
   </div>
  </a>
 </li>
<?php endwhile; wp_reset_query(); } else { ?>
 <li class="no_post" style="width:100%; margin-right:0;"><?php _e('There is no registered post.', 'tcd-genesis');  ?></li>
<?php }; ?>
</ol>
<?php
       }; // if has title

     endfor;

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title1'] = strip_tags($new_instance['title1']);
    $instance['title2'] = strip_tags($new_instance['title2']);
    $instance['title3'] = strip_tags($new_instance['title3']);
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_type1'] = $new_instance['post_type1'];
    $instance['post_type2'] = $new_instance['post_type2'];
    $instance['post_type3'] = $new_instance['post_type3'];
    $instance['post_order1'] = $new_instance['post_order1'];
    $instance['post_order2'] = $new_instance['post_order2'];
    $instance['post_order3'] = $new_instance['post_order3'];
    $instance['rank_range1'] = $new_instance['rank_range1'];
    $instance['rank_range2'] = $new_instance['rank_range2'];
    $instance['rank_range3'] = $new_instance['rank_range3'];
    $instance['content_type1'] = $new_instance['content_type1'];
    $instance['content_type2'] = $new_instance['content_type2'];
    $instance['content_type3'] = $new_instance['content_type3'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $options = get_design_plus_option();
    $defaults = array(
      'title1' => __('Recent post', 'tcd-genesis'), 'post_num' => 3, 'content_type1' => 'post', 'post_order1' => 'date', 'post_type1' => 'recent_post', 'rank_range1' => 'month',
      'title2' => __('Recommend post', 'tcd-genesis'), 'post_num' => 3, 'content_type2' => 'post', 'post_order2' => 'date', 'post_type2' => 'recommend_post', 'rank_range2' => 'month',
      'title3' => __('Recommend post', 'tcd-genesis'), 'post_num' => 3, 'content_type3' => 'post', 'post_order3' => 'date', 'post_type3' => 'recommend_post', 'rank_range3' => 'month',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
    global $blog_label;
    $options = get_design_plus_option();
    $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-genesis' );
?>

<div class="tcd_widget_tab_content_wrap">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-genesis'); ?></h3>
 <input type="number" name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;" min="1" value="<?php echo $instance['post_num']; ?>">
</div>

<h3 class="tcd_widget_tab_content_headline"><?php _e('First tab setting', 'tcd-genesis'); ?></h3>
<div class="tcd_widget_tab_content">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-genesis'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title1'); ?>'" type="text" value="<?php echo $instance['title1']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type1'); ?>" class="tab_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type1']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type1']); ?>><?php echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type1'); ?>" class="tab_post_list_post_type widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type1']); ?>><?php _e('Recent post', 'tcd-genesis'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>3</option>
  <option value="popular_post" <?php selected('popular_post', $instance['post_type1']); ?>><?php _e('Popular post', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_post_order">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order1'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order1']); ?>><?php _e('Date', 'tcd-genesis'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order1']); ?>><?php _e('Random', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_rank_range">
 <h3 class="tcd_widget_headline"><?php _e('Range of ranking', 'tcd-genesis'); ?></h3>
 <select id="<?php echo $this->get_field_id('rank_range1'); ?>" name="<?php echo $this->get_field_name('rank_range1'); ?>" class="widefat" style="width:100%;">
  <option value="day" <?php selected('day', $instance['rank_range1']); ?>><?php _e('Daily', 'tcd-genesis'); ?></option>
  <option value="week" <?php selected('week', $instance['rank_range1']); ?>><?php _e('Weekly', 'tcd-genesis'); ?></option>
  <option value="month" <?php selected('month', $instance['rank_range1']); ?>><?php _e('Monthly', 'tcd-genesis'); ?></option>
  <option value="year" <?php selected('year', $instance['rank_range1']); ?>><?php _e('Yearly', 'tcd-genesis'); ?></option>
  <option value="" <?php selected('', $instance['rank_range1']); ?>><?php _e('All time', 'tcd-genesis'); ?></option>
 </select>
</div>

</div><!-- END .tcd_ad_widget_box -->

<h3 class="tcd_widget_tab_content_headline"><?php _e('Second tab setting', 'tcd-genesis'); ?></h3>
<div class="tcd_widget_tab_content">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-genesis'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title2'); ?>'" type="text" value="<?php echo $instance['title2']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type2'); ?>" class="tab_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type2']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type2']); ?>><?php echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type2'); ?>" class="tab_post_list_post_type widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type2']); ?>><?php _e('Recent post', 'tcd-genesis'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>3</option>
  <option value="popular_post" <?php selected('popular_post', $instance['post_type2']); ?>><?php _e('Popular post', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_post_order">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order2'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order2']); ?>><?php _e('Date', 'tcd-genesis'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order2']); ?>><?php _e('Random', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_rank_range">
 <h3 class="tcd_widget_headline"><?php _e('Range of ranking', 'tcd-genesis'); ?></h3>
 <select id="<?php echo $this->get_field_id('rank_range2'); ?>" name="<?php echo $this->get_field_name('rank_range2'); ?>" class="widefat" style="width:100%;">
  <option value="day" <?php selected('day', $instance['rank_range2']); ?>><?php _e('Daily', 'tcd-genesis'); ?></option>
  <option value="week" <?php selected('week', $instance['rank_range2']); ?>><?php _e('Weekly', 'tcd-genesis'); ?></option>
  <option value="month" <?php selected('month', $instance['rank_range2']); ?>><?php _e('Monthly', 'tcd-genesis'); ?></option>
  <option value="year" <?php selected('year', $instance['rank_range2']); ?>><?php _e('Yearly', 'tcd-genesis'); ?></option>
  <option value="" <?php selected('', $instance['rank_range2']); ?>><?php _e('All time', 'tcd-genesis'); ?></option>
 </select>
</div>

</div><!-- END .tcd_ad_widget_box -->

<h3 class="tcd_widget_tab_content_headline"><?php _e('Third tab setting', 'tcd-genesis'); ?></h3>
<div class="tcd_widget_tab_content">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-genesis'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title3'); ?>'" type="text" value="<?php echo $instance['title3']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type3'); ?>" class="tab_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type3']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type3']); ?>><?php echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type3'); ?>" class="tab_post_list_post_type widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type3']); ?>><?php _e('Recent post', 'tcd-genesis'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type3']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type3']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type3']); ?>><?php _e('Recommend post', 'tcd-genesis'); ?>3</option>
  <option value="popular_post" <?php selected('popular_post', $instance['post_type3']); ?>><?php _e('Popular post', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_post_order">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-genesis'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order3'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order3']); ?>><?php _e('Date', 'tcd-genesis'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order3']); ?>><?php _e('Random', 'tcd-genesis'); ?></option>
 </select>
</div>

<div class="tcd_widget_content widget_rank_range">
 <h3 class="tcd_widget_headline"><?php _e('Range of ranking', 'tcd-genesis'); ?></h3>
 <select id="<?php echo $this->get_field_id('rank_range3'); ?>" name="<?php echo $this->get_field_name('rank_range3'); ?>" class="widefat" style="width:100%;">
  <option value="day" <?php selected('day', $instance['rank_range3']); ?>><?php _e('Daily', 'tcd-genesis'); ?></option>
  <option value="week" <?php selected('week', $instance['rank_range3']); ?>><?php _e('Weekly', 'tcd-genesis'); ?></option>
  <option value="month" <?php selected('month', $instance['rank_range3']); ?>><?php _e('Monthly', 'tcd-genesis'); ?></option>
  <option value="year" <?php selected('year', $instance['rank_range3']); ?>><?php _e('Yearly', 'tcd-genesis'); ?></option>
  <option value="" <?php selected('', $instance['rank_range3']); ?>><?php _e('All time', 'tcd-genesis'); ?></option>
 </select>
</div>

</div><!-- END .tcd_ad_widget_box -->

</div><!-- END .tcd_ad_widget_box_wrap -->

<?php

  } // end function form

} // end class


function register_tab_post_list_widget() {
  register_widget( 'tab_post_list_widget' );
}
add_action( 'widgets_init', 'register_tab_post_list_widget' );


?>