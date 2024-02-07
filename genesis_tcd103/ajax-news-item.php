<?php
     $options = get_design_plus_option();

     if(is_mobile()){
       $post_num = $options['archive_news_num_sp'];
     } else {
       $post_num = $options['archive_news_num'];
     }

     $def_offset = $post_num;
     $offset = isset( $_POST['offset_post_num'] ) ? $_POST['offset_post_num'] : $def_offset;
     $post_cat_id = isset( $_POST['post_cat_id'] ) ? $_POST['post_cat_id'] : '';
     $next_load_num = $post_num;
     $posts_per_page = $next_load_num;

     if($post_cat_id){
       $all_query = new WP_Query( array('post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $post_cat_id ) )) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'offset' => $offset, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $post_cat_id ) ) );
     } else {
       $all_query = new WP_Query( array('post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => -1) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'offset' => $offset );
     }

     $post_list = new wp_query($args);
     $show_image = $options['news_show_image'] ?  $options['news_show_image'] : 'display';
     if($post_list->have_posts()):
       $entry_item = '';
       ob_start();
       while ( $post_list->have_posts() ) : $post_list->the_post();
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
   <div class="item ajax_item offset_<?php echo $offset; ?><?php if($show_image == 'hide'){ echo ' no_image'; }; ?>" style="opacity:0; display:none;">
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
<?php
       endwhile;
       $entry_item .= ob_get_contents();
       ob_end_clean();
     endif;

     wp_send_json( array(
       'html' => $entry_item,
       'remain' => $all_post_count - ( $offset + $post_list->post_count )
     ) );
?>