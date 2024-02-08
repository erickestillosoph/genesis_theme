<?php
     function tcd_head() {
       $options = get_design_plus_option();
       global $post;

       /* URLやモバイル等でcssが変わらないものをここで出力 */
?>
<style type="text/css">
<?php
     // フォントの設定　------------------------------------------------------------------
     $content_font_size = $options['content_font_size'] ?  $options['content_font_size'] : '16';
     $content_font_size_sp = $options['content_font_size_sp'] ?  $options['content_font_size_sp'] : '14';
     $single_title_font_size = $options['single_title_font_size'] ?  $options['single_title_font_size'] : '32';
     $single_title_font_size_sp = $options['single_title_font_size_sp'] ?  $options['single_title_font_size_sp'] : '20';
     $headline_font_size = $options['headline_font_size'] ?  $options['headline_font_size'] : '70';
     $headline_font_size_sp = $options['headline_font_size_sp'] ?  $options['headline_font_size_sp'] : '30';
     $catch_font_size = $options['catch_font_size'] ?  $options['catch_font_size'] : '32';
     $catch_font_size_sp = $options['catch_font_size_sp'] ?  $options['catch_font_size_sp'] : '20';
?>
:root {
  --vw: 1vw;
  --single_post_title_font_size: <?php echo esc_html($single_title_font_size); ?>px;
  --single_post_title_font_size_tb: <?php echo esc_html(floor( ($single_title_font_size + $single_title_font_size_sp) / 1.8 )); ?>px;
  --single_post_title_font_size_sp: <?php echo esc_html($single_title_font_size_sp); ?>px;
  --font_family_type1: Anton, sans-serif ;
  /* --font_family_type1: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; */
  /* --font_family_type2: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; */
  --font_family_type2: Noto Sans, sans-serif ;
  --font_family_type3: Anton, sans-serif ;
  /* --font_family_type3: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; */
}
body { font-size:<?php echo esc_html($content_font_size); ?>px; }
.large_headline { font-size:<?php echo esc_html($headline_font_size); ?>px !important; }
.rich_font { font-size:<?php echo esc_html($catch_font_size); ?>px !important; }
@media screen and (max-width:1100px) {
  .large_headline { font-size:<?php echo esc_html(floor( ($headline_font_size + $headline_font_size_sp) / 1.8 ) ); ?>px !important; }
  .rich_font { font-size:<?php echo esc_html(floor( ($catch_font_size + $catch_font_size_sp) / 1.8 ) ); ?>px !important; }
}
@media screen and (max-width:800px) {
  body { font-size:<?php echo esc_html($content_font_size_sp); ?>px; }
  .large_headline { font-size:<?php echo esc_html($headline_font_size_sp); ?>px !important; }
  .rich_font { font-size:<?php echo esc_html($catch_font_size_sp); ?>px !important; }
}
<?php
     // 基本のフォントタイプ
     if($options['content_font_type'] == 'type1') {
?>
body, input, textarea { font-family:var(--font_family_type1); }
<?php } elseif($options['content_font_type'] == 'type2') { ?>
body, input, textarea { font-weight:500; font-family:var(--font_family_type2); }
<?php } else { ?>
body, input, textarea { font-family:var(--font_family_type3); }
<?php }; ?>

<?php
     // キャッチフレーズのフォントタイプ
     if($options['catch_font_type'] == 'type1') {
?>
.rich_font, .p-vertical { font-family:var(--font_family_type1); font-weight:600; }
<?php } elseif($options['catch_font_type'] == 'type2') { ?>
.rich_font, .p-vertical { font-family:var(--font_family_type2); font-weight:600; }
<?php } else { ?>
.rich_font, .p-vertical { font-family:var(--font_family_type3); font-weight:600; }
<?php }; ?>

<?php
     // ヘッダーの見出しのフォントタイプ
     if($options['headline_font_type'] == 'type1') {
?>
.large_headline { font-family:var(--font_family_type1); font-weight:600; }
<?php } elseif($options['headline_font_type'] == 'type2') { ?>
.large_headline { font-family:var(--font_family_type2); font-weight:600; }
<?php } else { ?>
.large_headline { font-family:var(--font_family_type3); font-weight:600; }
<?php }; ?>

<?php
     // 詳細ページの記事タイトルのフォントタイプ
     if(is_single() && $options['single_title_font_type'] == 'type1' || is_page() && $options['single_title_font_type'] == 'type1') {
?>
#single_post_header .title{ font-family:var(--font_family_type1); font-weight:600; }
<?php } elseif(is_single() && $options['single_title_font_type'] == 'type2' || is_page() && $options['single_title_font_type'] == 'type2') { ?>
#single_post_header .title { font-family:var(--font_family_type2); font-weight:600; }
<?php } elseif(is_single() && $options['single_title_font_type'] == 'type3' || is_page() && $options['single_title_font_type'] == 'type3') { ?>
#single_post_header .title { font-family:var(--font_family_type3); font-weight:600; }
<?php }; ?>

.rich_font_type1 { font-family:var(--font_family_type1); font-weight:400; }
.rich_font_type2 { font-family:var(--font_family_type2); font-weight:600; }
.rich_font_type3 { font-family:var(--font_family_type3); font-weight:600; }


<?php
     // ヘッダー -------------------------------------------------------------------------------

     // ロゴ
     $header_logo_font_size = $options['header_logo_font_size'] ?  $options['header_logo_font_size'] : '26';
     $header_logo_font_size_sp = $options['header_logo_font_size_sp'] ?  $options['header_logo_font_size_sp'] : '20';
?>
.logo_text { font-size:<?php echo esc_html($header_logo_font_size); ?>px; }
@media screen and (max-width:1201px) {
  .logo_text { font-size:<?php echo esc_html($header_logo_font_size_sp); ?>px; }
}
<?php
     // メッセージ -----------------------------------------------------------------------------------
     if(!is_404()){
       if( (is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
?>
#header_message { background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#header_message a { color:<?php echo esc_attr($options['header_message_font_color']); ?> !important; }
<?php
       };
     };

      // フッター -------------------------------------------------------------------------------
      $footer_banner_title_font_size = $options['footer_banner_title_font_size'] ?  $options['footer_banner_title_font_size'] : '50';
      $footer_banner_title_font_size_sp = $options['footer_banner_title_font_size_sp'] ?  $options['footer_banner_title_font_size_sp'] : '30';
?>
#footer_banner .title { font-size:<?php echo esc_html($footer_banner_title_font_size); ?>px !important; }
@media screen and (max-width:1100px) {
  #footer_banner .title { font-size:<?php echo esc_html(floor( ($footer_banner_title_font_size + $footer_banner_title_font_size_sp) / 1.8 )); ?>px !important; }
}
@media screen and (max-width:800px) {
  #footer_banner .title { font-size:<?php echo esc_html($footer_banner_title_font_size_sp); ?>px !important; }
}
<?php
     // サムネイルのホバーアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type5"){

       // ズームイン ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
@media(hover: hover) {
  .animate_background .image_wrap img { width:100%; height:100%; will-change:transform; transition: transform  0.5s ease; }
  .animate_background:hover .image_wrap img { transform: scale(<?php echo $options['hover1_zoom']; ?>); }
}
<?php
     // ズームアウト ------------------------------------------------------------------------------
     } if($options['hover_type']=="type2"){
?>
@media(hover: hover) {
  .animate_background .image_wrap img { width:100%; height:100%; will-change:transform; transition: transform  0.5s ease; transform: scale(<?php echo $options['hover2_zoom']; ?>); }
  .animate_background:hover .image_wrap img { transform: scale(1); }
}
<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
       $hover3_bgcolor_hex = hex2rgb($options['hover3_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
@media(hover: hover) {
  .animate_background .image_wrap:before {
    content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; pointer-events:none;
    opacity:0; background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover3_opacity']); ?>); transition: opacity 0.3s ease;
  }
  .animate_background:hover .image_wrap:before { opacity:1; }
  .animate_background .image_wrap img {
    width:calc(100% + 30px) !important; height:100%; max-width:inherit !important;
    <?php if($options['hover3_direct']=='type1'): ?>
    transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
    <?php else: ?>
    transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
    <?php endif; ?>
  }
  .animate_background:hover .image_wrap img {
    <?php if($options['hover3_direct']=='type1'): ?>
    transform: translate(0px, 0px);
    <?php else: ?>
    transform: translate(-30px, 0px);
    <?php endif; ?>
  }
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type4"){
       $hover3_bgcolor_hex = hex2rgb($options['hover4_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
@media(hover: hover) {
  .animate_background .image_wrap:before {
    content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; pointer-events:none;
    opacity:0; background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover4_opacity']); ?>); transition: opacity 0.3s ease;
  }
  .animate_background:hover .image_wrap:before { opacity:1; }
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
?>
a { color:#000; }

<?php
     // メインカラー ----------------------------------
     $main_color = $options['main_color'];
     $main_color_hex = hex2rgb($main_color);
     $main_color_hex = implode(",",$main_color_hex);
     $hover_color = adjustBrightness($main_color, -30);
?>
a:hover, .category_button, .sub_title.colored, #global_menu > ul > li > a:hover, .faq_list .headline, #bread_crumb, #bread_crumb li.last, .faq_list .title.active, .widget_categories li a:hover, .widget_archive li a:hover, .widget_pages li a:hover, .widget_nav_menu li a:hover, .design_button,
  .service_category_content .post_list .title, .service_header .archive_link .label, .megamenu_b .arrow:after, .megamenu_b .sub_title.arrow, .news_category_button a:hover, #footer_banner a:hover .arrow_button:before, #footer_banner a:hover .arrow_button:after, .service_category_post_list .title, #post_pagination a:hover, .page_navi a:hover,
    #return_top a:hover .arrow:before, #return_top a:hover .arrow:after, #service_link_list .link_label, body.megamenu_dark_color .megamenu_a a:hover, .arrow_link_button a, .megamenu_b .arrow_link, .megamenu_b .post_list .arrow_link .arrow_button_small, #header_slider_wrap.layout_type3 .desc_area a:hover, #company_data_list h4, .lp3_bottom_content .item_list a,
      #service_link_list .post_list.type1 .catch, #service_link_list .post_list.type2 .catch
      { color:<?php echo esc_html($main_color); ?>; }

.cardlink .title a, #global_menu > ul > li.active > a, #global_menu > ul > li.current-menu-item > a, .design_arrow_button a, .swiper-nav-button:hover .arrow_button_small:before, .swiper-nav-button:hover .arrow_button_small:after
  { color:<?php echo esc_html($main_color); ?> !important; }

.page_navi span.current, #global_menu ul ul a:hover, .arrow_button, #submit_comment, #post_pagination p, #comment_tab li.active a, .widget_tab_post_list_button div.active, .widget_categories a:before, .q_styled_ol li:before, #copyright, .tcdw_tag_list_widget ol a:hover, .widget_tag_cloud .tagcloud a:hover, #wp-calendar tbody a:hover,
  #post_tag_list a:hover,  #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover, .news_category_button li.current a, .swiper-scrollbar-drag, .cb_service_category_list .post_list a:after, .shutter_image.link_ver .post_list a:after, .design_button:hover, #mobile_menu li li a
    { background-color:<?php echo esc_html($main_color); ?>; }

.category_button, .page_navi span.current, #post_pagination p, #comment_textarea textarea:focus, #guest_info input:focus, .c-pw__box-input:focus, .news_category_button li.current a, .news_category_button a:hover, #post_pagination a:hover, .page_navi a:hover, .design_button
  { border-color:<?php echo esc_html($main_color); ?>; }

.category_button:hover, .single_post_nav:hover span:after, .faq_list .title:hover, #single_author_title_area .author_link li a:hover:before, .author_profile a:hover, #post_meta_bottom a:hover, .cardlink_title a:hover, .comment a:hover,
  .comment_form_wrapper a:hover, .megamenu_b .sub_title.arrow:hover, .megamenu_b .arrow_link:hover, body.megamenu_dark_color .megamenu_b a:hover
    { color:<?php echo esc_html($hover_color); ?>; }

.design_arrow_button a:hover { color:<?php echo esc_html($hover_color); ?> !important; }

.c-pw__btn:hover, #comment_tab li a:hover, #submit_comment:hover, #cancel_comment_reply a:hover, #comment_tab li a:hover, .cb_service_category_list .post_list a:hover:after, .shutter_image.link_ver .post_list a:hover:after
  { background-color:<?php echo esc_html($hover_color); ?>; }

.category_button:hover, .tcdw_tag_list_widget ol a:hover, .widget_tag_cloud .tagcloud a:hover
  { border-color:<?php echo esc_html($hover_color); ?>; }


<?php
     // 詳細ページのテキストカラー ----------------------------------
     $content_link_color = $options['content_link_color'];
     $content_link_color_hex = hex2rgb($content_link_color);
     $content_link_color_hex = implode(",",$content_link_color_hex);
?>
.post_content a, .widget_block a, .textwidget a, #no_post a, #page_404_header .desc a, #no_search_result a { color:<?php echo esc_html($content_link_color); ?>; }
#page_404_header .desc a:hover { color:<?php echo esc_html($content_link_color); ?>; }
.widget_block a:hover, .textwidget a:hover, #no_post a:hover { color:rgba(<?php echo esc_html($content_link_color_hex); ?>,0.6); }
.post_content a:hover { color:<?php echo esc_html($content_link_color); ?>; }
<?php
     // クイックタグ --------------------------------------------
    if ( $options['use_quicktags'] ) :

    
    for ( $i = 2; $i <= 5; $i++ ){

    // 見出し
    $heading_font_size = $options['qt_h'.$i.'_font_size'];
    $heading_font_size_sp = $options['qt_h'.$i.'_font_size_sp'];
    $heading_text_align = $options['qt_h'.$i.'_text_align'];
    $heading_font_weight = $options['qt_h'.$i.'_font_weight'];
    if($heading_font_weight == '400'){
      $heading_font_weight = '500';
    }
    $heading_font_color = $options['qt_h'.$i.'_font_color'];
    $heading_bg_color = $options['qt_h'.$i.'_bg_color'];
    $heading_ignore_bg = $options['qt_h'.$i.'_ignore_bg'];
    $heading_border = 'qt_h'.$i.'_border_';
    $heading_border_color = $options['qt_h'.$i.'_border_color'];
    $heading_border_width = $options['qt_h'.$i.'_border_width'];
    $heading_border_style = $options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
@media screen and (max-width:800px) {
  .styled_h<?php echo $i ?> { font-size:<?php echo esc_attr($heading_font_size_sp); ?>px!important; }
}
<?php

    }

    // ボタン
    for ( $i = 1; $i <= 3; $i++ ) {
      $button_type = $options['qt_button'.$i.'_type'];
      $button_shape = $options['qt_button'.$i.'_border_radius'];
      $button_size = $options['qt_button'.$i.'_size'];
      $button_animation_type = $options['qt_button'.$i.'_animation_type'];
      $button_font_color = $options['qt_button'.$i.'_color'];
      $button_font_color_hover = $options['qt_button'.$i.'_color_hover'];
      $button_bg_color = $options['qt_button'.$i.'_color2'];
      $button_bg_color_hover = $options['qt_button'.$i.'_color2_hover'];

      $colors = array();
      $animations = array();

      switch ($button_shape){
        case 'flat': $shape = 'border-radius:0px;'; break;
        case 'rounded': $shape = 'border-radius:6px;'; break;
        case 'oval': $shape = 'border-radius:70px;'; break;
      }
      switch ($button_size){
        case 'small':
         $size = 'width:130px; height:40px; line-height:40px;';
         $sp_size1 = 'width:130px;';
         $sp_size2 = 'width:130px;';
         break;
        case 'medium':
          $size = 'width:280px; height:60px; line-height:60px;';
          $sp_size1 = 'width:260px;';
          $sp_size2 = 'width:240px; height:50px; line-height:50px;';
          break;
        case 'large':
          $size = 'width:330px; height:70px; line-height:70px;';
          $sp_size1 = 'width:330px;';
          $sp_size2 = 'width:240px;';
          break;
      }
      switch ($button_type){
        case 'type1': $colors = array(
          'color:' . $button_font_color . '; background-color:' . $button_bg_color . '; border:none;',
          'color:'. $button_font_color_hover .'; background-color:' . $button_bg_color_hover . ';',
          ''
        ); break;
        case 'type2': $colors = array(
          'color:' . $button_font_color . '; border-color:' . $button_bg_color . ';',
          'background-color:' . $button_bg_color_hover . ';',
          'color:' . $button_font_color_hover . '; border-color:' . $button_bg_color_hover . ';'
        ); break;
        case 'type3': $colors = array(
          'color:' . $button_font_color . '; border-color:' . $button_bg_color . ';',
          'background-color:' . $button_bg_color . ';',
          'color:' . $button_font_color_hover . '; border-color:' . $button_bg_color_hover . ';'
        ); break;
      }
      switch ($button_animation_type){
        case 'animation_type1': $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;'); break;
        case 'animation_type2': $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;'); break;
        case 'animation_type3': $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);'); break;
      }

?>
.post_content a.q_custom_button<?php echo $i; ?> { <?php echo $size.$shape.$colors[0]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:before { <?php echo $colors[1].$animations[0]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:hover { <?php echo $colors[2]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:hover:before { <?php echo $animations[1]; ?> }
@media (max-width: 1200px) {
  .post_content a.q_custom_button<?php echo $i; ?> { <?php echo $sp_size1; ?> }
}
@media (max-width: 800px) {
  .post_content a.q_custom_button<?php echo $i; ?> { <?php echo $sp_size2; ?> }
}
<?php

    };

    // 囲み枠
    for ( $i = 1; $i <= 3; $i++ ) {

      $label_color = $options['qt_frame'.$i.'_label_color'];
      $bg_color = $options['qt_frame'.$i.'_content_bg_color'];
      $border_radius = $options['qt_frame'.$i.'_content_shape'];
      $border_width = $options['qt_frame'.$i.'_content_border_width'];
      $border_color = $options['qt_frame'.$i.'_content_border_color'];
      $border_style = $options['qt_frame'.$i.'_content_border_style'];


?>
.q_frame<?php echo $i; ?> {
  background:<?php echo esc_attr($bg_color); ?>;
  border-radius:<?php echo esc_attr($border_radius); ?>px;
  border-width:<?php echo esc_attr($border_width); ?>px;
  border-color:<?php echo esc_attr($border_color); ?>;
  border-style:<?php echo esc_attr($border_style); ?>;
}
.q_frame<?php echo $i; ?> .q_frame_label {
  color:<?php echo esc_attr($label_color); ?>;
}
<?php

    }

    // アンダーライン
    for ( $i = 1; $i <= 3; $i++ ) {

      $underline_color = $options['qt_underline'.$i.'_border_color'];
      $underline_font_weight = $options['qt_underline'.$i.'_font_weight'];
      if($underline_font_weight == '400'){
        $underline_font_weight = '500';
      }
      $underline_use_animation = $options['qt_underline'.$i.'_use_animation'];

?>
.q_underline<?php echo $i; ?> {
  font-weight:<?php echo esc_attr($underline_font_weight); ?>;
  background-image: -webkit-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: -moz-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: linear-gradient(to right, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  <?php if($underline_use_animation == 'no') echo 'background-position:-100% 0.8em;'; ?>
}
<?php

    }

    // 吹き出し
    for ( $i = 1; $i <= 4; $i++ ) {

      $sb_font_color = $options['qt_speech_balloon'.$i.'_font_color'];
      $sb_bg_color = $options['qt_speech_balloon'.$i.'_bg_color'];
      $sb_border_color = $options['qt_speech_balloon'.$i.'_border_color'];
      $sb_direction = ($i >= 3) ? 'left' : 'right';

?>
.speech_balloon<?php echo $i; ?> .speech_balloon_text_inner {
  color:<?php echo esc_attr($sb_font_color); ?>;
  background-color:<?php echo esc_attr($sb_bg_color); ?>;
  border-color:<?php echo esc_attr($sb_border_color); ?>;
}
.speech_balloon<?php echo $i; ?> .before { border-left-color:<?php echo esc_attr($sb_border_color); ?>; }
.speech_balloon<?php echo $i; ?> .after { border-right-color:<?php echo esc_attr($sb_bg_color); ?>; }
<?php

    }

    endif;

    // Google map
    $qt_gmap_marker_bg = $options['qt_gmap_marker_bg'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }
<?php
  // tcd_head_css action
  do_action( 'tcd_head_css' );
?>
</style>

<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
     // トップページ -----------------------------------------------------------------------------
     if(is_front_page()){
       $index_slider_catch_font_size = $options['index_slider_catch_font_size'] ?  $options['index_slider_catch_font_size'] : '76';
       $index_slider_catch_font_size_sp = $options['index_slider_catch_font_size_sp'] ?  $options['index_slider_catch_font_size_sp'] : '30';
       $index_slider_desc_font_size = $options['index_slider_desc_font_size'] ?  $options['index_slider_desc_font_size'] : '20';
       $index_slider_desc_font_size_sp = $options['index_slider_desc_font_size_sp'] ?  $options['index_slider_desc_font_size_sp'] : '16';
?>
#header_slider_content .catch { font-size:<?php echo esc_attr($index_slider_catch_font_size); ?>px; }
#header_slider_content .desc { font-size:<?php echo esc_attr($index_slider_desc_font_size); ?>px; }
@media screen and (max-width:1100px) {
  #header_slider_content .catch { font-size:<?php echo esc_html(floor( ($index_slider_catch_font_size + $index_slider_catch_font_size_sp) / 2 ) ); ?>px; }
  #header_slider_content .desc { font-size:<?php echo esc_html(floor( ($index_slider_desc_font_size + $index_slider_desc_font_size_sp) / 2 ) ); ?>px; }
}
@media screen and (max-width:800px) {
  #header_slider_content .catch { font-size:<?php echo esc_attr($index_slider_catch_font_size_sp); ?>px; }
  #header_slider_content .desc { font-size:<?php echo esc_attr($index_slider_desc_font_size_sp); ?>px; }
}
<?php
       // コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       if ( $options['contents_builder'] ) {

         $contents_builder = $options['contents_builder'];
         if ($contents_builder) :
           $content_count = 1;
           foreach($contents_builder as $content) :

           // サービス ---------------------------------------------------------
           if ( $content['cb_content_select'] == 'service_list' && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '50';
             $headline_font_size_sp = $content['headline_font_size_sp'] ?  $content['headline_font_size_sp'] : '30';
?>
.cb_service_list.num<?php echo $content_count; ?> .item .headline { font-size:<?php echo esc_html($headline_font_size); ?>px; }
@media (max-width: 1200px) {
  .cb_service_list.num<?php echo $content_count; ?> .item .headline { font-size:<?php echo esc_html($headline_font_size_sp); ?>px; }
}
<?php
           };

           $content_count++;
           endforeach;
         endif;
       };// END コンテンツビルダーここまで

     // お知らせアーカイブ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('news')) {

     // お知らせ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_singular('news')) {

     // ブログアーカイブ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search()) {

     // ブログ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_single()){

     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page()) {

       $overlay_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
       if($overlay_opacity == 'zero'){
         $overlay_opacity = '0';
       }
       if($overlay_opacity != '0'){
         $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
         $overlay_color = hex2rgb($overlay_color);
         $overlay_color = implode(",",$overlay_color);
?>
#page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       };

       if(is_page_template('page-tcd-lp.php')) {

         $overlay_opacity = get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) : '0.3';
         if($overlay_opacity == 'zero'){
           $overlay_opacity = '0';
         }
         if($overlay_opacity != '0'){
           $overlay_color = get_post_meta($post->ID, 'lp_header_overlay_color', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color', true) : '#000000';
           $overlay_color = hex2rgb($overlay_color);
           $overlay_color = implode(",",$overlay_color);
?>
#lp_page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
         };
         $catch_font_size = get_post_meta($post->ID, 'lp_catch_font_size', true) ?  get_post_meta($post->ID, 'lp_catch_font_size', true) : '42';
         $catch_font_size_sp = get_post_meta($post->ID, 'lp_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'lp_catch_font_size_sp', true) : '20';
?>
#lp_page_header .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px !important; }
@media screen and (max-width:1100px) {
  #lp_page_header .catch { font-size:<?php echo esc_html(floor( ($catch_font_size + $catch_font_size_sp) / 2 ) ); ?>px !important; }
}
@media screen and (max-width:800px) {
  #lp_page_header .catch { font-size:<?php echo esc_attr($catch_font_size_sp); ?>px !important; }
}
<?php
       };

     }; //END page setting

     // ロード画面 -----------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       get_template_part('functions/loader_css');
     };

     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo $options['css_code'];
     };
     if(is_single() || is_page()) {
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

  // tcd_head_css_current_page action
  do_action( 'tcd_head_css_current_page' );
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■


     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");
?>