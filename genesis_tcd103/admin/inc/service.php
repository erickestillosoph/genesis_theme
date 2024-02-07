<?php
/*
 * サービスの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_service_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_service_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_service_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_service_theme_options_validate' );


// タブの名前
function add_service_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );
  $tab_labels['service'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_service_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['service_label'] = __( 'Service', 'tcd-genesis' );
	$dp_default_options['service_slug'] = 'service';

	// アーカイブページ
	$dp_default_options['archive_service_type'] = 'type1';
	$dp_default_options['archive_service_headline'] = 'SERVICE';
	$dp_default_options['archive_service_sub_title'] = __( 'Sub title', 'tcd-genesis' );
	$dp_default_options['archive_service_catch'] = __( 'Catchphrase', 'tcd-genesis' );
	$dp_default_options['archive_service_desc'] = __( 'Description will be displayed here.', 'tcd-genesis' );
	$dp_default_options['archive_service_desc_mobile'] = '';
	$dp_default_options['archive_service_header_image'] = false;

	// 詳細ページ
	$dp_default_options['single_service_content_width'] = 'type1';
	$dp_default_options['single_service_overlay_color'] = '#000000';
	$dp_default_options['single_service_overlay_opacity'] = '0.3';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options, $service_category_type_options;
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );
  $service_slug = $options['service_slug'] ? esc_html( $options['service_slug'] ) : 'service';

?>

<div id="tab-content-service" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_name_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-genesis');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will be used in administration screen and the text link to the archive page.', 'tcd-genesis'); ?></p>
     </div>
     <input type="text" name="dp_options[service_label]" value="<?php echo esc_attr( $options['service_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-genesis');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-genesis'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[service_slug]" value="<?php echo sanitize_title( $options['service_slug'] ); ?>" /></p>

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
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_archive_image.jpg?2.0" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-genesis'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_service_headline]" value="<?php echo esc_attr($options['archive_service_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subheadling', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="dp_options[archive_service_sub_title]" value="<?php echo esc_attr($options['archive_service_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Catchphrase', 'tcd-genesis'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[archive_service_catch]"><?php echo esc_textarea(  $options['archive_service_catch'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[archive_service_desc]"><?php echo esc_textarea(  $options['archive_service_desc'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_service_desc_mobile]"><?php echo esc_textarea(  $options['archive_service_desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">5</span>
        <?php _e('Image', 'tcd-genesis'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '1450', '600'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_service_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_service_header_image'] ); ?>" id="archive_service_header_image" name="dp_options[archive_service_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_service_header_image']){ echo wp_get_attachment_image($options['archive_service_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_service_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display format', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('You can select the display format of the archive page. Type2 is recommended if you have a large number of %s articles.<br><br>Type1: A link to the category page will be displayed for each category section.<br>Type2: All %s article link will be displayed for each category section.', 'tcd-genesis'), $service_label,$service_label,$service_label); ?></p>
     </div>
     <?php echo tcd_admin_image_radio_button($options, 'archive_service_type', $service_category_type_options) ?>

     <div class="theme_option_message2" style="margin-top:10px;">
      <p><?php printf(__('The setting of %s category will change depending on the selected display format.<br><a href="./edit-tags.php?taxonomy=%s_category&post_type=%s" target="_blank">%s category setting page</a>', 'tcd-genesis'), $service_label,$service_slug,$service_slug,$service_label); ?></p>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s article', 'tcd-genesis'), $service_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_main_image.jpg?3.0" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-genesis'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Logo', 'tcd-genesis'); ?></span><span><?php _e('"Logo image (subpage)" set from Basic Settings > Logo will be affected in this page.', 'tcd-genesis'); ?></span></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Color of overlay', 'tcd-genesis'); ?></span><input type="text" name="dp_options[single_service_overlay_color]" value="<?php echo esc_attr( $options['single_service_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
       <div class="theme_option_message2" style="clear:both; margin:40px 0 0 0;">
        <p><?php printf(__('Overlay color will be applied to all %s article page.', 'tcd-genesis'), $service_label); ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Transparency of overlay', 'tcd-genesis'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" name="dp_options[single_service_overlay_opacity]" value="<?php echo esc_attr( $options['single_service_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-genesis');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-genesis');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-genesis');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><span class="num">3</span><?php _e('Content width', 'tcd-genesis');  ?></span>
       <div class="standard_radio_button">
        <input id="single_service_content_width_type2" type="radio" name="dp_options[single_service_content_width]" value="type2" <?php checked( $options['single_service_content_width'], 'type2' ); ?>>
        <label for="single_service_content_width_type2"><?php _e('Compact', 'tcd-genesis'); ?></label>
        <input id="single_service_content_width_type1" type="radio" name="dp_options[single_service_content_width]" value="type1" <?php checked( $options['single_service_content_width'], 'type1' ); ?>>
        <label for="single_service_content_width_type1"><?php _e('Normal', 'tcd-genesis'); ?></label>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_service_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_theme_options_validate( $input ) {

  global $dp_default_options;

  //基本設定
  $input['service_slug'] = sanitize_title( $input['service_slug'] );
  $input['service_label'] = wp_filter_nohtml_kses( $input['service_label'] );


  // アーカイブ
  $input['archive_service_type'] = wp_filter_nohtml_kses( $input['archive_service_type'] );
  $input['archive_service_headline'] = wp_filter_nohtml_kses( $input['archive_service_headline'] );
  $input['archive_service_sub_title'] = wp_filter_nohtml_kses( $input['archive_service_sub_title'] );
  $input['archive_service_catch'] = wp_kses_post( $input['archive_service_catch'] );
  $input['archive_service_desc'] = wp_kses_post( $input['archive_service_desc'] );
  $input['archive_service_desc_mobile'] = wp_kses_post( $input['archive_service_desc_mobile'] );


  // 詳細ページ
  $input['single_service_content_width'] = wp_filter_nohtml_kses( $input['single_service_content_width'] );
  $input['single_service_overlay_color'] = wp_filter_nohtml_kses( $input['single_service_overlay_color'] );
  $input['single_service_overlay_opacity'] = wp_filter_nohtml_kses( $input['single_service_overlay_opacity'] );


	return $input;

};


?>