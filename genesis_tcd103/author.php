<?php
     get_header();
     $options = get_design_plus_option();

     $author_info = $wp_query->get_queried_object();
     $author_id = $author_info->ID;
     $user_data = get_userdata($author_id);
     $user_name = $user_data->display_name;
?>
<?php
     if(!empty($user_data->show_author) && !is_paged()) {
       $desc = $user_data->description;
       $facebook = $user_data->facebook_url;
       $twitter = $user_data->twitter_url;
       $insta = $user_data->instagram_url;
       $pinterest = $user_data->pinterest_url;
       $youtube = $user_data->youtube_url;
       $tiktok = $user_data->tiktok_url;
       $user_url = $user_data->user_url;
       $contact = $user_data->contact_url;
?>
<div id="author_archive_header">

 <div class="content inview slide_up_animation">

  <div class="image_area">
   <div class="avatar_area">
    <?php echo wp_kses_post(get_avatar($author_id, 300)); ?>
   </div>
   <div class="title_area">
    <h4 class="name"><?php echo esc_html($user_name); ?></h4>
    <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url || $tiktok) { ?>
    <ul id="author_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
     <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
     <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
     <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
     <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
     <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
     <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
     <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
     <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div>
  </div>

  <?php if($desc) { ?>
  <div class="desc">
   <p><?php echo esc_html($desc); ?></p>
  </div>
  <?php }; ?>

 </div>

</div><!-- END #author_archive_header -->
<?php }; ?>

<section id="archive_blog">

 <h4 id="author_headline" class="common_headline inview slide_up_animation"><?php printf( __( '%s blog list', 'tcd-genesis' ), $user_name ); ?></h4>

 <?php if ( have_posts() ) : ?>

 <div class="blog_list inview slide_up_animation">
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