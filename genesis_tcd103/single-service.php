<?php
     get_header();
     $options = get_design_plus_option();

     if ( have_posts() ) : while ( have_posts() ) : the_post();
       $cat_id = '';
       $category = wp_get_post_terms( $post->ID, 'service_category' , array( 'orderby' => 'term_order' ));
       if ( $category && ! is_wp_error($category) ) {
         foreach ( $category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'service_category');
           break;
         endforeach;
       };
       $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
       $sub_title = !empty($term_meta['sub_title']) ? $term_meta['sub_title'] : '';
       $single_service_overlay_color = hex2rgb($options['single_service_overlay_color']);
       $single_service_overlay_color = implode(",",$single_service_overlay_color);
?>

<div id="single_service_header" class="inview">

 <h1 class="title single_title entry-title"><span><?php the_title(); ?></span></h1>

 <?php if ( $category && ! is_wp_error($category) && $sub_title) { ?>
 <div class="category">
  <?php if ( $category && ! is_wp_error($category) ) { ?>
  <h2 class="large_headline"><span><?php echo wp_kses_post(nl2br($cat_name)); ?></span></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><span><?php echo wp_kses_post(nl2br($sub_title)); ?></span></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if(has_post_thumbnail()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 ?>
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 <?php }; ?>

 <div class="overlay" style="background:rgba(<?php echo esc_attr($single_service_overlay_color); ?>,<?php echo esc_attr($options['single_service_overlay_opacity']); ?>);"></div>

</div>

<?php get_template_part('template-parts/breadcrumb'); ?>

<article id="single_service_main_content">

 <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #article -->

<?php
     $service_link_list = get_post_meta($post->ID, 'service_link_list', true);
     if($service_link_list){
       $headline = get_post_meta($post->ID, 'service_link_list_headline', true);
       $sub_title = get_post_meta($post->ID, 'service_link_list_sub_title', true);
       $service_link_list_layout = get_post_meta($post->ID, 'service_link_list_layout', true) ?  get_post_meta($post->ID, 'service_link_list_layout', true) : 'type2';
?>
<section id="service_link_list">

 <div id="service_link_list_inner">

 <div class="design_header inview">
  <div class="title_area">
   <?php if($headline){ ?>
   <h3 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h3>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
 </div>

  <div class="post_list <?php echo esc_attr($service_link_list_layout); ?> inview slide_up_animation">
   <?php
        foreach ( $service_link_list as $key => $value ) :
          $catch = $value['catch'];
          $desc = isset($value['desc']) ?  $value['desc'] : '';
          $link_label = $value['link_label'];
          $url = $value['url'];
          $target = $value['target'];
          $image = $value['image'];
          $image_layout = isset($value['image_layout']) ?  $value['image_layout'] : 'type1';
          if($image){
            $image = wp_get_attachment_image_src( $image, 'full' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            if($service_link_list_layout == 'type1'){
              $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
              $image[1] = '770';
              $image[2] = '520';
            } else {
              $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
              $image[1] = '140';
              $image[2] = '140';
            }
          }
          if($url){
   ?>
   <a class="item layout_<?php echo esc_attr($image_layout); ?> animate_background" href="<?php echo esc_url($url); ?>"<?php if($target == 1){ echo ' target="_blank" rel="nofollow noopener"'; }; ?>>
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <div class="content">
     <?php if($catch){ ?>
     <h4 class="catch"><?php echo wp_kses_post(nl2br($catch)); ?></h4>
     <?php }; ?>
     <?php if($service_link_list_layout == 'type1' && $desc){ ?>
     <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
     <?php }; ?>
     <?php if($service_link_list_layout == 'type2' && $link_label){ ?>
     <p class="link_label"><span class="label"><?php echo wp_kses_post(nl2br($link_label)); ?></span><span class="arrow_button"></span></p>
     <?php }; ?>
    </div>
   </a>
   <?php }; endforeach; ?>
  </div>

 </div>

</section>
<?php }; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>