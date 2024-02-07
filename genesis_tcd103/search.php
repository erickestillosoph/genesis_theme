<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['search_result_headline'];
     $sub_title = sprintf( __( 'Search result for %s', 'tcd-genesis' ), get_search_query() );
?>

<?php
     // 検索結果がある場合
     if ( isset($_GET['s']) && !empty($_GET['s']) && have_posts() ) :
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<?php if(!is_paged()){ ?>
<div id="archive_header">
 <div class="title_area">
  <h2 class="large_headline"><?php echo esc_html($title); ?></h2>
  <?php if($sub_title){ ?>
  <p class="sub_title colored"><?php echo esc_html($sub_title); ?></p>
  <?php }; ?>
 </div>
</div>
<?php }; ?>

<div id="archive_blog">

 <div class="blog_list">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '770';
           $image[2] = '520';
         }
  ?>
  <div class="item">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <div class="content">
    <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

</div><!-- END #archive_blog -->

<?php
     else:

     // 検索結果が無い場合、もしくはキーワードが空の場合 --------------------------------------------------------------------
     $bg_image = wp_get_attachment_image_src($options['search_result_bg_image'], 'full');
     $overlay_color = hex2rgb($options['search_result_overlay_color']);
     $overlay_opacity = $options['search_result_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
?>

<div id="no_search_result"<?php if($bg_image){ echo ' class="has_bg_image"'; }; ?>>

 <div class="content">
  <?php if($title){ ?>
  <h2 class="headline"><?php echo nl2br(esc_html($title)); ?></h2>
  <?php } ?>
  <?php if ($options['search_result_desc']) { ?>
  <p class="desc"><?php if(empty($_GET['s'])){ echo __( 'Search keyword is blank.', 'tcd-genesis' ); } else { echo wp_kses_post(nl2br($options['search_result_desc'])); }; ?></p>
  <?php } ?>
  <div class="search_form">
   <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
    <div class="input_area"><input <?php if($options['search_result_placeholder']){ echo 'placeholder="' . esc_html($options['search_result_placeholder']) . '"'; }; ?> type="text" value="" name="s" autocomplete="off"></div>
    <div class="search_button"><label for="no_search_result_button"></label><input type="submit" id="no_search_result_button" value=""></div>
   </form>
  </div>
 </div>

 <?php if(!empty($bg_image) && $options['search_result_overlay_opacity'] != 0){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>

<?php endif; ?>

<?php get_footer(); ?>