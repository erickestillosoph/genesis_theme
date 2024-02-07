<?php $options = get_design_plus_option(); ?>

 <?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
      } else {
        $page_hide_footer = 'no';
      }

      if($page_hide_footer != 'yes'){
 ?>

 <?php
      // バナー --------------------------------------------------
      if( $options['show_footer_banner']){
        $banner_num = 0;
        for ( $i = 1; $i <= 3; $i++ ) :
          $image = $options['footer_banner_image'.$i];
          if($image){
            $banner_num++;
          }
        endfor;
 ?>
 <div id="footer_banner" class="banner_num<?php echo esc_attr($banner_num); ?>">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) :
         $image = $options['footer_banner_image'.$i];
         if($image) {
            $title = $options['footer_banner_title'.$i];
            $sub_title = $options['footer_banner_sub_title'.$i];
            $url = $options['footer_banner_url'.$i];
            $target = $options['footer_banner_target'.$i];
            $image = wp_get_attachment_image_src($image, 'full');
  ?>
  <a class="item animate_background" href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?>>
   <div class="content">
    <?php if($title){ ?><p class="title large_headline"><span class="label"><?php echo esc_html($title); ?></span><span class="arrow_button"></span></p><?php }; ?>
    <?php if($sub_title){ ?><p class="sub_title colored"><?php echo esc_html($sub_title); ?></p><?php }; ?>
   </div>
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
  </a>
  <?php
         };
       endfor;
  ?>
 </div>
 <?php }; ?>

 <?php }; // end hide footer ?>

 <?php // 住所エリア -------------------------------------------------- ?>
 <footer id="footer">

  <?php if($page_hide_footer != 'yes'){ ?>

  <div id="footer_inner">

   <?php
        // ロゴ ----------------------------------------
        footer_logo();
   ?>

   <?php
        // 住所 ----------------------------------------
        if($options['footer_address']){
   ?>
   <div id="footer_address" class="post_content clearfix">
    <?php echo apply_filters('the_content', $options['footer_address'] ); ?>
   </div>
   <?php }; ?>

   <?php
        // SNSボタン ------------------------------------
        if($options['show_sns_footer'] == 'display') {
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $tiktok = $options['sns_button_tiktok_url'];
          $contact = $options['sns_button_contact_url'];
          $show_rss = $options['sns_button_show_rss'];
   ?>
   <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

  </div>

  <?php
       // メニュー --------------------------------------------
       if (has_nav_menu('footer-menu')) {
  ?>
  <div id="footer_nav" class="swiper">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'depth' => '1', 'menu_class' => 'swiper-wrapper', 'container' => '', 'add_li_class'  => 'swiper-slide'  ) ); ?>
  </div>
  <?php }; ?>

  <?php
       }; // hide footer
  ?>

  <?php // コピーライト ?>
  <p id="copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>

 </footer>

</div><!-- #container -->

<div id="return_top">
 <a class="no_auto_scroll" href="#body"><span class="arrow"><span></span></span></a>
</div>

<?php
     // モバイル用ドロワーメニュー --------------------------------------------
     if (has_nav_menu('drawer-menu')) {
?>
<div id="drawer_menu">

 <div class="header">
  <div id="drawer_mneu_close_button"></div>
 </div>

 <?php // メニュー  ?>
 <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'drawer-menu' , 'container' => 'div', 'container_id' => 'mobile_menu'  ) ); ?>

 <?php
      // 検索フォーム --------------------------------------------------------------------
      if( $options['show_header_search'] == 'display') {
 ?>
 <div id="drawer_menu_search">
  <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" name="s" autocomplete="off"></div>
   <div class="button_area"><label for="drawer_menu_search_button"></label><input id="drawer_menu_search_button" type="submit" value=""></div>
  </form>
 </div>
 <?php }; ?>

 <?php
      // SNSボタン ------------------------------------
      if($options['show_sns_mobile'] == 'display') {
        $facebook = $options['sns_button_facebook_url'];
        $twitter = $options['sns_button_twitter_url'];
        $insta = $options['sns_button_instagram_url'];
        $pinterest = $options['sns_button_pinterest_url'];
        $youtube = $options['sns_button_youtube_url'];
        $tiktok = $options['sns_button_tiktok_url'];
        $contact = $options['sns_button_contact_url'];
        $show_rss = $options['sns_button_show_rss'];
 ?>
 <ul id="mobile_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
  <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
  <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
  <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
  <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
  <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
  <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
  <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
  <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
 </ul>
 <?php }; ?>

</div>
<?php }; ?>

<?php
     // フッターバー ----------------------------------------------------------
     do_action( 'tcd_footer_after', $options );
?>
<?php
     // share button ----------------------------------------------------------------------
     if ( (is_singular('post') && $options['single_blog_show_sns'] != 'hide') || (is_singular('news') && $options['single_news_show_sns'] != 'hide') ) :
       if ( $options['sns_share_design_type'] == 'type5') :
         if ( $options['show_sns_share_twitter'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_sns_share_fblike'] || $options['show_sns_share_fbshare'] ) :
?>
<div id="fb-root"></div>
<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<?php
         endif;
         if ( $options['show_sns_share_hatena'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_sns_share_pocket'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_sns_share_pinterest'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
<?php
     // load script -----------------------------------------------------------
    if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
    ){
       show_loading_screen();
     } else {
       no_loading_screen();
     };

     // カスタムスクリプト--------------------------------------------
     if($options['footer_script_code']) {
       echo $options['footer_script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $footer_custom_script = get_post_meta($post->ID, 'footer_custom_script', true);
       if($footer_custom_script) {
         echo $footer_custom_script;
       };
     };
?>
</body>
</html>