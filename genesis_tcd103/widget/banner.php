<?php

class tcd_banner_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tcd_banner_widget',// ID
      __( 'Banner (tcd ver)', 'tcd-genesis' ),
      array(
        'classname' => 'tcd_banner_widget',
        'description' => __('Display designed banner.', 'tcd-genesis')
      )
    );
  }

  function widget($args, $instance) {

    extract($args);

    // Before widget //

    echo $before_widget;

?>
<div class="banner_widget swiper">
 <div class="banner_widget_inner swiper-wrapper">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) {
         if(isset($instance['banner_image'.$i])) {
           $image = wp_get_attachment_image_src( $instance['banner_image'.$i], 'full' );
         };
         if(!empty($image)) {
           $url = isset($instance['banner_url'.$i]) ?  $instance['banner_url'.$i] : '#';
           $target = isset($instance['banner_target'.$i]) ?  $instance['banner_target'.$i] : '';
           $title = isset($instance['banner_title'.$i]) ?  $instance['banner_title'.$i] : '';
  ?>
  <a class="item swiper-slide animate_background<?php if(!$title) { echo ' no_title'; }; ?>" href="<?php echo esc_url($url); ?>"<?php if($target) { echo ' target="_blank" rel="nofollow noopener"'; }; ?>>
   <div class="title_area">
    <?php if($title) { ?>
    <h3 class="title"><span><?php echo nl2br(esc_html($title)); ?></span></h3>
    <?php }; ?>
   </div>
   <div class="image_wrap">
    <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
  </a>
  <?php
         }
       };//end for
  ?>
 </div>
</div>
<?php
    // After widget //
    echo $after_widget;

  }

  // Update Settings //
  function update($new_instance, $old_instance) {
    for ( $i = 1; $i <= 3; $i++ ) {
      $instance['banner_image'.$i] = strip_tags($new_instance['banner_image'.$i]);
      $instance['banner_url'.$i] = $new_instance['banner_url'.$i];
      $instance['banner_target'.$i] = $new_instance['banner_target'.$i];
      $instance['banner_title'.$i] = $new_instance['banner_title'.$i];
    }
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    for ( $i = 1; $i <= 3; $i++ ) {
      $defaults['banner_image'.$i] = '';
      $defaults['banner_url'.$i] = '';
      $defaults['banner_target'.$i] = '';
      $defaults['banner_title'.$i] = '';
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
    global $font_type_options;
?>

<div class="tcd_widget_tab_content_wrap">

<div class="theme_option_message2" style="margin-top:15px;">
 <p><?php _e('If multiple banners are registered, the banners will be displayed with a crossfade slider.', 'tcd-genesis'); ?></p>
</div>

<?php for($i = 1; $i <= 3; $i++): ?>
<h3 class="tcd_widget_tab_content_headline"><?php _e('Banner','tcd-genesis'); ?><?php echo $i; ?></h3>
<div class="tcd_widget_tab_content">

  <div class="tcd_widget_content">
   <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-genesis'); ?></h3>
   <textarea style="width:100%;" cols="50" rows="2" name="<?php echo $this->get_field_name('banner_title'.$i); ?>"><?php echo esc_textarea($instance['banner_title'.$i]); ?></textarea>
  </div>

  <div class="tcd_widget_content">
   <h3 class="tcd_widget_headline"><?php _e('Image', 'tcd-genesis'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '350', '240'); ?></p>
   </div>
   <div class="widget_media_upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id('banner_image'.$i); ?>">
    <input type="hidden" value="<?php echo $instance['banner_image'.$i]; ?>" id="<?php echo $this->get_field_id('banner_image'.$i); ?>" name="<?php echo $this->get_field_name('banner_image'.$i); ?>" class="cf_media_id">
    <div class="preview_field"><?php if($instance['banner_image'.$i]){ echo wp_get_attachment_image($instance['banner_image'.$i], 'medium'); }; ?></div>
    <div class="buttton_area">
     <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>" class="cfmf-select-img button">
     <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if(!$instance['banner_image'.$i]){ echo 'hidden'; }; ?>">
    </div>
   </div>
  </div>

  <div class="tcd_widget_content cf">
   <h3 class="tcd_widget_headline"><?php _e('Link URL', 'tcd-genesis'); ?></h3>
   <div class="admin_link_option" style="width:100%; float:none; max-width:100%;">
    <input style="width:100%;" type="text" name="<?php echo $this->get_field_name('banner_url'.$i); ?>" placeholder="https://example.com/" value="<?php esc_attr_e( $instance['banner_url'.$i] ); ?>">
    <input id="<?php echo $this->get_field_id('banner_target'.$i); ?>" class="admin_link_option_target" name="<?php echo $this->get_field_name('banner_target'.$i); ?>" type="checkbox" value="1" <?php checked( $instance['banner_target'.$i], 1 ); ?>>
    <label for="<?php echo $this->get_field_id('banner_target'.$i); ?>">&#xe920;</label>
   </div>
  </div>

</div>
<?php endfor; ?>

</div>

<?php

  } // end Widget Control Panel
} // end class


function register_tcd_banner_widget() {
	register_widget( 'tcd_banner_widget' );
}
add_action( 'widgets_init', 'register_tcd_banner_widget' );


?>