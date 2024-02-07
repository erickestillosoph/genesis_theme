<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function service_category_edit_extra_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'desc1' => '',
		'desc2' => '',
		'desc3' => '',
		'desc1_mobile' => '',
		'desc2_mobile' => '',
		'desc3_mobile' => '',
		'image1' => null,
		'sub_title' => '',
		'catch' => '',
		'post_list_type' => 'type2',
		'index_image' => null,
		'index_image_mobile' => null,
		'index_opacity_color' => '#000000',
	), $term_meta );

  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-genesis' );
  $archive_service_type = $options['archive_service_type'] ? $options['archive_service_type'] : 'type1';
  $current_category_name = $term->name;

?>
<tr class="form-field">
	<th colspan="2">

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Basic setting', 'tcd-genesis' ); ?></h3>

 <div class="ccm_content clearfix">
  <div class="input_field">
   <div class="cb_image">
    <?php if($archive_service_type == 'type1'){ ?>
    <div class="item">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_category_image.jpg?2.0" alt="" title="" />
    </div>
    <?php } else { ?>
    <div class="item">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_category_image_type2.jpg?2.0" alt="" title="" />
    </div>
    <div class="item">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_category_image_megamenu.jpg" alt="" title="" />
    </div>
    <?php }; ?>
   </div>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Subheadling', 'tcd-genesis'); ?></span><input type="text" class="full_width" name="term_meta[sub_title]" value="<?php echo esc_html($term_meta['sub_title'] ); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Catchphrase', 'tcd-genesis'); ?></span><textarea class="full_width" cols="50" rows="5" name="term_meta[catch]"><?php echo esc_textarea(  $term_meta['catch'] ); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please enter brief description of the category.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc1]"><?php echo esc_textarea(  $term_meta['desc1'] ); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc1_mobile]"><?php echo esc_textarea(  $term_meta['desc1_mobile'] ); ?></textarea></li>
    <li class="cf"<?php if($archive_service_type == 'type1'){ echo ' style="display:none;"'; }; ?>>
     <span class="label"><span class="num">4</span><?php _e('Archive page post list', 'tcd-genesis');  ?></span>
     <div class="standard_radio_button">
      <input id="archive_page_post_list_type1" type="radio" name="term_meta[post_list_type]" value="type1" <?php checked( $term_meta['post_list_type'], 'type1' ); ?>>
      <label for="archive_page_post_list_type1"><?php _e('One column', 'tcd-genesis'); ?></label>
      <input id="archive_page_post_list_type2" type="radio" name="term_meta[post_list_type]" value="type2" <?php checked( $term_meta['post_list_type'], 'type2' ); ?>>
      <label for="archive_page_post_list_type2"><?php _e('Two column', 'tcd-genesis'); ?></label>
     </div>
    </li>
    <li class="cf">
     <span class="label">
      <?php if($archive_service_type == 'type1'){ ?>
      <span class="num">4</span><?php _e('Image', 'tcd-genesis'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '1450', '600'); ?></span>
      <span class="recommend_desc"><?php _e('This image will also be used in megamenu.', 'tcd-genesis'); ?></span>
      <?php } else { ?>
      <span class="num">5</span><?php _e('Image', 'tcd-genesis'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '362', '150'); ?></span>
      <span class="recommend_desc"><?php _e('This image will be used in megamenu.', 'tcd-genesis'); ?></span>
      <?php }; ?>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js image1">
       <input type="hidden" value="<?php if ( $term_meta['image1'] ) echo esc_attr( $term_meta['image1'] ); ?>" id="image1" name="term_meta[image1]" class="cf_media_id">
       <div class="preview_field"><?php if ( $term_meta['image1'] ) echo wp_get_attachment_image( $term_meta['image1'], 'medium'); ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-genesis' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-genesis' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image1'] ) echo 'hidden'; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf"<?php if($archive_service_type == 'type2'){ echo ' style="display:none;"'; }; ?>><span class="label"><span class="num">5</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'You can also enter a category description here, but it is not a required field.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc2]"><?php echo esc_textarea(  $term_meta['desc2'] ); ?></textarea></li>
    <li class="cf"<?php if($archive_service_type == 'type2'){ echo ' style="display:none;"'; }; ?>><span class="label"><span class="num">5</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc2_mobile]"><?php echo esc_textarea(  $term_meta['desc2_mobile'] ); ?></textarea></li>
    <li class="cf"<?php if($archive_service_type == 'type2'){ echo ' style="display:none;"'; }; ?>><span class="label"><span class="num">6</span><?php _e('Description', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'You can also enter a category description here, but it is not a required field.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc3]"><?php echo esc_textarea(  $term_meta['desc3'] ); ?></textarea></li>
    <li class="cf"<?php if($archive_service_type == 'type2'){ echo ' style="display:none;"'; }; ?>><span class="label"><span class="num">6</span><?php _e('Description (mobile)', 'tcd-genesis'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc3_mobile]"><?php echo esc_textarea(  $term_meta['desc3_mobile'] ); ?></textarea></li>
   </ul>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Front page', 'tcd-genesis' ); ?></h3>

 <div class="ccm_content clearfix">
  <div class="input_field">
   <div class="category_front_page_image">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_category_image2.jpg" alt="" title="" />
   </div>
   <ul class="option_list">
    <li class="cf">
     <span class="label">
      <?php _e('Background image', 'tcd-genesis'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '412', '580'); ?></span>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js index_image">
       <input type="hidden" value="<?php if ( $term_meta['index_image'] ) echo esc_attr( $term_meta['index_image'] ); ?>" id="index_image" name="term_meta[index_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $term_meta['index_image'] ) echo wp_get_attachment_image( $term_meta['index_image'], 'medium'); ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-genesis' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-genesis' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['index_image'] ) echo 'hidden'; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf">
     <span class="label">
      <?php _e('Background image (mobile)', 'tcd-genesis'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '720', '600'); ?></span>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js index_image_mobile">
       <input type="hidden" value="<?php if ( $term_meta['index_image_mobile'] ) echo esc_attr( $term_meta['index_image_mobile'] ); ?>" id="index_image_mobile" name="term_meta[index_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if ( $term_meta['index_image_mobile'] ) echo wp_get_attachment_image( $term_meta['index_image_mobile'], 'medium'); ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-genesis' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-genesis' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['index_image_mobile'] ) echo 'hidden'; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Color of overlay', 'tcd-genesis'); ?></span><input type="text" name="term_meta[index_opacity_color]" value="<?php echo esc_attr( $term_meta['index_opacity_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
   </ul>

  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'service_category_edit_form_fields', 'service_category_edit_extra_fields' );


// データを保存 -------------------------------------------------------
function service_category_save_extra_fileds( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_service_category', 'service_category_save_extra_fileds' );


