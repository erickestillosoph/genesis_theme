<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
  global $blog_label;
  $options = get_design_plus_option();
  $tab_label = $blog_label;
	$tab_labels['blog'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_show_date'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_blog_headline'] = 'BLOG';
	$dp_default_options['archive_blog_sub_title'] = __( 'Sub title', 'tcd-genesis' );
	$dp_default_options['archive_blog_desc'] = __( 'Description will be displayed here.', 'tcd-genesis' );
	$dp_default_options['archive_blog_desc_mobile'] = '';

	// 詳細ページ
	$dp_default_options['single_blog_content_width'] = 'type1';
	$dp_default_options['single_blog_show_sns'] = 'top';
	$dp_default_options['single_blog_show_copy'] = 'top';
	$dp_default_options['single_blog_show_tag_list'] = 'display';

	// 関連記事
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-genesis' );
	$dp_default_options['related_post_num'] = '6';
	$dp_default_options['related_post_num_sp'] = '3';

	// 記事ページのバナー
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $font_type_options, $post_list_animation_type_options, $basic_display_options, $font_direction_options, $single_page_display_options;

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php
          $blog_page_id = get_option( 'page_for_posts' );
          if($blog_page_id) {
     ?>

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/blog_name_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Title that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to blog content name and breadcrumb link name.', 'tcd-genesis'), $blog_page_id); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Permalinks that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to blog page URL.', 'tcd-genesis'), $blog_page_id); ?></p>
     </div>

     <?php } else { ?>

     <div class="theme_option_message2">
      <p><?php _e('After creating the blog page by <a href="./edit.php?post_type=page" target="_blank">WP-page</a>, please register the page as a blog from the <a href="./options-reading.php" target="_blank">display settings page</a>.', 'tcd-genesis'); ?></p>
     </div>

     <?php }; ?>

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-genesis');  ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'blog_show_date', $basic_display_options); ?></div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog archive page', 'tcd-genesis'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/blog_archive_image.jpg?2.0" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('Settings for the post archive page.', 'tcd-genesis'); ?></p>
      <?php
           if($blog_page_id) {
             $blog_page_url = get_page_link( $blog_page_id );
             if($blog_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-genesis'); ?><a class="e_link" href="<?php echo esc_url($blog_page_url) ?>"><?php echo esc_url($blog_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-genesis'); ?>
         <?php _e('Please refer to the <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank">manual</a> to create and configure.', 'tcd-genesis'); ?></p>
      <?php } ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-genesis'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_blog_headline]" value="<?php echo esc_attr($options['archive_blog_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subheadling', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_blog_sub_title]" value="<?php echo esc_attr($options['archive_blog_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc]"><?php echo esc_textarea(  $options['archive_blog_desc'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc_mobile]"><?php echo esc_textarea(  $options['archive_blog_desc_mobile'] ); ?></textarea></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog article', 'tcd-genesis'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/blog_main_image.jpg" alt="" title="" />
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
        <input id="single_blog_content_width_type2" type="radio" name="dp_options[single_blog_content_width]" value="type2" <?php checked( $options['single_blog_content_width'], 'type2' ); ?>>
        <label for="single_blog_content_width_type2"><?php _e('Compact', 'tcd-genesis'); ?></label>
        <input id="single_blog_content_width_type1" type="radio" name="dp_options[single_blog_content_width]" value="type1" <?php checked( $options['single_blog_content_width'], 'type1' ); ?>>
        <label for="single_blog_content_width_type1"><?php _e('Normal', 'tcd-genesis'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Share button', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('"COPY Title&amp;URL" button', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_copy', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Tag cloud', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_tag_list', $basic_display_options); ?></li>
     </ul>

     <?php // 関連記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Related post', 'tcd-genesis');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">5</span><?php _e('Headline', 'tcd-genesis');  ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-genesis' ); _e( 'Related post', 'tcd-genesis' ); ?>" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
      <li class="cf"><span class="label"><span class="num">6</span><?php _e('Number of post to display', 'tcd-genesis');  ?></span><?php echo tcd_display_post_num_option_type2($options, 'related_post_num'); ?></li>
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
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('This banner will be displayed after main content. (will not be displayed on mobile device)', 'tcd-genesis');  ?></p>
      </div>

      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // モバイル用 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab3">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-genesis');  ?><br>
       <?php _e('This content will be display after main content and will be repleace by additional content for PC device.', 'tcd-genesis');  ?></p>
      </div>

      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_mobile_ad_code]"><?php echo esc_textarea( $options['single_mobile_ad_code'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;

  // 基本設定
  $input['blog_show_date'] = wp_filter_nohtml_kses( $input['blog_show_date'] );


  // アーカイブ
  $input['archive_blog_headline'] = wp_filter_nohtml_kses( $input['archive_blog_headline'] );
  $input['archive_blog_sub_title'] = wp_filter_nohtml_kses( $input['archive_blog_sub_title'] );
  $input['archive_blog_desc'] = wp_kses_post( $input['archive_blog_desc'] );
  $input['archive_blog_desc_mobile'] = wp_kses_post( $input['archive_blog_desc_mobile'] );


  // 記事ページ
  $input['single_blog_content_width'] = wp_filter_nohtml_kses( $input['single_blog_content_width'] );
  $input['single_blog_show_sns'] = wp_filter_nohtml_kses( $input['single_blog_show_sns'] );
  $input['single_blog_show_copy'] = wp_filter_nohtml_kses( $input['single_blog_show_copy'] );
  $input['single_blog_show_tag_list'] = wp_filter_nohtml_kses( $input['single_blog_show_tag_list'] );


  // 関連記事
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_sp'] = wp_filter_nohtml_kses( $input['related_post_num_sp'] );


  // 記事ページのバナー広告
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_mobile_ad_code'] = $input['single_mobile_ad_code'];


	return $input;

};


?>