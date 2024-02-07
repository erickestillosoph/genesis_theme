<?php
     get_header();
     $options = get_design_plus_option();

     $title = $options['archive_blog_headline'];
     $sub_title = $options['archive_blog_sub_title'];
     $desc = $options['archive_blog_desc'];
     $desc_mobile = $options['archive_blog_desc_mobile'];
     if (is_category()) {
       $query_obj = get_queried_object();
       $sub_title = $query_obj->name;
       $desc = $query_obj->description;
       $desc_mobile = '';
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $sub_title = $query_obj->name;
     } elseif ( is_day() ) {
       $sub_title = sprintf( __( 'Archive for %s', 'tcd-genesis' ), get_the_time( __( 'F jS, Y', 'tcd-genesis' ) ) );
     } elseif ( is_month() ) {
       $sub_title = sprintf( __( 'Archive for %s', 'tcd-genesis' ), get_the_time( __( 'F, Y', 'tcd-genesis') ) );
     } elseif ( is_year() ) {
       $sub_title = sprintf( __( 'Archive for %s', 'tcd-genesis' ), get_the_time( __( 'Y', 'tcd-genesis') ) );
     } elseif(is_author()) {
       $author_info = $wp_query->get_queried_object();
       $author_id = $author_info->ID;
       $user_data = get_userdata($author_id);
       $user_name = $user_data->display_name;
       $title = sprintf( __( 'Archive for %s', 'tcd-genesis' ), $user_name );
       $sub_title = '';
     }
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<?php if(!is_paged()){ ?>
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
<?php }; ?>

<section id="archive_blog" class="inview slide_up_animation">

 <?php if ( have_posts() ) : ?>

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
    <?php
         if(!is_category()) {
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               break;
             endforeach;
    ?>
    <a class="category_button" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a>
    <?php
           };
         };
    ?>
    <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
    <?php if ($options['blog_show_date'] == 'display'){ ?>
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-genesis');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_blog -->

<?php get_footer(); ?>