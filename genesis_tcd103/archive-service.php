<?php
     get_header();
     $options = get_design_plus_option();

     $title = $options['archive_service_headline'];
     $sub_title = $options['archive_service_sub_title'];
     $catch = $options['archive_service_catch'];
     $desc = $options['archive_service_desc'];
     $desc_mobile = $options['archive_service_desc_mobile'];
     $header_image = wp_get_attachment_image_src($options['archive_service_header_image'], 'full');
     $archive_service_type = $options['archive_service_type'] ? $options['archive_service_type'] : 'type1';
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<section class="service_category_content">

 <div class="header">

  <div class="design_header inview">
   <div class="title_area no_desc">
    <h2 class="large_headline"><span><?php echo esc_html($title); ?></span></h2>
    <?php if($sub_title){ ?>
    <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
    <?php }; ?>
   </div>
  </div>

  <div class="desc_area inview slide_up_animation">
   <?php if($catch){ ?>
   <h3 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
   <?php }; ?>
   <?php if($desc){ ?>
   <p class="desc post_content"><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ ?></span><span class="desc mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
   <?php }; ?>
  </div>

 </div>

</section>

<?php if($header_image){ ?>
<div class="service_header_image">
 <img loading="lazy" src="<?php echo esc_attr($header_image[0]); ?>" alt="" width="<?php echo esc_attr($header_image[1]); ?>" height="<?php echo esc_attr($header_image[2]); ?>">
</div>
<?php }; ?>

<div id="archive_service">

 <?php
      $category_list = get_terms( 'service_category' );
      if ( $category_list && ! is_wp_error( $category_list ) ) :
 ?>
 <div id="service_category_list">
  <?php
       $i = 1;
       foreach ( $category_list as $cat ):
         $cat_id = $cat->term_id;
         $cat_name = $cat->name;
         $cat_url = get_term_link($cat_id,'service_category');
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
         $catch = isset($term_meta['catch']) ?  $term_meta['catch'] : '';
         $desc = isset($term_meta['desc1']) ?  $term_meta['desc1'] : '';
         $desc_mobile = isset($term_meta['desc1_mobile']) ?  $term_meta['desc1_mobile'] : '';
         $post_list_type = isset($term_meta['post_list_type']) ?  $term_meta['post_list_type'] : 'type2';
         $image = isset($term_meta['image1']) ? wp_get_attachment_image_src( $term_meta['image1'], 'full' ) : '';
  ?>
  <section class="service_category_content<?php if($i % 2 == 0) { echo ' even'; } else { echo ' odd'; }; ?>" id="service_category_content<?php echo esc_attr($cat_id); ?>">

   <div class="header">

    <div class="design_header inview">
     <div class="title_area no_desc">
      <h2 class="large_headline"><span><?php echo esc_html($cat_name); ?></span></h2>
      <?php if($sub_title){ ?>
      <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
      <?php }; ?>
     </div>
    </div>

    <div class="desc_area inview slide_up_animation">
     <?php if($catch){ ?>
     <h3 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
     <?php }; ?>
     <?php if($desc){ ?>
     <p class="desc post_content"><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
     <?php }; ?>
    </div>

    <?php
        // カテゴリーページを表示する場合
        if($archive_service_type == 'type1'){
    ?>
    
                 <div class="design_full_button justify_content_end d_flex cb_design_full_button">
                    <a href="<?php echo esc_url($cat_url); ?>"><span class="label">
                        <?php echo esc_html($sub_title); ?>
                      </span><span class="arrow_full_button"></span></a>
                  </div>
    <?php }; ?>

   </div>

   <?php
        // カテゴリーページを表示しない場合
        if($archive_service_type == 'type2'){

        // 記事一覧
        $post_num = '-1';
        if($post_list_type == 'type1') {
          $image_size = 'size2';
        } else {
          $image_size = 'size1';
        }
        $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'id', 'terms' => $cat_id)) );
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
   ?>
   <div class="post_list <?php echo esc_attr($post_list_type); ?> inview slide_up_animation">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             if($post_list_type == 'type1') {
               $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
               $image[1] = '770';
               $image[2] = '520';
             } else {
               $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
               $image[1] = '190';
               $image[2] = '190';
             }
           }
    ?>
    <div class="item">
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <h4 class="title"><span><?php the_title(); ?></span></h4>
       <p class="desc"><span><?php echo trim_excerpt(100); ?></span></p>
      </div>
     </a>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div>
   <?php
          endif;
        };
   ?>

  </section>
  <?php $i++; endforeach; ?>
 </div>
 <?php endif; ?>


</div><!-- END #archive_service -->

<?php get_footer(); ?>