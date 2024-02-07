<?php
/*
Template Name:Landing page
*/
__('Landing page', 'tcd-genesis');
     get_header();
     $options = get_design_plus_option();
     $catch = get_post_meta($post->ID, 'lp_catch', true);
     $catch_font_type = get_post_meta($post->ID, 'lp_catch_font_type', true) ?  get_post_meta($post->ID, 'lp_catch_font_type', true) : 'type2';
     $catch_font_direction = get_post_meta($post->ID, 'lp_catch_font_direction', true) ?  get_post_meta($post->ID, 'lp_catch_font_direction', true) : 'type2';

     $catch_mobile = get_post_meta($post->ID, 'lp_catch_mobile', true);
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'lp_image', true), 'full');
     $image_mobile = wp_get_attachment_image_src(get_post_meta($post->ID, 'lp_image_mobile', true), 'full');

     $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true);
     $hide_page_header_logo = get_post_meta($post->ID, 'hide_page_header_logo', true);
     $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
     if($hide_page_header != 'yes'){
?>
<div id="lp_page_header">
 <?php
      if($hide_page_header_bar == 'yes' && $hide_page_header_logo == 'no'){
        header_logo2();
      };
 ?>
 <?php if($catch){ ?>
 <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> align_<?php echo esc_attr($catch_font_direction); ?>"><?php if($catch_mobile){ echo '<span class="pc">'; }; ?><?php echo sepLine($catch); ?><?php if($catch_mobile){ echo '</span><span class="mobile">' .sepLine($catch_mobile) . '</span>'; }; ?></h1>
 <?php }; ?>
 <?php if(!empty($image)) { ?>
 <div class="overlay"></div>
 <div class="bg_image">
  <picture>
   <?php if($image_mobile) { ?>
   <source media="(max-width: 800px)" srcset="<?php echo esc_attr($image_mobile[0]); ?>">
   <?php }; ?>
   <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </picture>
 </div>
 <?php }; ?>
</div>
<?php }; ?>

<article id="page_contents">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

 <?php endwhile; endif; ?>

</article><!-- END #page_contents -->

<?php get_footer(); ?>