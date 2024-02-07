<?php
     get_header();
     $options = get_design_plus_option();
     $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'no';
     $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';
     $headline = get_post_meta($post->ID, 'header_headline', true) ?  get_post_meta($post->ID, 'header_headline', true) : get_the_title();
     $sub_title = get_post_meta($post->ID, 'header_sub_title', true);
     $catch = get_post_meta($post->ID, 'header_catch', true);
     $desc = get_post_meta($post->ID, 'header_desc', true);
     $desc_mobile = get_post_meta($post->ID, 'header_desc_mobile', true);
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
?>
<?php if($hide_breadcrumb == 'no'){ get_template_part('template-parts/breadcrumb'); }; ?>

<div id="page_header"<?php if($image){ echo ' class="show_image"'; }; if(!$catch && !$desc && !$image){ echo ' class="large_height"'; }; ?>>
 <div class="design_header inview">
  <div class="title_area no_desc">
   <?php if($headline){ ?>
   <h1 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
 </div>
 <?php if($catch || $desc){ ?>
 <div class="desc_area inview slide_up_animation">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?>"><?php echo wp_kses_post(nl2br($desc)); ?></div>
  <?php if($desc_mobile){ ?>
  <div class="desc mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></div>
  <?php }; ?>
  <?php }; ?>
 </div>
 <?php }; ?>
 <?php if($image) { ?>
 <div class="image">
  <div class="overlay"></div>
  <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 </div>
 <?php }; ?>
</div>

<?php if($hide_sidebar == 'yes'){ ?>

<article id="page_contents">

 <div class="post_content"><?php the_content(); if ( ! post_password_required() ) { custom_wp_link_pages(); } ?></div>

</article><!-- END #page_contents -->

<?php } else { ?>

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php }; ?>

<?php get_footer(); ?>