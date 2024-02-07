<?php
     $options = get_design_plus_option();
     get_header();
?>
<?php
     // 通常のコンテンツを読み込む ------------------------------------------------------------------------------
     if($options['index_content_type'] == 'type2'){
       if ( have_posts() ) : while ( have_posts() ) : the_post();
       $page_content_width = $options['page_content_width_type'] ?  $options['page_content_width_type'] : 'type1';
       if($page_content_width == 'type2'){
         $page_content_width_size = 'auto';
       } else {
         $page_content_width_size = $options['page_content_width'] . 'px';
       }
?>
<article id="front_page_contents" style="width:<?php echo esc_html($page_content_width_size); ?>; max-width:<?php echo esc_html($page_content_width_size); ?>;<?php if($page_content_width == 'type2'){ echo ' margin:0 !important;'; }; ?>">
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>
</div><!-- END #page_contents -->
<?php
        endwhile; endif;
     } else {
?>
<div id="content_builder">
<?php
     // コンテンツビルダー
     if ($options['contents_builder']) :
       $content_count = 1;
       $contents_builder = $options['contents_builder'];
       foreach($contents_builder as $content) :

         // デザインバナー --------------------------------------------------------------------------------
         if ( $content['cb_content_select'] == 'design_content' && $content['show_content'] ) {
           $headline = $content['headline'];
           $sub_title = $content['sub_title'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
           $button_url = $content['button_url'];
?>
<section class="cb_design_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="design_header cb_design_header inview">
  <div class="title_area<?php if(!$desc){ echo ' no_desc'; }; ?>">
   <?php if($headline){ ?>
   <h3 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h3>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
  <?php if($desc){ ?>
  <p class="desc <?php if($desc_mobile){ echo 'pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php if($desc_mobile){ ?>
  <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
  <?php }; ?>
  <?php }; ?>
 </div>

 <div class="item_list shutter_image inview col2 link_ver vertical">

  <?php
       for ( $i = 1; $i <= 2; $i++ ):
         $item_headline = $content['item_headline'.$i];
         $overlay_color = $content['overlay_color'.$i];
         $item_image = $content['item_image'.$i];
         $link_label = $content['item_title'.$i];
         $link_url = $content['item_url'.$i];
  ?>
  <div class="item">
   <?php if($item_headline){ ?>
   <h4 class="headline"><?php echo esc_html($item_headline); ?></h4>
   <?php
        if($overlay_color){
          $overlay_color = hex2rgb($overlay_color);
          $overlay_color = implode(",",$overlay_color);
   ?>
   <div class="overlay" style="background: linear-gradient(to bottom, rgba(<?php echo esc_attr($overlay_color); ?>,1) 0%,rgba(<?php echo esc_attr($overlay_color); ?>,0) 100%);"></div>
   <?php }; ?>
   <?php }; ?>
   <?php if($link_label && $link_url){ ?>
   <div class="post_list">
    <a href="<?php echo esc_url($link_url); ?>"><span class="label"><?php echo esc_html($link_label); ?></span><span class="arrow_button_small"><span></span></span></a>
   </div>
   <?php }; ?>
   <?php
        if($item_image){
          $item_image = wp_get_attachment_image_src($item_image, 'full');
   ?>
   <img loading="lazy" class="image" src="<?php echo esc_attr($item_image[0]); ?>" width="<?php echo esc_attr($item_image[1]); ?>" height="<?php echo esc_attr($item_image[2]); ?>" />
   <?php }; ?>
  </div>
  <?php endfor; ?>

 </div>

 <?php if($button_label && $button_url){ ?>
 <div class="design_arrow_button cb_design_arrow_button">
  <a href="<?php echo esc_url($button_url); ?>"><span class="label"><?php echo esc_html($button_label); ?></span><span class="arrow_button"></span></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_design_content -->

<?php
         // サービス一覧 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'service_list' && $content['show_content'] ) {
           $headline = $content['headline'];
           $sub_title = $content['sub_title'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
           $category_list = $content['category_list'];
           $category_list_count = $category_list ? count($category_list) : 0;
           $archive_service_type = $options['archive_service_type'] ? $options['archive_service_type'] : 'type1';
?>
<section class="cb_service_list num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="design_header cb_design_header inview">
  <div class="title_area<?php if(!$desc){ echo ' no_desc'; }; ?>">
   <?php if($headline){ ?>
   <h3 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h3>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
  <?php if($desc){ ?>
  <p class="desc <?php if($desc_mobile){ echo 'pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php if($desc_mobile){ ?>
  <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
  <?php }; ?>
  <?php }; ?>
 </div>

 <?php if($category_list){ ?>

 <?php if($category_list_count > 3){ ?>
 <div class="cb_service_category_list_wrap">
  <div class="cb_service_category_list <?php echo esc_attr($archive_service_type); ?> cb_service_category_list_carousel inview swiper">
   <div class="cb_service_category_list_inner swiper-wrapper">
 <?php } else { ?>
 <div class="cb_service_category_list <?php echo esc_attr($archive_service_type); ?> inview">
 <?php }; ?>
  <?php
       foreach ( $category_list as $cat ):
         $term = get_term($cat);
         if($term){
           $cat_id = $term->term_id;
           $cat_name = $term->name;
           $cat_url = get_term_link($cat_id,'service_category');
           $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
           $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
           $image = isset($term_meta['index_image']) ? wp_get_attachment_image_src( $term_meta['index_image'], 'full' ) : '';
           $image_mobile = isset($term_meta['index_image_mobile']) ? wp_get_attachment_image_src( $term_meta['index_image_mobile'], 'full' ) : '';
           $opacity_color = isset($term_meta['index_opacity_color']) ?  $term_meta['index_opacity_color'] : '#000000';
           $opacity_color = hex2rgb($opacity_color);
           $opacity_color = implode(",",$opacity_color);

  ?>
  <?php if($archive_service_type == 'type1'){ ?>
  <a href="<?php echo esc_url($cat_url); ?>" class="item animate_background<?php if($category_list_count > 3){ echo ' swiper-slide'; }; ?>">
  <?php } else { ?>
  <div class="item<?php if($category_list_count > 3){ echo ' swiper-slide'; }; ?>">
  <?php }; ?>
   <div class="title_area">
    <h3 class="headline"><?php echo esc_html($cat_name); ?></h3>
    <?php if($sub_title){ ?>
    <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
    <?php }; ?>
   </div>
   <div class="overlay" style="background: linear-gradient(to bottom, rgba(<?php echo esc_attr($opacity_color); ?>,1) 0%,rgba(<?php echo esc_attr($opacity_color); ?>,0) 100%);"></div>
   <?php
       if($archive_service_type == 'type2'){
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'id', 'terms' => $cat_id)) );
         $post_list = new wp_query($args);
         if($post_list->have_posts()):
   ?>
   <div class="post_list">
    <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
    <a href="<?php the_permalink(); ?>"><span class="label"><?php the_title(); ?></span><span class="arrow_button_small"><span></span></span></a>
    <?php endwhile; wp_reset_query(); ?>
   </div>
   <?php
          endif;
        };
   ?>
   <?php if($image){ ?>
   <div class="image_wrap">
    <img loading="lazy" class="image<?php if($image_mobile){ echo ' pc'; }?>" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    <?php if($image_mobile){ ?><img loading="lazy" class="image mobile" src="<?php echo esc_attr($image_mobile[0]); ?>" width="<?php echo esc_attr($image_mobile[1]); ?>" height="<?php echo esc_attr($image_mobile[2]); ?>" /><?php }; ?>
   </div>
   <?php }; ?>
  <?php if($archive_service_type == 'type1'){ ?>
  </a>
  <?php } else { ?>
  </div>
  <?php }; ?>
  <?php
         };
       endforeach
  ?>
 <?php if($category_list_count > 3){ ?>
   </div><!-- END .cb_service_category_list_inner -->
  </div><!-- END .cb_service_category_list -->
  <div class="cb_service_category_list_button_prev swiper-nav-button swiper-button-prev"><span class="arrow_button_small reverse"><span></span></span></div>
  <div class="cb_service_category_list_button_next swiper-nav-button swiper-button-next"><span class="arrow_button_small"><span></span></span></div>
 </div><!-- END .cb_service_category_list_wrap -->
 <?php } else { ?>
 </div><!-- END .cb_service_category_list -->
 <?php }; ?>
 <?php }; ?>

 <?php if($button_label){ ?>
 <div class="design_arrow_button cb_design_arrow_button">
  <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span class="label"><?php echo esc_html($button_label); ?></span><span class="arrow_button"></span></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_design_content -->

<?php
         // ブログ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'blog_list' && $content['show_content'] ) {
           $headline = $content['headline'];
           $sub_title = $content['sub_title'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
?>
<section class="cb_blog_list num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="design_header cb_design_header inview">
  <div class="title_area<?php if(!$desc){ echo ' no_desc'; }; ?>">
   <?php if($headline){ ?>
   <h3 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h3>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
  <?php if($desc){ ?>
  <p class="desc <?php if($desc_mobile){ echo 'pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php if($desc_mobile){ ?>
  <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
  <?php }; ?>
  <?php }; ?>
 </div>

 <?php
      if(is_mobile()){
        $post_num = $content['post_num_sp'];
      } else {
        $post_num = $content['post_num'];
      };
      $post_type = $content['post_type'] ? $content['post_type'] : 'recent_post';
      $post_order = $content['post_order'] ? $content['post_order'] : 'date';
      if($post_type == 'recent_post') {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>

 <div class="main_content inview">

 <div class="blog_carousel_wrap swiper">
  <div class="blog_carousel swiper-wrapper">
   <?php
        while ($post_list->have_posts()) : $post_list->the_post();
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
     <?php
          };
     ?>
     <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
     <?php if ($options['blog_show_date'] == 'display'){ ?>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php }; ?>
    </div>
   </div>
   <?php endwhile; ?>
  </div><!-- END .blog_list_carousel -->
 </div><!-- END .blog_list_carousel_wrap -->
 <div class="genesis_carousel_scrollbar">
  <div class="blog_carousel_scrollbar swiper-scrollbar"></div>
 </div>
 <?php endif; ?>

 </div>

 <?php if($button_label){ ?>
 <div class="design_arrow_button cb_design_arrow_button">
  <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span class="label"><?php echo esc_html($button_label); ?></span><span class="arrow_button"></span></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog -->

<?php
         // お知らせ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'news_list' && $content['show_content'] ) {
           $headline = $content['headline'];
           $sub_title = $content['sub_title'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
           $show_image = $options['news_show_image'] ?  $options['news_show_image'] : 'display';
?>
<section class="cb_news_list num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="design_header cb_design_header inview">
  <div class="title_area<?php if(!$desc){ echo ' no_desc'; }; ?>">
   <?php if($headline){ ?>
   <h3 class="large_headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h3>
   <?php }; ?>
   <?php if($sub_title){ ?>
   <p class="sub_title colored"><span><?php echo esc_html($sub_title); ?></span></p>
   <?php }; ?>
  </div>
  <?php if($desc){ ?>
  <p class="desc <?php if($desc_mobile){ echo 'pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php if($desc_mobile){ ?>
  <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
  <?php }; ?>
  <?php }; ?>
 </div>

 <div class="main_content inview">

  <?php
       // カテゴリー一覧 --------------------------------------
       $news_category_list = get_terms( 'news_category', array( 'hide_empty' => true ) );
       $category_total = count($news_category_list);
       if ( $news_category_list && ! is_wp_error( $news_category_list ) && ($category_total > 1) ) {
  ?>
  <div class="news_category_button swiper">
   <ol class="swiper-wrapper">
    <li class="swiper-slide current"><a data-category-id="news_cat_all" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php _e('All post', 'tcd-genesis');  ?></a></li>
    <?php
         foreach ( $news_category_list as $cat ):
           $cat_id = $cat->term_id;
           $cat_name = $cat->name;
           $cat_url = get_term_link($cat_id,'news_category');
    ?>
    <li class="swiper-slide"><a data-category-id="news_cat_<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a></li>
    <?php endforeach; ?>
   </ol>
  </div>
  <div class="genesis_carousel_scrollbar">
   <div class="news_category_scrollbar swiper-scrollbar"></div>
  </div>
  <?php }; ?>

  <div id="index_news_list_wrap">

   <?php
        // 最新の記事一覧 ----------------------
        if(is_mobile()){
          $post_num = $content['post_num_sp'];
        } else {
          $post_num = $content['post_num'];
        };
        $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num);
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
   ?>
   <div class="index_news_list active" id="news_cat_all">
    <div class="index_news_list_inner">
     <div class="news_carousel_cat_all_wrap">
      <div class="news_carousel_wrap swiper" id="news_carousel_cat_all">
       <div class="news_carousel swiper-wrapper">
        <?php
             while ($post_list->have_posts()) : $post_list->the_post();
               if($show_image == 'display'){
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
               }
        ?>
        <div class="item swiper-slide<?php if($show_image == 'hide'){ echo ' no_image'; }; ?>">
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
        <?php endwhile; ?>
       </div><!-- END .news_carousel -->
      </div><!-- END .news_carousel_wrap -->
     </div><!-- END .news_carousel_cat_all_wrap -->
     <div class="genesis_carousel_scrollbar">
      <div class="swiper-scrollbar" id="news_carousel_scrollbar"></div>
     </div>
    </div><!-- END index_news_list_inner -->
   </div><!-- END index_news_list -->
   <?php endif; ?>

   <?php
        // カテゴリー別　記事一覧 ---------------------------------------------------
        if ( $news_category_list && ! is_wp_error( $news_category_list ) && ($category_total > 1)) :
          $i = 1;
          foreach ( $news_category_list as $cat ):
            $cat_id = $cat->term_id;
            $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
            $post_list = new wp_query($args);
            $all_post_count = $post_list->found_posts;
            if($post_list->have_posts()):
   ?>
   <div class="index_news_list" id="news_cat_<?php echo esc_attr($cat_id); ?>">
    <div class="index_news_list_inner">
     <div class="news_carousel_wrap swiper" id="news_carousel_cat_<?php echo esc_attr($cat_id); ?>">
      <div class="news_carousel swiper-wrapper">
       <?php
            while ($post_list->have_posts()) : $post_list->the_post();
             if($show_image == 'display'){
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
             }
       ?>
       <div class="item swiper-slide<?php if($show_image == 'hide'){ echo ' no_image'; }; ?>">
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
       <?php endwhile; ?>
      </div><!-- END .news_carousel -->
     </div><!-- END .news_carousel_wrap -->
     <div class="genesis_carousel_scrollbar">
      <div class="swiper-scrollbar" id="news_carousel_scrollbar_cat_<?php echo esc_attr($cat_id); ?>"></div>
     </div>
    </div><!-- END index_news_list_inner -->
   </div><!-- END index_news_list -->
   <?php
            endif;
            wp_reset_postdata();
            $i++;
          endforeach;
        endif;
   ?>

  </div><!-- END #index_news_list_wrap -->

 <?php if($button_label){ ?>
 <div class="design_arrow_button cb_design_arrow_button">
  <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span class="label"><?php echo esc_html($button_label); ?></span><span class="arrow_button"></span></a>
 </div>
 <?php }; ?>

 </div>

</section><!-- END .cb_news -->

<?php
         // フリースペース -----------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
?>
<section class="cb_free_space num<?php echo $content_count; ?> <?php if($content['content_width'] == 'type2'){ echo 'wide_content'; }; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($content['free_space']){ ?>
 <div class="post_content clearfix">
  <?php echo apply_filters('the_content', $content['free_space'] ); ?>
 </div>
 <?php }; ?>

</section><!-- END .cb_free_space -->
<?php
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで
?>
</div><!-- END #content_builder -->
<?php
      }; // END index_content_type
?>

<?php get_footer(); ?>