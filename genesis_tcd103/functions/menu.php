<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu_new'][$item->ID] ) ) return $item_output;

  if ( 'dropdown' === $options['megamenu_new'][$item->ID] ) return $item_output;

  if ( 'use_megamenu_a' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'use_megamenu_b' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type2" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - Post carousel ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $post_type = $options['megamenu_a_post_type'] ? $options['megamenu_a_post_type'] : 'recent_post';
      $post_order = $options['megamenu_a_post_order'] ? $options['megamenu_a_post_order'] : 'date';
      $post_num = $options['megamenu_a_post_num'] ? $options['megamenu_a_post_num'] : '8';
      if($post_type == 'recent_post') {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel swiper">
  <div class="post_list swiper-wrapper">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
            $image[1] = '275';
            $image[2] = '185';
          }
   ?>
   <div class="item swiper-slide">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <div class="content">
      <p class="title"><span><?php the_title(); ?></span></p>
      <?php if ($options['blog_show_date'] == 'display'){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
    </a>
   </div>
   <?php endwhile; wp_reset_query(); ?>
  </div>
 </div>
 <div class="genesis_carousel_scrollbar">
  <div class="post_carousel_scrollbar swiper-scrollbar"></div>
 </div>
 <?php endif; ?>

</div><!-- END .megamenu_a -->
<?php
};


// Mega menu B - Service category ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  $options = get_design_plus_option();
  if(isset($megamenus[$id])){
     $archive_service_type = $options['archive_service_type'] ? $options['archive_service_type'] : 'type1';

     $total_category_num = 0;
     foreach ( $megamenus[$id] as $menu ) :
       if ( $menu->object != 'service_category') continue;
       $total_category_num++;
     endforeach;
?>
<div class="megamenu megamenu_b <?php if($archive_service_type == 'type2'){ echo 'no_category_page'; } else { echo 'show_category_page'; }; if($total_category_num > 3){ echo ' use_carousel'; }; ?>" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $header_title = $options['archive_service_headline'];
      $header_sub_title = $options['archive_service_sub_title'];
 ?>
 <div class="header">
  <div class="title_area">
   <p class="title"><?php echo esc_html($header_title); ?></p>
   <?php if($header_sub_title){ ?>
   <a class="sub_title arrow_link" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span class="label"><?php echo esc_html($header_sub_title); ?></span><span class="arrow_button_small"></span></a>
   <?php }; ?>
  </div>
 </div>

 <?php if($total_category_num > 3){ ?>
 <div class="item_list swiper">
  <div class="item_list_inner swiper-wrapper">
 <?php }; ?>

 <?php
      foreach ( $megamenus[$id] as $menu ) :
        if ( $menu->object != 'service_category') continue;
          $cat_id = $menu->object_id;
          $cat_name = $menu->title;
          $url = $menu->url;
          $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
          $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
          $image = isset($term_meta['image1']) ? wp_get_attachment_image_src( $term_meta['image1'], 'size2' ) : '';
          if($image){
 ?>
 <div class="item category<?php if($total_category_num > 3){ echo ' swiper-slide'; }; ?>">
  <a class="image_link animate_background" href="<?php echo esc_url($url); ?>">
   <div class="image_wrap">
    <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
  </a>
  <div class="title_area<?php if(!$sub_title){ echo ' no_sub_title'; }; ?>">
   <p class="title"><?php echo esc_html($cat_name); ?></p>
   <?php if($sub_title){ ?>
   <a class="sub_title arrow_link" href="<?php echo esc_url($url); ?>"><span class="label"><?php echo esc_html($sub_title); ?></span><span class="arrow_button_small"></span></a>
   <?php }; ?>
  </div>
  <?php
       if($archive_service_type == 'type2'){
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'id', 'terms' => $cat_id)) );
         $post_list = new wp_query($args);
         if($post_list->have_posts()):
  ?>
  <div class="post_list">
   <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
   <a class="arrow_link" href="<?php the_permalink(); ?>"><span class="label"><?php the_title(); ?></span><span class="arrow_button_small"></span></a>
   <?php endwhile; wp_reset_query(); ?>
  </div>
  <?php endif; }; ?>
 </div>
 <?php }; endforeach; ?>

 <?php if($total_category_num > 3){ ?>
  </div><!-- END .item_list_inner -->
 </div><!-- END .item_list -->
 <div class="megamenu_carousel_button_prev swiper-nav-button swiper-button-prev"><span class="arrow_button_small reverse"></span></div>
 <div class="megamenu_carousel_button_next swiper-nav-button swiper-button-next"><span class="arrow_button_small"></span></div>
 <?php }; ?>

</div><!-- END .megamenu_b -->
<?php
  };
};

?>