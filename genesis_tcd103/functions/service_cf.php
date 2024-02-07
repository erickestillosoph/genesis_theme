<?php

// ヘッダーの設定 -------------------------------------------------------

function service_meta_box() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );
  add_meta_box(
    'service_custom_field',//ID of meta box
    sprintf(__('%s page', 'tcd-genesis'), $service_label),//label
    'show_service_meta_box',//callback function
    'service',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'service_meta_box');

function show_service_meta_box() {

  global $post;

  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );

  $service_link_list_headline = get_post_meta($post->ID, 'service_link_list_headline', true);
  $service_link_list_sub_title = get_post_meta($post->ID, 'service_link_list_sub_title', true);
  $service_link_list = get_post_meta($post->ID, 'service_link_list', true);
  $service_link_list_layout = get_post_meta($post->ID, 'service_link_list_layout', true) ?  get_post_meta($post->ID, 'service_link_list_layout', true) : 'type2';

  echo '<input type="hidden" name="service_custom_field_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

  <?php // 一覧の設定 --------------------------------------------------- ?>
  <div id="page_faq_option" class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php printf(__('%s link list', 'tcd-genesis'), $service_label); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img class="service_link_list_layout_type1_option" src="<?php bloginfo('template_url'); ?>/admin/img/service_link_image2.jpg?2.0" width="" height="" />
     <img class="service_link_list_layout_type2_option" src="<?php bloginfo('template_url'); ?>/admin/img/service_link_image.jpg?2.0" width="" height="" />
    </div>

    <div class="theme_option_message2">
     <p><?php printf(__('Links list will be displayed at the bottom of the page. It can be set for each %s page.','tcd-genesis'), $service_label); ?></p>
    </div>

    <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-genesis' ); ?></h4>
    <ul class="option_list">
     <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-genesis');  ?></span><input class="full_width" type="text" name="service_link_list_headline" value="<?php esc_attr_e( $service_link_list_headline ); ?>" /></li>
     <li class="cf"><span class="label"><span class="num">2</span><?php _e('Sub title', 'tcd-genesis');  ?></span><input class="full_width" type="text" name="service_link_list_sub_title" value="<?php esc_attr_e( $service_link_list_sub_title ); ?>" /></li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-genesis' ); ?></h4>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Layout', 'tcd-genesis');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="service_link_list_layout_type1" name="service_link_list_layout" value="type1"<?php checked( $service_link_list_layout, 'type1' ); ?>>
       <label for="service_link_list_layout_type1"><?php _e('One column', 'tcd-genesis');  ?></label>
       <input type="radio" id="service_link_list_layout_type2" name="service_link_list_layout" value="type2"<?php checked( $service_link_list_layout, 'type2' ); ?>>
       <label for="service_link_list_layout_type2"><?php _e('Two column', 'tcd-genesis');  ?></label>
      </div>
     </li>
    </ul>

    <?php // リスト ------------------------------------------------------------------------- ?>
    <h4 class="theme_option_headline2"><?php _e('Link list', 'tcd-genesis'); ?></h4>
    <?php //繰り返しフィールド ----- ?>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
       <?php
           if ( $service_link_list ) :
             foreach ( $service_link_list as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $service_link_list[$key]['link_label'] ) ? $service_link_list[$key]['link_label'] : tcd_admin_label('new_item') ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list">
          <li class="cf"><span class="label"><span class="num">3</span><?php _e('Catchphrase', 'tcd-genesis');  ?></span><textarea class="repeater-label full_width" cols="50" rows="3" name="service_link_list[<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_attr( isset( $service_link_list[$key]['catch'] ) ? $service_link_list[$key]['catch'] : '' ); ?></textarea></li>
          <li class="cf service_link_list_layout_type1_option"><span class="label"><span class="num">4</span><?php _e('Description', 'tcd-genesis');  ?></span><textarea class="full_width" cols="50" rows="3" name="service_link_list[<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_attr( isset( $service_link_list[$key]['desc'] ) ? $service_link_list[$key]['desc'] : '' ); ?></textarea></li>
          <li class="cf service_link_list_layout_type2_option"><span class="label"><span class="num">4</span><?php _e('Link label', 'tcd-genesis');  ?></span><input class="full_width" type="text" name="service_link_list[<?php echo esc_attr( $key ); ?>][link_label]" value="<?php echo esc_attr( isset( $service_link_list[$key]['link_label'] ) ? $service_link_list[$key]['link_label'] : '' ); ?>" /></li>
          <li class="cf button_option">
           <span class="label">
            <span class="num service_link_list_layout_type1_option">5</span><span class="num service_link_list_layout_type2_option">4</span><?php _e('Link URL', 'tcd-genesis'); ?>
            <span class="recommend_desc"><?php _e('Link will not be displayed when link URL is blank', 'tcd-genesis'); ?></span>
           </span>
           <div class="admin_link_option">
            <input type="hidden" value="0" name="service_link_list[<?php echo esc_attr( $key ); ?>][target]">
            <input type="text" name="service_link_list[<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php echo esc_attr( isset( $service_link_list[$key]['url'] ) ? $service_link_list[$key]['url'] : '' ); ?>">
            <input id="service_link_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="service_link_list[<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $service_link_list[$key]['target'], 1 ); ?>>
            <label for="service_link_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
           </div>
          </li>
          <li class="cf">
           <span class="label">
            <span class="num service_link_list_layout_type1_option">6</span><span class="num service_link_list_layout_type2_option">5</span>
            <?php _e('Image', 'tcd-genesis'); ?>
            <span class="recommend_desc service_link_list_layout_type1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '640', '300'); ?></span>
            <span class="recommend_desc service_link_list_layout_type2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '190', '190'); ?></span>
           </span>
           <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js service_link_list_image<?php echo esc_attr( $key ); ?>">
             <input type="hidden" value="<?php echo esc_attr( isset( $service_link_list[$key]['image'] ) ? $service_link_list[$key]['image'] : '' ); ?>" id="service_link_list_image<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
             <div class="preview_field"><?php if(isset($service_link_list[$key]['image'])){ echo wp_get_attachment_image($service_link_list[$key]['image'], 'size1'); }; ?></div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if(!isset($service_link_list[$key]['image'])){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div>
          </li>
          <li class="cf service_link_list_layout_type1_option">
           <span class="label"><span class="num">6</span><?php _e('Image position', 'tcd-genesis');  ?></span>
           <div class="standard_radio_button">
            <input type="radio" id="service_link_list_image_layout_type1<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image_layout]" value="type1" <?php if(isset($service_link_list[$key]['image_layout'])){ checked( $service_link_list[$key]['image_layout'], 'type1' ); } else { echo 'checked'; }; ?>>
            <label for="service_link_list_image_layout_type1<?php echo esc_attr( $key ); ?>"><?php _e('Left', 'tcd-genesis');  ?></label>
            <input type="radio" id="service_link_list_image_layout_type2<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image_layout]" value="type2" <?php if(isset($service_link_list[$key]['image_layout'])){ checked( $service_link_list[$key]['image_layout'], 'type2' ); }; ?>>
            <label for="service_link_list_image_layout_type2<?php echo esc_attr( $key ); ?>"><?php _e('Right', 'tcd-genesis');  ?></label>
           </div>
          </li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
             endforeach;
           endif;
           $key = 'addindex';
           ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $service_link_list[$key]['link_label'] ) ? $service_link_list[$key]['link_label'] : tcd_admin_label('new_item') ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list">
          <li class="cf"><span class="label"><span class="num">3</span><?php _e('Catchphrase', 'tcd-genesis');  ?></span><textarea class="repeater-label full_width" cols="50" rows="3" name="service_link_list[<?php echo esc_attr( $key ); ?>][catch]"></textarea></li>
          <li class="cf service_link_list_layout_type1_option"><span class="label"><span class="num">4</span><?php _e('Description', 'tcd-genesis');  ?></span><textarea class="full_width" cols="50" rows="3" name="service_link_list[<?php echo esc_attr( $key ); ?>][desc]"></textarea></li>
          <li class="cf service_link_list_layout_type2_option"><span class="label"><span class="num">4</span><?php _e('Link label', 'tcd-genesis');  ?></span><input class="full_width" type="text" name="service_link_list[<?php echo esc_attr( $key ); ?>][link_label]" value="" /></li>
          <li class="cf button_option">
           <span class="label">
            <span class="num service_link_list_layout_type1_option">5</span><span class="num service_link_list_layout_type2_option">4</span><?php _e('Link URL', 'tcd-genesis'); ?>
            <span class="recommend_desc"><?php _e('Link will not be displayed when link URL is blank', 'tcd-genesis'); ?></span>
           </span>
           <div class="admin_link_option">
            <input type="hidden" value="0" name="service_link_list[<?php echo esc_attr( $key ); ?>][target]">
            <input type="text" name="service_link_list[<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="">
            <input id="service_link_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="service_link_list[<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1">
            <label for="service_link_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
           </div>
          </li>
          <li class="cf">
           <span class="label">
            <span class="num service_link_list_layout_type1_option">6</span><span class="num service_link_list_layout_type2_option">5</span>
            <?php _e('Image', 'tcd-genesis'); ?>
            <span class="recommend_desc service_link_list_layout_type1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '640', '300'); ?></span>
            <span class="recommend_desc service_link_list_layout_type2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '190', '190'); ?></span>
           </span>
           <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js service_link_list_image<?php echo esc_attr( $key ); ?>">
             <input type="hidden" value="" id="service_link_list_image<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
             <div class="preview_field"></div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button hidden">
             </div>
            </div>
           </div>
          </li>
          <li class="cf service_link_list_layout_type1_option">
           <span class="label"><span class="num">6</span><?php _e('Image position', 'tcd-genesis');  ?></span>
           <div class="standard_radio_button">
            <input type="radio" id="service_link_list_image_layout_type1<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image_layout]" value="type1" checked>
            <label for="service_link_list_image_layout_type1<?php echo esc_attr( $key ); ?>"><?php _e('Left', 'tcd-genesis');  ?></label>
            <input type="radio" id="service_link_list_image_layout_type2<?php echo esc_attr( $key ); ?>" name="service_link_list[<?php echo esc_attr( $key ); ?>][image_layout]" value="type2">
            <label for="service_link_list_image_layout_type2<?php echo esc_attr( $key ); ?>"><?php _e('Right', 'tcd-genesis');  ?></label>
           </div>
          </li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
           $clone = ob_get_clean();
       ?>
       </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
    </div><!-- END .repeater-wrapper -->
    <?php //繰り返しフィールドここまで ----- ?>

    <ul class="button_list cf">
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_service_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['service_custom_field_nonce']) || !wp_verify_nonce($_POST['service_custom_field_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'service_link_list_headline','service_link_list_sub_title','service_link_list_layout'
  );
  foreach ($cf_keys as $cf_key) {

    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }

  }

  // repeater save or delete
  $cf_keys = array('service_link_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_service_meta_box');



?>