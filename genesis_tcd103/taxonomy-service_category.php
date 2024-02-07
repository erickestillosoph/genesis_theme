<?php
     $options = get_design_plus_option();
     $archive_service_type = $options['archive_service_type'] ? $options['archive_service_type'] : 'type1';

     if($archive_service_type == 'type2'){

       $archive_page = get_post_type_archive_link('service');
       wp_safe_redirect( $archive_page );
       exit;

     } else {

     get_header();

     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;

     $title = single_cat_title('', false);
     $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
     $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
     $catch = isset($term_meta['catch']) ?  $term_meta['catch'] : '';
     $desc1 = isset($term_meta['desc1']) ?  $term_meta['desc1'] : '';
     $desc2 = isset($term_meta['desc2']) ?  $term_meta['desc2'] : '';
     $desc3 = isset($term_meta['desc3']) ?  $term_meta['desc3'] : '';
     $desc1_mobile = isset($term_meta['desc1_mobile']) ?  $term_meta['desc1_mobile'] : '';
     $desc2_mobile = isset($term_meta['desc2_mobile']) ?  $term_meta['desc2_mobile'] : '';
     $desc3_mobile = isset($term_meta['desc3_mobile']) ?  $term_meta['desc3_mobile'] : '';
     $header_image = isset($term_meta['image1']) ? wp_get_attachment_image_src( $term_meta['image1'], 'full' ) : '';
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
   <?php if($desc1){ ?>
   <p class="desc post_content"><?php if($desc1_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc1)); ?><?php if($desc1_mobile){ ?></span><span class="desc mobile"><?php echo wp_kses_post(nl2br($desc1_mobile)); ?></span><?php }; ?></p>
   <?php }; ?>
  </div>

 </div>

</section>

<?php if($header_image){ ?>
<div class="service_header_image">
 <img loading="lazy" src="<?php echo esc_attr($header_image[0]); ?>" alt="" width="<?php echo esc_attr($header_image[1]); ?>" height="<?php echo esc_attr($header_image[2]); ?>">
</div>
<?php }; ?>

<?php if($desc2 || $desc3){ ?>
<div class="service_header_desc inview slide_up_animation">
 <?php if($desc2){ ?>
 <p class="desc post_content"><?php if($desc2_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc2)); ?><?php if($desc2_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($desc2_mobile)); ?></span><?php }; ?></p>
 <?php }; ?>
 <?php if($desc3){ ?>
 <p class="desc post_content"><?php if($desc3_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc3)); ?><?php if($desc3_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($desc3_mobile)); ?></span><?php }; ?></p>
 <?php }; ?>
</div>
<?php }; ?>

<div id="archive_service" class="inview slide_up_animation">

 <?php if ( have_posts() ) : ?>

 <div class="service_category_post_list">
  <?php
       while ( have_posts() ) : the_post();
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
  <?php endwhile; ?>
 </div><!-- END .service_category_post_list -->

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-genesis');  ?></p>

 <?php endif; ?>

</div><!-- END #archive_service -->

<?php get_footer(); }; ?>