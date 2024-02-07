<?php
     get_header();
     $options = get_design_plus_option();

     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;

     $title = $options['archive_news_headline'];
     $sub_title = $options['archive_news_sub_title'];
     $desc = $options['archive_news_desc'];
     $desc_mobile = $options['archive_news_desc_mobile'];
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="archive_header" class="inview">
 <div class="title_area">
  <h2 class="large_headline"><span><?php echo esc_html($title); ?></span></h2>
  <?php if($sub_title){ ?>
  <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
  <?php }; ?>
 </div>
 <?php if($desc){ ?>
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php }; ?>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
</div>

<?php
     // カテゴリー一覧 --------------------------------
     $news_category_list = get_terms( 'news_category', array( 'hide_empty' => true ) );
     if ( $news_category_list && ! is_wp_error( $news_category_list ) ) {
?>
<div class="news_category_button swiper">
 <ol class="swiper-wrapper">
  <li class="swiper-slide"><a data-category-id="#ajax_post_cat_all" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php _e('All post', 'tcd-genesis');  ?></a></li>
  <?php
       foreach ( $news_category_list as $cat ):
         $cat_id = $cat->term_id;
         $cat_name = $cat->name;
         $cat_url = get_term_link($cat_id,'news_category');
  ?>
  <li class="swiper-slide<?php if($cat_id == $current_cat_id){ echo ' current'; }; ?>"><a data-category-id="#ajax_post_cat_<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a></li>
  <?php endforeach; ?>
 </ol>
</div>
<div class="genesis_carousel_scrollbar">
 <div class="news_category_scrollbar swiper-scrollbar"></div>
</div>
<?php }; ?>

<section id="archive_news">

 <?php
      $show_image = $options['news_show_image'] ?  $options['news_show_image'] : 'display';
      if(is_mobile()){
        $post_num = $options['archive_news_num_sp'];
      } else {
        $post_num = $options['archive_news_num'];
      }
      $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num );
      $post_list = new wp_query($args);
      $all_post_count = $post_list->found_posts;
      if($post_list->have_posts()):
 ?>
 <div class="ajax_post_list_wrap" id="ajax_post_cat_all">
  <div class="news_list ajax_post_list">
   <?php
        while ( $post_list->have_posts() ) : $post_list->the_post();
          if($show_image == 'display'){
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
              $image[1] = '190';
              $image[2] = '190';
            }
          }
   ?>
   <div class="item<?php if($show_image == 'hide'){ echo ' no_image'; }; ?>" style="opacity:1;">
    <?php if($show_image == 'display'){ ?>
    <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
    </a>
    <?php }; ?>
    <div class="content">
     <?php
          $post_category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
          if ( $post_category && ! is_wp_error($post_category) ) {
            foreach ( $post_category as $post_cat ) :
              $post_cat_name = $post_cat->name;
              $post_cat_id = $post_cat->term_id;
              break;
            endforeach;
     ?>
     <a class="category_button" href="<?php echo esc_url(get_term_link($post_cat_id,'news_category')); ?>"><?php echo esc_html($post_cat_name); ?></a>
     <?php
          };
     ?>
     <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    </div>
   </div>
   <?php endwhile; ?>
  </div><!-- END .news_list -->
  <?php if($all_post_count > $post_num) { ?>
  <div class="entry-more" data-catid="" data-offset-post="<?php echo esc_attr($post_num); ?>">
   <span class="design_button"><?php _e( 'Load more', 'tcd-genesis' ); ?></span>
  </div>
  <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-genesis' ); ?></div>
  <?php }; ?>
 </div><!-- END .ajax_post_list_wrap -->
 <?php
      endif;
      wp_reset_postdata();
 ?>

 <?php
      // カテゴリー別　記事一覧 ---------------------------------------------------
      if ( $news_category_list && ! is_wp_error( $news_category_list ) ) :
        $i = 1;
        foreach ( $news_category_list as $cat ):
          $cat_id = $cat->term_id;
          $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
          $post_list = new wp_query($args);
          $all_post_count = $post_list->found_posts;
          if($post_list->have_posts()):
 ?>
 <div class="ajax_post_list_wrap<?php if($cat_id == $current_cat_id){ echo ' active'; }; ?>" id="ajax_post_cat_<?php echo esc_attr($cat_id); ?>">
  <div class="news_list ajax_post_list">
   <?php
        while ( $post_list->have_posts() ) : $post_list->the_post();
          if($show_image == 'display'){
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
              $image[1] = '190';
              $image[2] = '190';
            }
          }
   ?>
   <div class="item<?php if($show_image == 'hide'){ echo ' no_image'; }; ?>" style="opacity:1;">
    <?php if($show_image == 'display'){ ?>
    <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
    </a>
    <?php }; ?>
    <div class="content">
     <?php
          $post_category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
          if ( $post_category && ! is_wp_error($post_category) ) {
            foreach ( $post_category as $post_cat ) :
              $post_cat_name = $post_cat->name;
              $post_cat_id = $post_cat->term_id;
              break;
            endforeach;
     ?>
     <a class="category_button" href="<?php echo esc_url(get_term_link($post_cat_id,'news_category')); ?>"><?php echo esc_html($post_cat_name); ?></a>
     <?php
          };
     ?>
     <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    </div>
   </div>
   <?php endwhile; ?>
  </div><!-- END .news_list -->
  <?php if($all_post_count > $post_num) { ?>
  <div class="entry-more" data-catid="<?php echo esc_attr($cat_id); ?>" data-offset-post="<?php echo esc_attr($post_num); ?>">
   <span class="design_button"><?php _e( 'Load more', 'tcd-genesis' ); ?></span>
  </div>
  <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-genesis' ); ?></div>
  <?php }; ?>
 </div><!-- END .ajax_post_list_wrap -->
 <?php
        endif;
        wp_reset_postdata();
        $i++;
        endforeach;
      endif;
 ?>

</section><!-- END #archive_news -->


<?php get_footer(); ?>