<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-genesis' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

	// バナー
  $dp_default_options['show_footer_banner'] = '1';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['footer_banner_title'.$i] = __( 'Title', 'tcd-genesis' );
		$dp_default_options['footer_banner_sub_title'.$i] = '';
		$dp_default_options['footer_banner_url'.$i] = '#';
		$dp_default_options['footer_banner_target'.$i] = '';
		$dp_default_options['footer_banner_image'.$i] = false;
	}
	$dp_default_options['footer_banner_title_font_size'] = '50';
	$dp_default_options['footer_banner_title_font_size_sp'] = '30';

	// 住所
  $dp_default_options['footer_address'] = __( 'Footer information will be display here', 'tcd-genesis' );

  // コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; ' . date('Y');

	// フッターバー
  $dp_default_options['footer_bar_type'] = 'type1';

  // アイコン付きメニュー
	$dp_default_options['footer_bar_btns'] = array();


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_button_options, $footer_bar_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options, $bool_options;

?>

<div id="tab-content-footer" class="tab-content">

   <?php // バナーの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer banner', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/footer_banner_image.jpg" alt="" title="" />
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_banner]" type="checkbox" value="1" <?php checked( $options['show_footer_banner'], 1 ); ?>><?php _e( 'Display footer banner', 'tcd-genesis' ); ?></label></p>

     <div style="<?php if($options['show_footer_banner'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <div class="theme_option_message2">
      <p><?php _e('Banner will not be displayed if image is not registered.', 'tcd-genesis'); ?></p>
     </div>

     <?php // ボックスの設定 ----------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Banner', 'tcd-genesis');  ?></h4>
     <div class="sub_box_tab">
      <?php for($i = 1; $i <= 3; $i++) : ?>
      <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><?php printf(__('Banner%s', 'tcd-genesis'), $i); ?></div>
      <?php endfor; ?>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

      <ul class="option_list">
       <li class="cf"><span class="label"><span class="num">1</span><?php _e('Title', 'tcd-genesis'); ?></span><input class="tab_label full_width" type="text" name="dp_options[footer_banner_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_banner_title'.$i] ); ?>" /></li>
       <li class="cf"><span class="label"><span class="num">2</span><?php _e('Sub title', 'tcd-genesis'); ?></span><input class="full_width" type="text" name="dp_options[footer_banner_sub_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_banner_sub_title'.$i] ); ?>" /></li>
       <li class="cf">
        <span class="label"><span class="num">3</span><?php _e('URL', 'tcd-genesis'); ?></span>
        <div class="admin_link_option">
         <input type="text" name="dp_options[footer_banner_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['footer_banner_url'.$i] ); ?>">
         <input id="footer_banner_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[footer_banner_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_banner_target'.$i], 1 ); ?>>
         <label for="footer_banner_target<?php echo $i; ?>">&#xe920;</label>
        </div>
       </li>
       <li class="cf">
        <span class="label">
         <span class="num">4</span>
         <?php _e('Image', 'tcd-genesis'); ?>
         <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '725', '250'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_banner_image<?php echo $i; ?>">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_banner_image'.$i] ); ?>" id="footer_banner_image<?php echo $i; ?>" name="dp_options[footer_banner_image<?php echo $i; ?>]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_banner_image'.$i]){ echo wp_get_attachment_image($options['footer_banner_image'.$i], 'medium'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_banner_image'.$i]){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
      </ul>

     </div><!-- END .sub_box_tab_content -->
     <?php endfor; ?>

     <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-genesis'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-genesis'); ?></span><?php echo tcd_font_size_option($options, 'footer_banner_title_font_size'); ?></li>
     </ul>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 住所エリアの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer information area', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/footer_info_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e( 'Logo', 'tcd-genesis' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-genesis'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e( 'Footer information', 'tcd-genesis' ); ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[footer_address]" placeholder="<?php _e( 'You can enter your company (store) name and address here, as well as your catchphrase.', 'tcd-genesis' ); ?>"><?php echo esc_textarea(  $options['footer_address'] ); ?></textarea>

     <h4 class="theme_option_headline_number"><span class="num">3</span><?php _e( 'SNS icon', 'tcd-genesis' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'SNS icons can be set in basic settings. The specifications are displayed in the following locations.<br><br>Footer menu area (PC/Mobile)<br>Lower part of the drawer menu (Mobile only)', 'tcd-genesis' ); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">4</span><?php _e( 'Menu', 'tcd-genesis' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set menu from <a href="./nav-menus.php" target="_blank">"Menu Screen"</a> in theme menu.', 'tcd-genesis'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">5</span><?php _e( 'Copyright', 'tcd-genesis' ); ?></h4>
     <input class="full_width" type="text" name="dp_options[copyright]" value="<?php echo esc_attr( $options['copyright'] ); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar (mobile device only)', 'tcd-genesis' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2"><p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-genesis' ); ?></div>

      <h4 class="theme_option_headline2"><?php _e('Footer bar type', 'tcd-genesis'); ?></h4>
      <?php echo tcd_admin_image_radio_button($options, 'footer_bar_type', $footer_bar_type_options) ?>

      <div class="theme_option_message2 footer_bar_not_type4_option">
        <p><?php _e( 'You can display the button with icon. (We recommend you to set max 4 buttons.)', 'tcd-genesis' ); ?></p>
      </div>
      <div class="theme_option_message2 footer_bar_type4_option">
        <p><?php _e( 'Simple buttons without icons can be displayed. (We recommend you to set max 2 buttons.)', 'tcd-genesis' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-genesis'); ?></h4>
      <div class="theme_option_message" style="margin-top:10px;">
        <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-genesis' ); ?></p>
      </div>
        
      <div class="repeater-wrapper">
        <input type="hidden" name="dp_options[footer_bar_btns]" value="">
        <div class="repeater sortable" data-delete-confirm="<?php _e('Delete?', 'tcd-genesis'); ?>">
          <?php
                if ( $options['footer_bar_btns'] ) :
                  foreach ( $options['footer_bar_btns'] as $key => $value ) :  
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
            <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-genesis'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-genesis' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-genesis' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-genesis' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-genesis'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-genesis'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-genesis'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-genesis'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-genesis'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-genesis'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $footer_bar_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
                <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-genesis' ); ?></span></label></li>
               </ul>
               <div class="theme_option_message2 material_icon_option">
                <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-genesis'); ?></p>
               </div>
               <input class="full_width material_icon_option" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-genesis' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-genesis'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-genesis'); ?></a></li>
              </ul>
            </div>
          </div>
          <?php
                  endforeach;
                endif;
                $key = 'addindex';
                $value = array(
                  'type' => 'type1',
                  'label' => '',
                  'url' => '',
                  'target' => 0,
                  'number' => '',
                  'icon' => 'e80d',
                  'material_icon' => '',
                  'color' => '#000000'
                );
                ob_start();
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
            <h4 class="theme_option_subbox_headline"><?php _e('New item', 'tcd-genesis'); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-genesis'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-genesis' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-genesis' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-genesis' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-genesis'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-genesis'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-genesis'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-genesis'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-genesis'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-genesis'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $footer_bar_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
                <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-genesis' ); ?></span></label></li>
               </ul>
               <div class="theme_option_message2 material_icon_option" style="display:none;">
                <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-genesis'); ?></p>
               </div>
               <input class="full_width material_icon_option"  style="display:none;" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-genesis' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-genesis'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-genesis'); ?></a></li>
              </ul>
            </div>
          </div>
          <?php
                $clone = ob_get_clean();
          ?>
        </div><!-- END .repeater -->
        <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e('Add item', 'tcd-genesis'); ?></a>
      </div><!-- END .repeater-wrapper -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php _e('Close', 'tcd-genesis'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_button_options, $footer_bar_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options;

  // アイコンバナーの設定
  $input['show_footer_banner'] = ! empty( $input['show_footer_banner'] ) ? 1 : 0;
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['footer_banner_title'.$i] = wp_filter_nohtml_kses( $input['footer_banner_title'.$i] );
    $input['footer_banner_sub_title'.$i] = wp_filter_nohtml_kses( $input['footer_banner_sub_title'.$i] );
    $input['footer_banner_url'.$i] = wp_filter_nohtml_kses( $input['footer_banner_url'.$i] );
    $input['footer_banner_target'.$i] = ! empty( $input['footer_banner_target'.$i] ) ? 1 : 0;
    $input['footer_banner_image'.$i] = wp_filter_nohtml_kses( $input['footer_banner_image'.$i] );
  }
  $input['footer_banner_title_font_size'] = wp_filter_nohtml_kses( $input['footer_banner_title_font_size'] );


  // 住所
  $input['footer_address'] = wp_kses_post($input['footer_address']);


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);


  // スマホ用固定フッターバーの設定
  if ( ! isset( $input['footer_bar_type'] ) || ! array_key_exists( $input['footer_bar_type'], $footer_bar_type_options ) )
    $input['footer_bar_type'] = $dp_default_options['footer_bar_type'];

  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'color' => isset( $input['footer_bar_btns'][$key]['color'] ) ? sanitize_hex_color( $input['footer_bar_btns'][$key]['color'] ) : '',
        'icon' => isset( $input['footer_bar_btns'][$key]['icon'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['icon'] ) : 'twitter',
        'material_icon' => isset( $input['footer_bar_btns'][$key]['material_icon'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['material_icon'] ) : '',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;


	return $input;

};


?>