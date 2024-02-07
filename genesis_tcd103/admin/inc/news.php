<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-genesis' );
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-genesis' );
	$dp_default_options['news_slug'] = 'news';
	$dp_default_options['news_show_image'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_news_headline'] = 'NEWS';
	$dp_default_options['archive_news_sub_title'] = __( 'Sub title', 'tcd-genesis' );
	$dp_default_options['archive_news_desc'] = __( 'Description will be displayed here.', 'tcd-genesis' );
	$dp_default_options['archive_news_desc_mobile'] = '';

  $dp_default_options['show_archive_news_recommend'] = '1';
	$dp_default_options['archive_news_recommend_post_order'] = 'rand';
	$dp_default_options['archive_news_recommend_post_num'] = '3';
	$dp_default_options['archive_news_recommend_post_num_sp'] = '3';
	$dp_default_options['archive_news_recommend_post_type'] = 'recommend_post';

	$dp_default_options['archive_news_num'] = '6';
	$dp_default_options['archive_news_num_sp'] = '6';

	// 詳細ページ
	$dp_default_options['single_news_content_width'] = 'type1';
	$dp_default_options['single_news_show_sns'] = 'top';
	$dp_default_options['single_news_show_copy'] = 'top';
	$dp_default_options['single_news_show_copy_btm'] = 'display';

	// 最新のお知らせ一覧
	$dp_default_options['recent_news_headline'] = __( 'Latest news', 'tcd-genesis' );
	$dp_default_options['recent_news_num'] = '3';
	$dp_default_options['recent_news_num_sp'] = '3';

	// 記事ページのバナー
	$dp_default_options['single_news_top_ad_code'] = '';
	$dp_default_options['single_news_bottom_ad_code'] = '';
	$dp_default_options['single_news_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $font_direction_options, $single_page_display_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-genesis' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/news_name_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-genesis'); ?></p>
     </div>
     <input type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-genesis'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Featured image', 'tcd-genesis'); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'news_show_image', $basic_display_options); ?></div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-genesis'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/news_archive_image.jpg?2.0" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-genesis'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_news_headline]" value="<?php echo esc_attr($options['archive_news_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subheadling', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_news_sub_title]" value="<?php echo esc_attr($options['archive_news_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc]"><?php echo esc_textarea(  $options['archive_news_desc'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc_mobile]"><?php echo esc_textarea(  $options['archive_news_desc_mobile'] ); ?></textarea></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-genesis'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_news_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s article', 'tcd-genesis'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/news_main_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-genesis');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-genesis');  ?><br>
      <?php _e('The content displayed in the sidebar can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-genesis');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><span class="num">1</span><?php _e('Content width', 'tcd-genesis');  ?></span>
       <div class="standard_radio_button">
        <input id="single_news_content_width_type2" type="radio" name="dp_options[single_news_content_width]" value="type2" <?php checked( $options['single_news_content_width'], 'type2' ); ?>>
        <label for="single_news_content_width_type2"><?php _e('Compact', 'tcd-genesis'); ?></label>
        <input id="single_news_content_width_type1" type="radio" name="dp_options[single_news_content_width]" value="type1" <?php checked( $options['single_news_content_width'], 'type1' ); ?>>
        <label for="single_news_content_width_type1"><?php _e('Normal', 'tcd-genesis'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Share button', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('"COPY Title&amp;URL" button', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_copy', $single_page_display_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('Recent %s', 'tcd-genesis'), $news_label); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><span class="num">4</span><?php _e('Headline', 'tcd-genesis');  ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-genesis' ); _e( 'Latest news', 'tcd-genesis' ); ?>" class="full_width" name="dp_options[recent_news_headline]" value="<?php echo esc_textarea(  $options['recent_news_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><span class="num">5</span><?php _e('Number of post to display', 'tcd-genesis'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'recent_news_num'); ?></li>
      </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content', 'tcd-genesis'); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Additional content can be placed above and below all articles. HTML can also be used, so please use it for affiliates as well.', 'tcd-genesis');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Above main content', 'tcd-genesis'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Below main content', 'tcd-genesis'); ?></div>
      <div class="tab" data-tab="tab3"><?php _e('Mobile device', 'tcd-genesis'); ?></div>
     </div>

     <?php // メインコンテンツの上部 ----------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('This content will be displayed above main content. (will not be displayed on mobile device)', 'tcd-genesis');  ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-genesis');  ?></h4>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code]"><?php echo esc_textarea( $options['single_news_top_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('This banner will be displayed after main content. (will not be displayed on mobile device)', 'tcd-genesis');  ?></p>
      </div>

      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code]"><?php echo esc_textarea( $options['single_news_bottom_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // モバイル用 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab3">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-genesis');  ?><br>
       <?php _e('This content will be display after main content and will be repleace by additional content for PC device.', 'tcd-genesis');  ?></p>
      </div>

      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_mobile_ad_code]"><?php echo esc_textarea( $options['single_news_mobile_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options;

  //基本設定
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_show_image'] = wp_filter_nohtml_kses( $input['news_show_image'] );


  // アーカイブ
  $input['archive_news_headline'] = wp_filter_nohtml_kses( $input['archive_news_headline'] );
  $input['archive_news_sub_title'] = wp_filter_nohtml_kses( $input['archive_news_sub_title'] );
  $input['archive_news_desc'] = wp_kses_post( $input['archive_news_desc'] );
  $input['archive_news_desc_mobile'] = wp_kses_post( $input['archive_news_desc_mobile'] );

  $input['show_archive_news_recommend'] = ! empty( $input['show_archive_news_recommend'] ) ? 1 : 0;
  $input['archive_news_recommend_post_type'] = wp_filter_nohtml_kses( $input['archive_news_recommend_post_type'] );
  $input['archive_news_recommend_post_order'] = wp_filter_nohtml_kses( $input['archive_news_recommend_post_order'] );
  $input['archive_news_recommend_post_num'] = wp_filter_nohtml_kses( $input['archive_news_recommend_post_num'] );
  $input['archive_news_recommend_post_num_sp'] = wp_filter_nohtml_kses( $input['archive_news_recommend_post_num_sp'] );

  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_sp'] = wp_filter_nohtml_kses( $input['archive_news_num_sp'] );


  //詳細ページ
  $input['single_news_content_width'] = wp_filter_nohtml_kses( $input['single_news_content_width'] );
  $input['single_news_show_sns'] = wp_filter_nohtml_kses( $input['single_news_show_sns'] );
  $input['single_news_show_copy'] = wp_filter_nohtml_kses( $input['single_news_show_copy'] );


  // 最新お知らせ一覧
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_num'] = wp_filter_nohtml_kses( $input['recent_news_num'] );
  $input['recent_news_num_sp'] = wp_filter_nohtml_kses( $input['recent_news_num_sp'] );


  // 記事ページのバナー広告
  $input['single_news_top_ad_code'] = $input['single_news_top_ad_code'];
  $input['single_news_bottom_ad_code'] = $input['single_news_bottom_ad_code'];
  $input['single_news_mobile_ad_code'] = $input['single_news_mobile_ad_code'];


	return $input;

};


?>