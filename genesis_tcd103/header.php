<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<div id="js-body-start"></div>

<?php
     // ロード画面 --------------------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       load_icon();
     };

     // メッセージ --------------------------------------------------------------------
     if(!is_404()){
       if( (is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
         $message = $options['header_message'];
         $url = $options['header_message_url'];
         $target = $options['header_message_target'];
         $font_color = $options['header_message_font_color'];
         $bg_color = $options['header_message_bg_color'];
         if($message){
?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
 <?php if($url){ ?>
 <a href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
 <?php }else{ ?>
 <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
 <?php } ?>
</div>
<?php
         };
       };
     };
?>

<?php
     // ヘッダー ----------------------------------------------------------------------
      if(is_page_template('page-tcd-lp.php')){ 
        $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true) ?  get_post_meta($post->ID, 'hide_page_header_bar', true) : 'no';
      } else {
        $hide_page_header_bar = 'no';
      }
      if( $hide_page_header_bar != 'yes' ) {
?>
<header id="header"<?php if(is_404() || (is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts()) ){ } else { echo ' class="first_animate"'; }; ?>>
 <?php
      // ロゴ ----------------------------------------
      header_logo();
      if(is_singular('service') || (is_front_page() && $options['index_slider_image'] && $options['index_slider_layout'] == 'type3')){
        header_logo2();
      }

      // グローバルメニュー ----------------------------------------------------------------
      if ( has_nav_menu('global-menu') ) {
 ?>
 <?php if ( has_nav_menu('drawer-menu') ) { ?><a id="drawer_menu_button" href="#"><span></span><span></span><span></span></a><?php }; ?>
 <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => 'nav', 'container_id' => 'global_menu'  ) ); ?>
 <?php
      };

      // 検索フォーム --------------------------------------------------------------------
      if( $options['show_header_search'] == 'display') {
        if(is_search() && isset($_GET['s']) && !empty($_GET['s'])){
          $search_keyword = $_GET['s'];
        } else {
          $search_keyword = '';
        };
 ?>
 <div id="header_search">
  <form role="search" method="get" id="header_searchform" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="<?php echo esc_attr($search_keyword); ?>" id="header_search_input" name="s" autocomplete="off"></div>
   <div class="search_button"><input type="submit" id="header_search_button" value=""></div>
  </form>
 </div>
 <?php }; ?>

 <?php get_template_part( 'template-parts/megamenu' ); ?>

</header>
<?php }; ?>

<div id="container">

 <?php
      //  トップページ -------------------------------------------------------------------------
      if(is_front_page() && $options['index_slider_image']) {

        //  ヘッダースライダー -------------------------------------------------------------------------
 ?>
 <div id="header_slider_wrap" class="layout_<?php echo esc_attr($options['index_slider_layout']); ?>">

  <?php
       // キャッチフレーズエリア -----------------
       $catch = $options['index_slider_catch'];
       $catch_font_type = $options['index_slider_catch_font_type'];
       $desc = $options['index_slider_desc'];
       $desc_mobile = $options['index_slider_desc_mobile'];
  ?>
  <div id="header_slider_content">
   <div class="content">
    <?php if($catch){ ?>
    <h2 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php echo sepLine($catch); ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <div class="desc_area">
     <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?>"><?php echo sepLine($desc); ?></p>
     <?php if($desc_mobile){ ?><p class="desc mobile"><?php echo sepLine($desc_mobile); ?></p><?php }; ?>
    </div>
    <?php }; ?>
   </div>
  </div>

  <?php
       // スライダーエリア -----------------
        $index_header_content_type = $options['index_header_content_type'];
        $overlay = hex2rgb($options['index_header_content_overlay_color']);
        $overlay = implode(",",$overlay);
        $overlay_opacity = $options['index_header_content_overlay_opacity'];
        $slide_type = $options['index_header_slide_type'] ?  $options['index_header_slide_type'] : 'slide_up';
        $slide_effect = $options['index_header_slide_effect'] ?  $options['index_header_slide_effect'] : 'zoom_in';
  ?>
  <div id="header_slider" class="swiper slide_type_<?php echo esc_attr($slide_type); ?> effect_type_<?php echo esc_attr($slide_effect); ?>" data-fade_speed="<?php if($slide_type == 'slide_up'){ echo '1000'; } else { echo '2000'; }; ?>">
   <div class="swiper-wrapper">
    <?php
         // 画像スライダー
         if($index_header_content_type == 'type1'){
           $i = 1;
           $images = $options['index_slider_image'];
           if(is_mobile()){
             $images = $options['index_slider_image_sp'] ?  $options['index_slider_image_sp'] : $options['index_slider_image'];
           }
           $images = $images ? explode( ',', $images ) : array();
           if( !empty( $images ) ){
    ?>
    <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
    <?php
             foreach( $images as $image_id ):
               $image = wp_get_attachment_image_src( $image_id, 'full' );
               if( $image ){
    ?>
    <div class="swiper-slide item item<?php echo $i; if($i == 1){ echo ' first_item'; }; ?>" data-item-type="type1">
     <div class="item-inner">
      <div class="bg_image">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
      </div>
     </div>
    </div><!-- END .item -->
    <?php
               };
               $i++;
             endforeach;
           };

         // 動画
         } elseif($index_header_content_type == 'type2') {
           $video_url = $options['index_header_content_video'];
           if($video_url){
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type2">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <video class="bg_video" src="<?php echo esc_url(wp_get_attachment_url($video_url)); ?>" playsinline muted></video>
     </div>
    </div><!-- END .item -->
    <?php
           };

         // YouTube
         } elseif($index_header_content_type == 'type3') {
           if ( $options['index_header_content_youtube'] && preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $options['index_header_content_youtube'], $matches ) ) {
             $youtube_id = $matches[1];
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type3">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <div class="bg_youtube" data-video-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
     </div>
    </div><!-- END .item -->
    <?php
           };
         };
    ?>
   </div>
  </div><!-- END #header_slider -->

 </div><!-- END #header_slider_wrap -->
 <?php
      }; // END front page

