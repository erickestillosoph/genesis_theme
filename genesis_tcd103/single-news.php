<?php
     get_header();
     $options = get_design_plus_option();
     if ( have_posts() ) : while ( have_posts() ) : the_post();
       $show_image = $options['news_show_image'] ?  $options['news_show_image'] : 'display';
       $category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_content">

 <div id="single_post_header">
  <?php if ( $category && ! is_wp_error($category) ) { ?>
  <div class="category_button_list">
   <?php
        foreach ( $category as $post_cat ) :
          $post_cat_name = $post_cat->name;
          $post_cat_id = $post_cat->term_id;
          $post_cat_url = get_term_link($post_cat_id,'news_category');
   ?>
   <a class="category_button" href="<?php echo esc_url($post_cat_url); ?>"><?php echo esc_html($post_cat_name); ?></a>
   <?php endforeach; ?>
  </div>
  <?php }; ?>
  <h1 class="title entry-title"><?php the_title(); ?></h1>
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
 </div>

 <div id="main_col">

  <article id="article">

   <?php if($page == '1') { // 1ページ目のみ表示 ?>

   <?php
        if($show_image == 'display'){
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <div id="single_post_header_image">
    <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <?php }; }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_news_show_sns'] == 'top' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'top' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-genesis' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-genesis' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_news_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code']; ?>
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
        if($options['single_news_show_copy'] == 'bottom' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-genesis' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-genesis' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns'] == 'bottom' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>

  </article><!-- END #article -->

  <?php
       // banner bottom ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_news_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // mobile banner ------------------------------------------------------------------------------------------------------------------------
       if(is_mobile()) {
         if( $options['single_news_mobile_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_mobile_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // recent post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
         $post_num = $options['recent_news_num'];
         if(is_mobile()){
           $post_num = $options['recent_news_num_sp'];
         }
         $args =  array('post_type' => 'news', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
         $recent_post_list = new wp_query($args);
         if($recent_post_list->have_posts()):
  ?>
  <div id="recent_news">
   <h3 class="headline"><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></h3>
   <div class="post_list">
    <?php
         while( $recent_post_list->have_posts() ) : $recent_post_list->the_post();
           if($show_image == 'display'){
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
             } elseif($options['no_image']) {
               $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
             } else {
               $image = array();
               $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
               $image[1] = '140';
               $image[2] = '140';
             }
           }
    ?>
    <div class="item<?php if($show_image == 'hide'){ echo ' no_image'; }; ?>">
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
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END #related_post -->
  <?php
         endif;
  ?>

  <?php endwhile; endif; ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>