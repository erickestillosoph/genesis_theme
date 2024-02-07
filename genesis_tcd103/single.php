<?php
     get_header();
     $options = get_design_plus_option();
     if ( have_posts() ) : while ( have_posts() ) : the_post();
       $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
       if ( $category && ! is_wp_error($category) ) {
         foreach ( $category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'category');
           break;
         endforeach;
       };
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_content">

 <div id="single_post_header">
  <?php if ( $category && ! is_wp_error($category) ) { ?>
  <div class="category_button_list">
   <?php
        foreach ( $category as $cat ) :
          $cat_name = $cat->name;
          $cat_id = $cat->term_id;
          $cat_url = get_term_link($cat_id,'category');
   ?>
   <a class="category_button" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php endforeach; ?>
  </div>
  <?php }; ?>
  <h1 class="title entry-title"><?php the_title(); ?></h1>
  <?php if ($options['blog_show_date'] == 'display'){ ?>
  <div class="meta">
   <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php
        $post_date = get_the_time('Ymd');
        $modified_date = get_the_modified_date('Ymd');
        if($post_date < $modified_date){
   ?>
   <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>

 <div id="main_col">

  <article id="article">

   <?php if($page == '1') { // 1ページ目のみ表示 ?>

    <?php
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
    ?>
    <div id="single_post_header_image">
     <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_blog_show_sns'] == 'top' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy'] == 'top' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-genesis' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-genesis' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // 1ページ目のみ表示ここまで ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy'] == 'bottom' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-genesis' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-genesis' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns'] == 'bottom' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ( $options['single_blog_show_tag_list'] == 'display' && has_tag() ) {
          the_tags('<div id="post_tag_list">','','</div>');
        };
   ?>

   <?php
       // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post">
    <?php next_prev_post_link(); ?>
   </div>

   <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        $show_author = get_the_author_meta( 'show_author', $author_id );
        if(empty($show_author)){
          $show_author = '2';
        }
        if($show_author == '1') {
          $desc = $user_data->description;
          $facebook = $user_data->facebook_url;
          $twitter = $user_data->twitter_url;
          $insta = $user_data->instagram_url;
          $pinterest = $user_data->pinterest_url;
          $youtube = $user_data->youtube_url;
          $tiktok = $user_data->tiktok_url;
          $contact = $user_data->contact_url;
          $author_url = get_author_posts_url($author_id);
          $user_url = $user_data->user_url;
   ?>
   <div class="author_profile clearfix">
    <a class="avatar_area animate_background" href="<?php echo esc_url($author_url); ?>">
     <div class="image_wrap"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></div>
    </a>
    <div class="info">
     <div class="info_inner">
      <h4 class="name rich_font_type2"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></h4>
      <?php if($desc) { ?>
      <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
      <?php }; ?>
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
   </div><!-- END .author_profile -->
   <?php }; ?>

  </article><!-- END #article -->

  <?php
       // banner bottom ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // mobile banner ------------------------------------------------------------------------------------------------------------------------
       if(is_mobile()) {
         if( $options['single_mobile_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_mobile_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if (comments_open() || pings_open()) { comments_template('', true); };
  ?>

  <?php endwhile; endif; ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_contents -->

<?php
     // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     $categories = get_the_category($post->ID);
     if ($categories) {
       $post_num = $options['related_post_num'];
       if(is_mobile()){
         $post_num = $options['related_post_num_sp'];
       }
       $category_ids = array();
       foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
       $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
       $related_post_list = new wp_query($args);
       if($related_post_list->have_posts()):
?>
<section id="related_post">
 <h3 class="headline"><?php echo wp_kses_post(nl2br($options['related_post_headline'])); ?></h3>

 <div class="related_post_carousel_wrap">
  <div class="related_post_carousel swiper">
   <div class="blog_list swiper-wrapper">
    <?php
         while( $related_post_list->have_posts() ) : $related_post_list->the_post();
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
    <div class="item swiper-slide">
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
     </a>
     <div class="content">
      <?php
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               break;
             endforeach;
      ?>
      <a class="category_button" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php }; ?>
      <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
      <?php if ($options['blog_show_date'] == 'display'){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .blog_list -->
  </div><!-- END .related_post_carousel -->
  <div class="related_post_carousel_button_wrap">
   <div class="related_post_carousel_button_prev swiper-nav-button swiper-button-prev"><span class="arrow_button_small reverse"><span></span></span></div>
   <div class="related_post_carousel_button_next swiper-nav-button swiper-button-next"><span class="arrow_button_small"><span></span></span></div>
  </div>
  <div class="genesis_carousel_scrollbar">
   <div class="related_carousel_scrollbar swiper-scrollbar"></div>
  </div>
 </div><!-- END .related_post_carousel_wrap -->

</section><!-- END #related_post -->
<?php
         endif;
       };
?>

<?php get_footer(); ?>