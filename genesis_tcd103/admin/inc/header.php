<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-genesis' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  $main_color = $dp_default_options['main_color'];

  //検索フォーム
	$dp_default_options['show_header_search'] = 'display';

  // メガメニュー
  $dp_default_options['megamenu_new'] = array();
	$dp_default_options['megamenu_color_type'] = 'megamenu_light_color';
	$dp_default_options['megamenu_a_post_type'] = 'recent_post';
	$dp_default_options['megamenu_a_post_order'] = 'date';
	$dp_default_options['megamenu_a_post_num'] = '8';

  // メッセージ
	$dp_default_options['show_header_message'] = 'hide';
	$dp_default_options['header_message'] = __('Header message', 'tcd-genesis');
  $dp_default_options['header_message_url'] = '';
  $dp_default_options['header_message_target'] = '';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = $main_color;

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $basic_display_options, $bool_options, $logo_type_options, $font_type_options, $megamenu_color_type_options;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-genesis' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );

  $main_color = $options['main_color'];

?>

<div id="tab-content-header" class="tab-content">


   <?php // 基本設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Display setting', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <?php // ロゴ ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-genesis' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-genesis'); ?></p>
     </div>

     <?php // メニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Menu', 'tcd-genesis' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set menu from <a href="./nav-menus.php">custom menu</a> page.', 'tcd-genesis'); ?></p>
     </div>

     <?php // 検索フォーム ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Search form', 'tcd-genesis');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The search form also appears at the bottom of the drawer menu on mobile device.','tcd-genesis'); ?><br>
      <?php _e('You can narrow down search result from "Basic Settings > 404 / Search Results Page" section.','tcd-genesis'); ?></p>
     </div>
     <p><?php echo tcd_basic_radio_button($options, 'show_header_search', $basic_display_options); ?></p>
     <br style="clear:both;">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ---------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('If any of the following pages are set to "Global Menu" on the <a href="./nav-menus.php" target="_blank">"Menu Screen"</a>, they can be displayed as mega menus.', 'tcd-genesis'); ?></p>
      <p><?php printf(__('%s archive page<br>%s archive page (Please set %s category page for child menu under parent menu)', 'tcd-genesis'), $blog_label, $service_label, $service_label); ?></p>
     </div>
     <ul class="megamenu_image clearfix">
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu1.jpg" alt="<?php printf(__('%s carousel', 'tcd-genesis'), $blog_label); ?>" title="" />
       <p><?php printf(__('%s carousel', 'tcd-genesis'), $blog_label); ?></p>
      </li>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu2.jpg" alt="<?php printf(__('%s post', 'tcd-genesis'), $service_label); ?>" title="" />
       <p><?php printf(__('%s post', 'tcd-genesis'), $service_label); ?></p>
      </li>
     </ul>

     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
     ?>
     <h4 class="theme_option_headline2 megamenu_option"><?php _e('Menu type setting', 'tcd-genesis'); ?></h4>
     <div class="theme_option_message2 megamenu_option">
      <p><?php _e('The menu items set in the <a href="./nav-menus.php" target="_blank">"Menu screen"</a> that can be turned into a mega menu are displayed below.', 'tcd-genesis'); ?></p>
     </div>
     <ul class="option_list megamenu_option">
      <?php
           $i = 1;
           $megamenu_a_flag = true;
           $megamenu_b_flag = true;
           foreach ( $global_nav_items as $item ) :
             if ( $item->menu_item_parent ) continue;
             if( $megamenu_b_flag && ( $item->url == get_permalink(get_option('page_for_posts')) ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_b_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_a" <?php checked( $value, 'use_megamenu_a' ); ?>>
        <label for="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-genesis'); ?></label>
        <input id="use_megamenu_a_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_a_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-genesis'); ?></label>
       </div>
      </li>
      <?php
             } elseif( $megamenu_a_flag && ( ($item->object == 'service' && $item->type == 'post_type_archive') || $item->url == get_post_type_archive_link('service') ) ){
               $has_term_menu = false;
               foreach ( $global_nav_items as $item2 ) {
                 if ( $item2->menu_item_parent == $item->ID && $item2->object === 'service_category' ) {
                   $has_term_menu = true;
                   break;
                 }
               }
               if ( $has_term_menu ) {
                 $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
                 $megamenu_a_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_b" <?php checked( $value, 'use_megamenu_b' ); ?>>
        <label for="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-genesis'); ?></label>
        <input id="use_megamenu_b_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?>>
        <label for="use_megamenu_b_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-genesis'); ?></label>
       </div>
      </li>
      <?php
               };
             };
             $i++;
           endforeach;
      ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-genesis' ); ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'megamenu_color_type', $megamenu_color_type_options) ?>

     <h4 class="theme_option_headline2"><?php printf(__('%s carousel', 'tcd-genesis'), $blog_label); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-genesis');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_a_post_type1" type="radio" name="dp_options[megamenu_a_post_type]" value="recent_post" <?php checked( $options['megamenu_a_post_type'], 'recent_post' ); ?>>
        <label for="megamenu_a_post_type1"><?php _e('Recent post', 'tcd-genesis'); ?></label>
        <input id="megamenu_a_post_type2" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post" <?php checked( $options['megamenu_a_post_type'], 'recommend_post' ); ?>>
        <label for="megamenu_a_post_type2"><?php _e('Recommend post', 'tcd-genesis'); ?></label>
        <input id="megamenu_a_post_type3" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post2" <?php checked( $options['megamenu_a_post_type'], 'recommend_post2' ); ?>>
        <label for="megamenu_a_post_type3"><?php _e('Recommend post', 'tcd-genesis'); ?>2</label>
        <input id="megamenu_a_post_type4" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post3" <?php checked( $options['megamenu_a_post_type'], 'recommend_post3' ); ?>>
        <label for="megamenu_a_post_type4"><?php _e('Recommend post', 'tcd-genesis'); ?>3</label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-genesis');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_a_post_order1" type="radio" name="dp_options[megamenu_a_post_order]" value="date" <?php checked( $options['megamenu_a_post_order'], 'date' ); ?>>
        <label for="megamenu_a_post_order1"><?php _e('Date', 'tcd-genesis'); ?></label>
        <input id="megamenu_a_post_order2" type="radio" name="dp_options[megamenu_a_post_order]" value="rand" <?php checked( $options['megamenu_a_post_order'], 'rand' ); ?>>
        <label for="megamenu_a_post_order2"><?php _e('Random', 'tcd-genesis'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-genesis'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" name="dp_options[megamenu_a_post_num]" value="<?php echo esc_attr( $options['megamenu_a_post_num'] ); ?>" /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-genesis' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-genesis' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-genesis');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/header_message_image.jpg" alt="" title="" />
     </div>

      <div class="theme_option_message2">
       <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-genesis'); ?></br>
       <?php _e('If you are using LP template, you can set display setting individually from page edit screen.', 'tcd-genesis'); ?></p>
      </div>

      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Header message', 'tcd-genesis');  ?></span><?php echo tcd_basic_radio_button($options, 'show_header_message', $basic_display_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Message', 'tcd-genesis');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
       <li class="cf">
        <span class="label"><?php _e('URL', 'tcd-genesis'); ?></span>
        <div class="admin_link_option">
         <input type="text" name="dp_options[header_message_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_message_url'] ); ?>">
         <input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
         <label for="header_message_target">&#xe920;</label>
        </div>
       </li>
       <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker"></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $logo_type_options;


  // 検索フォーム
  $input['show_header_search'] = wp_filter_nohtml_kses( $input['show_header_search'] );


  // メガメニュー
  $new_megamenu_options = array(
    'dropdown' => array('value' => 'dropdown'),
    'use_megamenu_a' => array('value' => 'use_megamenu_a'),
    'use_megamenu_b' => array('value' => 'use_megamenu_b')
  );
  foreach ( array_keys( $input['megamenu_new'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu_new'][$index], $new_megamenu_options ) ) {
      $input['megamenu_new'][$index] = null;
    }
  }

  $input['megamenu_color_type'] = wp_filter_nohtml_kses( $input['megamenu_color_type'] );
  $input['megamenu_a_post_type'] = wp_filter_nohtml_kses( $input['megamenu_a_post_type'] );
  $input['megamenu_a_post_order'] = wp_filter_nohtml_kses( $input['megamenu_a_post_order'] );
  $input['megamenu_a_post_num'] = wp_filter_nohtml_kses( $input['megamenu_a_post_num'] );


  // メッセージ
  $input['show_header_message'] = wp_filter_nohtml_kses( $input['show_header_message'] );
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = wp_filter_nohtml_kses( $input['header_message_target'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );


  return $input;

};


?>