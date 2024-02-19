<?php
/*
 * トップページの設定
 */

// Add default values
add_filter('before_getting_design_plus_option', 'add_front_page_dp_default_options');


// Add label of front page tab
add_action('tcd_tab_labels', 'add_front_page_tab_label');


// Add HTML of front page tab
add_action('tcd_tab_panel', 'add_front_page_tab_panel');


// Register sanitize function
add_filter('theme_options_validate', 'add_front_page_theme_options_validate');


// タブの名前
function add_front_page_tab_label($tab_labels)
{
  $tab_labels['front_page'] = __('Front page', 'tcd-genesis');
  return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options($dp_default_options)
{

  // ヘッダースライダー
  $dp_default_options['index_slider_layout'] = 'type1';

  // Tag color picker
  $dp_default_options['tag_bg_color'] = '#283F75';

  // Title break background
  $dp_default_options['title_bg_color'] = '#1A202C';

  // Title break background
  $dp_default_options['title_headline_color'] = '#fe8d01';

  // Title break background
  $dp_default_options['title_sub_headline_color'] = '#fff';

  // 左側のコンテンツ
  $dp_default_options['index_slider_catch'] = 'CATCHPHRASE';
  $dp_default_options['index_slider_catch_font_type'] = 'type2';
  $dp_default_options['index_slider_catch_font_size'] = '76';
  $dp_default_options['index_slider_catch_font_size_sp'] = '30';
  $dp_default_options['index_slider_desc'] = __('Description will be displayed here.', 'tcd-genesis');
  $dp_default_options['index_slider_desc_mobile'] = '';
  $dp_default_options['index_slider_desc_font_size'] = '20';
  $dp_default_options['index_slider_desc_font_size_sp'] = '16';

  // 右側のコンテンツ
  $dp_default_options['index_header_content_type'] = 'type1';
  $dp_default_options['index_slider_image'] = false;
  $dp_default_options['index_slider_image_sp'] = false;
  $dp_default_options['index_header_content_video'] = '';
  $dp_default_options['index_header_content_youtube'] = '';
  $dp_default_options['index_header_content_overlay_color'] = '#000000';
  $dp_default_options['index_header_content_overlay_opacity'] = '0.1';
  $dp_default_options['index_header_slide_type'] = 'slide_up';
  $dp_default_options['index_header_slide_effect'] = 'zoom_out';

  // コンテンツビルダー
  $dp_default_options['page_content_width_type'] = 'type1';
  $dp_default_options['page_content_width'] = '1030';
  $dp_default_options['index_content_type'] = 'type1';

  //Marquee Text 
  $dp_default_options['index_marquee_position'] = 'right';

  //Tag Text
  $dp_default_options['tag_font_size'] = '24';
  $dp_default_options['tag_font_size_sp'] = '14';

  $dp_default_options['contents_builder'] = array(
    array(
      "cb_content_select" => "design_content",
      "show_content" => 1,
      "headline" => 'COMPANY',
      "sub_title" => __('Subtitle', 'tcd-genesis'),
      "desc" => __('Description will be displayed here.', 'tcd-genesis'),
      "desc_mobile" => "",
      "button_label" => __('Link button', 'tcd-genesis'),
      "button_url" => "#",
      "item_headline1" => __('Headline', 'tcd-genesis'),
      "item_headline2" => __('Headline', 'tcd-genesis'),
      "item_title1" => __('Title', 'tcd-genesis'),
      "item_title2" => __('Title', 'tcd-genesis'),
      "item_url1" => "#",
      "item_url2" => "#",
      "overlay_color1" => "#000000",
      "overlay_color2" => "#000000",
    ),
    array(
      "cb_content_select" => "news_list",
      "show_content" => 1,
      "headline" => 'NEWS',
      "sub_title" => __('Subtitle', 'tcd-genesis'),
      "desc" => '',
      "desc_mobile" => "",
      "button_label" => __('Archive page', 'tcd-genesis'),
      "post_num" => "10",
      "post_num_sp" => "5"
    ),
    array(
      "cb_content_select" => "blog_list",
      "show_content" => 1,
      "headline" => 'BLOG',
      "sub_title" => __('Subtitle', 'tcd-genesis'),
      "desc" => '',
      "desc_mobile" => "",
      "button_label" => __('Archive page', 'tcd-genesis'),
      "post_type" => "recent_post",
      "post_order" => "date",
      "post_num" => "10",
      "post_num_mobile" => "5",
    ),
    array(
      "cb_content_select" => "section_content_free",
      "show_content" => 1,
      "show_tags" => 1,
      "position_of_image" => 1,
      "super_headline" => 'SUPER HEADLINE',
      "headline1" => 'COMPANY',
      "headline2" => 'COMPANY',
      "sub_title" => __('Subtitle', 'tcd-genesis'),
      "desc" => __('Description will be displayed here.', 'tcd-genesis'),
      "desc_mobile" => "",
      "button_label" => __('Link button', 'tcd-genesis'),
      "button_url" => "#",
      "item_image" => "",
      "item_headline1" => __('Headline', 'tcd-genesis'),
      "item_headline2" => __('Headline', 'tcd-genesis'),
      "item_title1" => __('Title', 'tcd-genesis'),
      "animation_trigger" => 1,
    ),
    array(
      "cb_content_select" => "section_title_break",
      "show_content" => 1,
      "position_of_image" => 1,
      "headline1" => 'COMPANY',
      "sub_title" => __('Subtitle', 'tcd-genesis'),
      "item_image" => "",
    ),
    array(
      "cb_content_select" => "section_recruitment",
      "show_content" => 1,
      "super_headline" => 'OPPORTUNITY',
      "item_title1" => __('Title', 'tcd-genesis'),
      "item_title2" => __('Title', 'tcd-genesis'),
      "item_title3" => __('Title', 'tcd-genesis'),
      "desc1" => __('Description will be displayed here.', 'tcd-genesis'),
      "desc2" => __('Description will be displayed here.', 'tcd-genesis'),
      "desc3" => __('Description will be displayed here.', 'tcd-genesis'),
      "desc_mobile1" => "",
      "desc_mobile2" => "",
      "desc_mobile3" => "",
      "button_label1" => __('Link button', 'tcd-genesis'),
      "button_label2" => __('Link button', 'tcd-genesis'),
      "button_label3" => __('Link button', 'tcd-genesis'),
      "button_url1" => "#",
      "button_url2" => "#",
      "button_url3" => "#",
    ),
    array(
      "cb_content_select" => "marquee_text",
      "show_content" => 1,
      "text_marquee" => 'COMPANY NAME',
    ),
  );

  return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel($options)
{

  global $blog_label, $dp_default_options, $item_type_options, $time_options, $font_type_options,$image_position_type, $marquee_position_type, $font_direction_options, $bool_options, $basic_display_options,
  $loading_type, $loading_display_page_options, $loading_display_time_options, $logo_type_options, $font_direction_options, $slider_layout_options;
  $news_label = $options['news_label'] ? esc_html($options['news_label']) : __('News', 'tcd-genesis');
  $service_label = $options['service_label'] ? esc_html($options['service_label']) : __('Service', 'tcd-genesis');

  ?>

  <div id="tab-content-front-page" class="tab-content">

    <?php // ヘッダーコンテンツ ---------- ?>
    <div class="theme_option_field cf theme_option_field_ac">
      <h3 class="theme_option_headline">
        <?php _e('Header content', 'tcd-genesis'); ?>
      </h3>
      <div class="theme_option_field_ac_content header_content_setting_area tab_parent">

        <h4 class="theme_option_headline2">
          <?php _e('Layout', 'tcd-genesis'); ?>
        </h4>
        <div id="index_slider_layout">
          <?php echo tcd_admin_image_radio_button($options, 'index_slider_layout', $slider_layout_options) ?>
        </div>

        <h4 class="theme_option_headline2">
          <?php _e('Background type', 'tcd-genesis'); ?>
        </h4>
        <ul class="design_radio_button horizontal clearfix">
          <li class="index_header_content_type1">
            <input type="radio" id="index_header_content_type1" name="dp_options[index_header_content_type]" value="type1"
              <?php checked($options['index_header_content_type'], 'type1'); ?> />
            <label for="index_header_content_type1">
              <?php _e('Image slider', 'tcd-genesis'); ?>
            </label>
          </li>
          <li class="index_header_content_type2">
            <input type="radio" id="index_header_content_type2" name="dp_options[index_header_content_type]" value="type2"
              <?php checked($options['index_header_content_type'], 'type2'); ?> />
            <label for="index_header_content_type2">
              <?php _e('Video', 'tcd-genesis'); ?>
            </label>
          </li>
          <li class="index_header_content_type3">
            <input type="radio" id="index_header_content_type3" name="dp_options[index_header_content_type]" value="type3"
              <?php checked($options['index_header_content_type'], 'type3'); ?> />
            <label for="index_header_content_type3">
              <?php _e('YouTube', 'tcd-genesis'); ?>
            </label>
          </li>
        </ul>

        <div class="sub_box_tab">
          <div class="tab active" data-tab="tab1">
            <?php _e('Main content', 'tcd-genesis'); ?>
          </div>
          <div class="tab" data-tab="tab2"><span class="index_header_content_type1_option">
              <?php _e('Image slider', 'tcd-genesis'); ?>
            </span><span class="index_header_content_type2_option">
              <?php _e('Video', 'tcd-genesis'); ?>
            </span><span class="index_header_content_type3_option">
              <?php _e('YouTube', 'tcd-genesis'); ?>
            </span></div>
        </div>

        <?php // 左側のコンテンツ ?>
        <div class="sub_box_tab_content active" data-tab-content="tab1">

          <ul class="option_list">
            <li class="cf"><span class="label">
                <?php _e('Catchphrase', 'tcd-genesis'); ?>
              </span><textarea class="full_width" cols="50" rows="3"
                name="dp_options[index_slider_catch]"><?php echo esc_textarea($options['index_slider_catch']); ?></textarea>
            </li>
            <li class="cf"><span class="label">
                <?php _e('Font type of catchphrase', 'tcd-genesis'); ?>
              </span>
              <?php echo tcd_basic_radio_button($options, 'index_slider_catch_font_type', $font_type_options); ?>
            </li>
            <li class="cf"><span class="label">
                <?php _e('Font size of catchphrase', 'tcd-genesis'); ?>
              </span>
              <?php echo tcd_font_size_option($options, 'index_slider_catch_font_size'); ?>
            </li>
            <li class="cf"><span class="label">
                <?php _e('Description', 'tcd-genesis'); ?>
              </span><textarea class="full_width" cols="50" rows="3"
                name="dp_options[index_slider_desc]"><?php echo esc_textarea($options['index_slider_desc']); ?></textarea>
            </li>
            <li class="cf"><span class="label">
                <?php _e('Description (mobile)', 'tcd-genesis'); ?>
              </span><textarea
                placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                class="full_width" cols="50" rows="2"
                name="dp_options[index_slider_desc_mobile]"><?php echo esc_textarea($options['index_slider_desc_mobile']); ?></textarea>
            </li>
            <li class="cf"><span class="label">
                <?php _e('Font size of description', 'tcd-genesis'); ?>
              </span>
              <?php echo tcd_font_size_option($options, 'index_slider_desc_font_size'); ?>
            </li>
          </ul>

        </div><!-- END .sub_box_tab_content -->

        <?php // 右側のコンテンツ ----------------------- ?>
        <div class="sub_box_tab_content" data-tab-content="tab2">

          <?php // 画像スライダー ----------------------- ?>
          <div class="index_header_content_type1_option">

            <ul class="option_list">
              <li class="cf">
                <span class="label">
                  <?php _e('Image', 'tcd-genesis'); ?>
                  <span class="recommend_desc header_slider_layout1_option">
                    <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '1450', '600'); ?>
                  </span>
                  <span class="recommend_desc header_slider_layout3_option">
                    <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '1450', '1100'); ?>
                  </span>
                  <span class="recommend_desc">
                    <?php _e('You can register multiple image by clicking images in media library.', 'tcd-genesis'); ?>
                  </span>
                </span>
                <?php echo tcd_multi_media_uploader('index_slider_image', $options); ?>
              </li>
              <li class="cf">
                <span class="label">
                  <?php _e('Image (mobile)', 'tcd-genesis'); ?>
                  <span class="recommend_desc">
                    <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '750', '1050'); ?>
                  </span>
                </span>
                <?php echo tcd_multi_media_uploader('index_slider_image_sp', $options); ?>
              </li>
              <li class="cf">
                <span class="label">
                  <?php _e('Slide type', 'tcd-genesis'); ?>
                  <span class="recommend_desc">
                    <?php _e('Applies when multiple images are set.', 'tcd-genesis'); ?>
                  </span>
                </span>
                <div class="standard_radio_button">
                  <input id="index_header_slide_type1" type="radio" name="dp_options[index_header_slide_type]"
                    value="slide_up" <?php checked($options['index_header_slide_type'], 'slide_up'); ?>>
                  <label for="index_header_slide_type1">
                    <?php _e('Slide up', 'tcd-genesis'); ?>
                  </label>
                  <input id="index_header_slide_type2" type="radio" name="dp_options[index_header_slide_type]"
                    value="fade" <?php checked($options['index_header_slide_type'], 'fade'); ?>>
                  <label for="index_header_slide_type2">
                    <?php _e('Fade', 'tcd-genesis'); ?>
                  </label>
                </div>
              </li>
              <li class="cf">
                <span class="label">
                  <?php _e('Effect', 'tcd-genesis'); ?>
                </span>
                <div class="standard_radio_button">
                  <input id="index_header_slide_effect1" type="radio" name="dp_options[index_header_slide_effect]"
                    value="zoom_out" <?php checked($options['index_header_slide_effect'], 'zoom_out'); ?>>
                  <label for="index_header_slide_effect1">
                    <?php _e('Zoom out', 'tcd-genesis'); ?>
                  </label>
                  <input id="index_header_slide_effect2" type="radio" name="dp_options[index_header_slide_effect]"
                    value="zoom_in" <?php checked($options['index_header_slide_effect'], 'zoom_in'); ?>>
                  <label for="index_header_slide_effect2">
                    <?php _e('Zoom in', 'tcd-genesis'); ?>
                  </label>
                  <input id="index_header_slide_effect3" type="radio" name="dp_options[index_header_slide_effect]"
                    value="none" <?php checked($options['index_header_slide_effect'], 'none'); ?>>
                  <label for="index_header_slide_effect3">
                    <?php _e('No effect', 'tcd-genesis'); ?>
                  </label>
                </div>
              </li>
            </ul>

          </div><!-- END .index_header_content_type1_option -->

          <?php // 動画 --------------------------------------- ?>
          <div class="index_header_content_type2_option">

            <div class="theme_option_message2" style="margin-top:25px;">
              <p>
                <?php _e('Please upload MP4 format file.', 'tcd-genesis'); ?><br>
                <?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-genesis'); ?><br>
                <?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-genesis'); ?>
              </p>
            </div>
            <div class="cf cf_media_field hide-if-no-js index_header_content_video">
              <input type="hidden" value="<?php if ($options['index_header_content_video']) {
                echo esc_attr($options['index_header_content_video']);
              }
              ; ?>" id="index_header_content_video" name="dp_options[index_header_content_video]" class="cf_media_id">
              <div class="preview_field preview_field_video">
                <?php if ($options['index_header_content_video']) { ?>
                  <h4>
                    <?php _e('Uploaded MP4 file', 'tcd-genesis'); ?>
                  </h4>
                  <p>
                    <?php echo esc_url(wp_get_attachment_url($options['index_header_content_video'])); ?>
                  </p>
                <?php }
                ; ?>
              </div>
              <div class="buttton_area">
                <input type="button" value="<?php _e('Select MP4 file', 'tcd-genesis'); ?>"
                  class="cfmf-select-video button">
                <input type="button" value="<?php _e('Remove MP4 file', 'tcd-genesis'); ?>" class="cfmf-delete-video button <?php if (!$options['index_header_content_video']) {
                     echo 'hidden';
                   }
                   ; ?>">
              </div>
            </div>

          </div><!-- END .index_header_content_type2_option -->

          <?php // YouTube --------------------------------------- ?>
          <div class="index_header_content_type3_option">

            <div class="theme_option_message2" style="margin-top:25px;">
              <p>
                <?php _e('Please enter YouTube URL.', 'tcd-genesis'); ?>
              </p>
              <p>
                <?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-genesis'); ?>
              </p>
            </div>
            <input class="full_width" type="text" name="dp_options[index_header_content_youtube]"
              value="<?php echo esc_attr($options['index_header_content_youtube']); ?>">

          </div><!-- END .index_header_content_type3_option -->

          <h4 class="theme_option_headline2">
            <?php _e('Overlay', 'tcd-genesis'); ?>
          </h4>
          <ul class="option_list">
            <li class="cf"><span class="label">
                <?php _e('Color', 'tcd-genesis'); ?>
              </span><input type="text" name="dp_options[index_header_content_overlay_color]"
                value="<?php echo esc_attr($options['index_header_content_overlay_color']); ?>"
                data-default-color="#000000" class="c-color-picker"></li>
            <li class="cf">
              <span class="label">
                <?php _e('Transparency of overlay', 'tcd-genesis'); ?>
              </span><input class="hankaku" style="width:70px;" type="number" step="0.1"
                name="dp_options[index_header_content_overlay_opacity]"
                value="<?php echo esc_attr($options['index_header_content_overlay_opacity']); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
                <p>
                  <?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-genesis'); ?>
                  <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-genesis'); ?>
                </p>
              </div>
            </li>
          </ul>

        </div><!-- END .sub_box_tab_content -->

        <ul class="button_list cf">
          <li><input type="submit" class="button-ml ajax_button"
              value="<?php echo __('Save Changes', 'tcd-genesis'); ?>" /></li>
          <li><a class="close_ac_content button-ml" href="#">
              <?php echo __('Close', 'tcd-genesis'); ?>
            </a></li>
        </ul>
      </div><!-- END .theme_option_field_ac_content -->
    </div><!-- END .theme_option_field -->


    <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
    <div class="theme_option_field theme_option_field_ac open active <?php if ($options['index_content_type'] == 'type1') {
      echo 'show_arrow';
    }
    ; ?>">
      <h3 class="theme_option_headline">
        <?php _e('Content builder', 'tcd-genesis'); ?>
      </h3>
      <div class="theme_option_field_ac_content">

        <ul class="design_radio_button" style="margin-bottom:25px;">
          <li class="index_content_type1_button">
            <input type="radio" id="index_content_type1" name="dp_options[index_content_type]" value="type1" <?php checked($options['index_content_type'], 'type1'); ?> />
            <label for="index_content_type1">
              <?php _e('Use content builder', 'tcd-genesis'); ?>
            </label>
          </li>
          <li class="index_content_type2_button">
            <input type="radio" id="index_content_type2" name="dp_options[index_content_type]" value="type2" <?php checked($options['index_content_type'], 'type2'); ?> />
            <label for="index_content_type2">
              <?php _e('Use page content instead of content builder', 'tcd-genesis'); ?>
            </label>
          </li>
        </ul>

        <?php
        // コンテンツビルダーの代わりに使う固定ページのコンテンツ
        $front_page_id = get_option('page_on_front');
        if ($front_page_id) {
          ?>
          <div class="index_content_type2_option" style="<?php if ($options['index_content_type'] == 'type2') {
            echo 'display:block;';
          } else {
            echo 'display:none;';
          }
          ; ?>">
            <div class="theme_option_message2">
              <p>
                <?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-genesis'), $front_page_id); ?>
              </p>
            </div>
            <h4 class="theme_option_headline2">
              <?php _e('Content width', 'tcd-genesis'); ?>
            </h4>
            <ul class="option_list">
              <li class="cf">
                <span class="label">
                  <?php _e('Content width type', 'tcd-genesis'); ?>
                </span>
                <div class="standard_radio_button">
                  <input id="page_content_width_type1" type="radio" name="dp_options[page_content_width_type]" value="type1"
                    <?php checked($options['page_content_width_type'], 'type1'); ?>>
                  <label for="page_content_width_type1">
                    <?php _e('Any width', 'tcd-genesis'); ?>
                  </label>
                  <input id="page_content_width_type2" type="radio" name="dp_options[page_content_width_type]" value="type2"
                    <?php checked($options['page_content_width_type'], 'type2'); ?>>
                  <label for="page_content_width_type2">
                    <?php _e('Full screen width', 'tcd-genesis'); ?>
                  </label>
                </div>
              </li>
              <li class="cf page_content_width_type1_option" style="<?php if ($options['page_content_width_type'] == 'type1') {
                echo 'display:block;';
              } else {
                echo 'display:none;';
              }
              ; ?>">
                <span class="label">
                  <?php _e('Content width', 'tcd-genesis'); ?>
                </span><input class="hankaku page_content_width_input" style="width:100px;" type="number"
                  name="dp_options[page_content_width]"
                  value="<?php echo esc_attr($options['page_content_width']); ?>" /><span>px</span>
              </li>
            </ul>
            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button"
                  value="<?php echo __('Save Changes', 'tcd-genesis'); ?>" /></li>
            </ul>
          </div>
        <?php }
        ; ?>

        <div class="index_content_type1_option" style="<?php if ($options['index_content_type'] == 'type1') {
          echo 'display:block;';
        } else {
          echo 'display:none;';
        }
        ; ?>">

          <?php // コンテンツビルダー ?>
          <div class="theme_option_message no_arrow">
            <?php echo __('<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-genesis'); ?>
            <br>
            <p>
              <?php _e('For headline and description that do not have font type or font size options, please adjust all at once from the font setting section of the basic settings ', 'tcd-genesis'); ?>
            </p>
          </div>
          <ul class="design_button_list cf">
            <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_design_content2.jpg"
                title="<?php _e('Design banner', 'tcd-genesis'); ?>">
                <?php _e('Design banner', 'tcd-genesis'); ?>
              </a></li>
            <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_service_list2.jpg"
                title="<?php printf(__('%s list', 'tcd-genesis'), $service_label); ?>">
                <?php printf(__('%s list', 'tcd-genesis'), $service_label); ?>
              </a></li>
            <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_blog_list2.jpg"
                title="<?php printf(__('%s list', 'tcd-genesis'), $blog_label); ?>">
                <?php printf(__('%s list', 'tcd-genesis'), $blog_label); ?>
              </a></li>
            <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_news_list2.jpg?2.0"
                title="<?php printf(__('%s list', 'tcd-genesis'), $news_label); ?>">
                <?php printf(__('%s list', 'tcd-genesis'), $news_label); ?>
              </a></li>
          </ul>
        </div>

      </div><!-- END .theme_option_field_ac_content -->
    </div><!-- END .theme_option_field -->

    <div class="contents_builder_wrap index_content_type1_option" style="<?php if ($options['index_content_type'] == 'type1') {
      echo 'display:block;';
    } else {
      echo 'display:none;';
    }
    ; ?>">

      <div class="contents_builder">
        <p class="cb_message">
          <?php _e('Click Add content button to start content builder', 'tcd-genesis'); ?>
        </p>
        <?php
        if (!empty($options['contents_builder'])) {
          foreach ($options['contents_builder'] as $key => $content):
            $cb_index = 'cb_' . $key . '_' . mt_rand(0, 999999);
            ?>
            <div class="cb_row">
              <ul class="cb_button cf">
                <li><span class="cb_move">
                    <?php echo __('Move', 'tcd-genesis'); ?>
                  </span></li>
                <li><span class="cb_delete">
                    <?php echo __('Delete', 'tcd-genesis'); ?>
                  </span></li>
              </ul>
              <div class="cb_column_area cf">
                <div class="cb_column">
                  <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
                  <?php the_cb_content_select($cb_index, $content['cb_content_select']); ?>
                  <?php if (!empty($content['cb_content_select']))
                    the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
                </div>
              </div><!-- END .cb_column_area -->
            </div><!-- END .cb_row -->
            <?php
          endforeach;
        }
        ;
        ?>
      </div><!-- END .contents_builder -->
      <ul class="button_list cf cb_add_row_buttton_area">
        <li><input type="button" value="<?php echo __('Add content', 'tcd-genesis'); ?>" class="button-ml add_row"></li>
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __('Save Changes', 'tcd-genesis'); ?>" />
        </li>
      </ul>

      <?php // コンテンツビルダー追加用 非表示 ?>
      <div class="contents_builder-clone hidden">
        <div class="cb_row">
          <ul class="cb_button cf">
            <li><span class="cb_move">
                <?php echo __('Move', 'tcd-genesis'); ?>
              </span></li>
            <li><span class="cb_delete">
                <?php echo __('Delete', 'tcd-genesis'); ?>
              </span></li>
          </ul>
          <div class="cb_column_area cf">
            <div class="cb_column">
              <input type="hidden" class="cb_index" value="cb_cloneindex" />
              <?php the_cb_content_select('cb_cloneindex'); ?>
            </div>
          </div><!-- END .cb_column_area -->
        </div><!-- END .cb_row -->
        <?php
        the_cb_content_setting('cb_cloneindex', 'design_content');
        the_cb_content_setting('cb_cloneindex', 'service_list');
        the_cb_content_setting('cb_cloneindex', 'blog_list');
        the_cb_content_setting('cb_cloneindex', 'news_list');
        the_cb_content_setting('cb_cloneindex', 'free_space');
        the_cb_content_setting('cb_cloneindex', 'section_content_free');
        the_cb_content_setting('cb_cloneindex', 'section_title_break');
        the_cb_content_setting('cb_cloneindex', 'section_recruitment');
        the_cb_content_setting('cb_cloneindex', 'marquee_text');
        ?>
      </div><!-- END .contents_builder-clone -->

    </div><!-- END .contents_builder_wrap -->
    <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


  </div><!-- END .tab-content -->

  <?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate($input)
{

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $image_position_type, $marquee_position_type, $font_direction_options;

  $input['index_slider_layout'] = wp_filter_nohtml_kses($input['index_slider_layout']);

  // Background Tag Color 
  $input['tag_bg_color'] = sanitize_hex_color($input['tag_bg_color']);

  // Background Tag Color 
  $input['title_bg_color'] = sanitize_hex_color($input['title_bg_color']);


  // 左側のコンテンツ
  $input['index_slider_catch'] = wp_filter_nohtml_kses($input['index_slider_catch']);
  $input['index_slider_catch_font_type'] = wp_filter_nohtml_kses($input['index_slider_catch_font_type']);
  $input['index_slider_catch_font_size'] = wp_filter_nohtml_kses($input['index_slider_catch_font_size']);
  $input['index_slider_catch_font_size_sp'] = wp_filter_nohtml_kses($input['index_slider_catch_font_size_sp']);
  $input['index_slider_desc'] = wp_kses_post($input['index_slider_desc']);
  $input['index_slider_desc_mobile'] = wp_filter_nohtml_kses($input['index_slider_desc_mobile']);
  $input['index_slider_desc_font_size'] = wp_filter_nohtml_kses($input['index_slider_desc_font_size']);
  $input['index_slider_desc_font_size_sp'] = wp_filter_nohtml_kses($input['index_slider_desc_font_size_sp']);

  // 右側のコンテンツ
  $input['index_header_content_type'] = wp_filter_nohtml_kses($input['index_header_content_type']);
  $input['index_slider_image'] = wp_filter_nohtml_kses($input['index_slider_image']);
  $input['index_slider_image_sp'] = wp_filter_nohtml_kses($input['index_slider_image_sp']);
  $input['index_header_content_video'] = wp_filter_nohtml_kses($input['index_header_content_video']);
  $input['index_header_content_youtube'] = wp_filter_nohtml_kses($input['index_header_content_youtube']);
  $input['index_header_content_overlay_color'] = wp_filter_nohtml_kses($input['index_header_content_overlay_color']);
  $input['index_header_content_overlay_opacity'] = wp_filter_nohtml_kses($input['index_header_content_overlay_opacity']);
  $input['index_header_slide_type'] = wp_filter_nohtml_kses($input['index_header_slide_type']);
  $input['index_header_slide_type'] = wp_filter_nohtml_kses($input['index_header_slide_type']);

  // コンテンツビルダーの代わりに使う固定ページのコンテンツ
  $input['index_content_type'] = wp_filter_nohtml_kses($input['index_content_type']);
  $input['page_content_width'] = wp_filter_nohtml_kses($input['page_content_width']);
  $input['index_header_slide_effect'] = wp_filter_nohtml_kses($input['index_header_slide_effect']);

  // Marquee Text
  $input['index_marquee_position'] = wp_filter_nohtml_kses($input['index_marquee_position']);

  // Tags Text
  $input['tag_font_size'] = wp_filter_nohtml_kses($input['tag_font_size']);
  $input['tag_font_size_sp'] = wp_filter_nohtml_kses($input['tag_font_size_sp']);

  // コンテンツビルダー -----------------------------------------------------------------------------
  if (!empty($input['contents_builder'])) {

    $input_cb = $input['contents_builder'];
    $input['contents_builder'] = array();

    foreach ($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true))
        continue;

      // デザインバナー -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'design_content') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        $value['headline'] = wp_filter_nohtml_kses($value['headline']);
        $value['sub_title'] = wp_filter_nohtml_kses($value['sub_title']);
        $value['desc'] = wp_kses_post($value['desc']);
        $value['desc_mobile'] = wp_kses_post($value['desc_mobile']);
        $value['button_label'] = wp_filter_nohtml_kses($value['button_label']);
        $value['button_url'] = wp_filter_nohtml_kses($value['button_url']);

        for ($i = 1; $i <= 2; $i++):
          $value['item_headline' . $i] = wp_filter_nohtml_kses($value['item_headline' . $i]);
          $value['overlay_color' . $i] = wp_filter_nohtml_kses($value['overlay_color' . $i]);
          $value['item_image' . $i] = wp_filter_nohtml_kses($value['item_image' . $i]);
          $value['item_title' . $i] = wp_filter_nohtml_kses($value['item_title' . $i]);
          $value['item_url' . $i] = wp_filter_nohtml_kses($value['item_url' . $i]);
        endfor;

        // サービス -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'service_list') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        $value['headline'] = wp_filter_nohtml_kses($value['headline']);
        $value['sub_title'] = wp_filter_nohtml_kses($value['sub_title']);
        $value['desc'] = wp_kses_post($value['desc']);
        $value['desc_mobile'] = wp_kses_post($value['desc_mobile']);
        $value['button_label'] = wp_filter_nohtml_kses($value['button_label']);
        $value['category_list'] = !empty($value['category_list']) ? $value['category_list'] : array();
        $value['headline_font_size'] = wp_filter_nohtml_kses($value['headline_font_size']);
        $value['headline_font_size_sp'] = wp_filter_nohtml_kses($value['headline_font_size_sp']);

        // ブログ一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'blog_list') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        $value['headline'] = wp_filter_nohtml_kses($value['headline']);
        $value['sub_title'] = wp_filter_nohtml_kses($value['sub_title']);
        $value['desc'] = wp_kses_post($value['desc']);
        $value['desc_mobile'] = wp_kses_post($value['desc_mobile']);
        $value['button_label'] = wp_filter_nohtml_kses($value['button_label']);
        $value['post_num'] = wp_kses_post($value['post_num']);
        $value['post_num_sp'] = wp_kses_post($value['post_num_sp']);

        $value['post_type'] = wp_kses_post($value['post_type']);
        $value['post_order'] = wp_kses_post($value['post_order']);

        // お知らせ一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'news_list') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        $value['headline'] = wp_filter_nohtml_kses($value['headline']);
        $value['sub_title'] = wp_filter_nohtml_kses($value['sub_title']);
        $value['desc'] = wp_kses_post($value['desc']);
        $value['desc_mobile'] = wp_kses_post($value['desc_mobile']);
        $value['button_label'] = wp_filter_nohtml_kses($value['button_label']);
        $value['post_num'] = wp_kses_post($value['post_num']);
        $value['post_num_sp'] = wp_kses_post($value['post_num_sp']);

        // フリースペース -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        if (!isset($value['free_space'])) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['content_width'] = wp_filter_nohtml_kses($value['content_width']);


        // Content Free -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'section_content_free') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        if (!isset($value['section_content_free'])) {
          $value['section_content_free'] = null;
        } else {
          $value['section_content_free'] = $value['section_content_free'];
        }

        $value['content_width'] = wp_filter_nohtml_kses($value['content_width']);

        // Title Break  -----------------------------------------------------------------------
      }
      elseif ($value['cb_content_select'] == 'section_title_break') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        if (!isset($value['section_title_break'])) {
          $value['section_title_break'] = null;
        } else {
          $value['section_title_break'] = $value['section_title_break'];
        }

        $value['content_width'] = wp_filter_nohtml_kses($value['content_width']);
        // Section Recruitment  -----------------------------------------------------------------------
      }
      elseif ($value['cb_content_select'] == 'section_recruitment') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        if (!isset($value['section_recruitment'])) {
          $value['section_recruitment'] = null;
        } else {
          $value['section_recruitment'] = $value['section_recruitment'];
        }
        
        $value['content_width'] = wp_filter_nohtml_kses($value['content_width']);

        for ($i = 1; $i <= 3; $i++):
          $value['item_title' . $i] = wp_filter_nohtml_kses($value['item_title' . $i]);
          $value['desc' . $i] = wp_filter_nohtml_kses($value['desc' . $i]);
          $value['desc_mobile' . $i] = wp_filter_nohtml_kses($value['desc_mobile' . $i]);
          $value['item_image' . $i] = wp_filter_nohtml_kses($value['item_image' . $i]);
          $value['button_label' . $i] = wp_filter_nohtml_kses($value['button_label' . $i]);
          $value['button_url' . $i] = wp_filter_nohtml_kses($value['button_url' . $i]);
        endfor;
        // Marquee Text -----------------------------------------------------------------------
      } 
      elseif ($value['cb_content_select'] == 'marquee_text') {

        if (!isset($value['show_content']))
          $value['show_content'] = null;
        $value['show_content'] = ($value['show_content'] == 1 ? 1 : 0);

        if (!isset($value['marquee_text'])) {
          $value['marquee_text'] = null;
        } else {
          $value['marquee_text'] = $value['marquee_text'];
        }

        $value['content_width'] = wp_filter_nohtml_kses($value['content_width']);

      }
      

      $input['contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

}
;


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null)
{

  global $blog_label;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html($options['news_label']) : __('News', 'tcd-genesis');
  $service_label = $options['service_label'] ? esc_html($options['service_label']) : __('Service', 'tcd-genesis');

  $cb_content_select = array(
    'design_content' => __('Design banner', 'tcd-genesis'),
    'service_list' => sprintf(__('%s list', 'tcd-genesis'), $service_label),
    'blog_list' => sprintf(__('%s list', 'tcd-genesis'), $blog_label),
    'news_list' => sprintf(__('%s list', 'tcd-genesis'), $news_label),
    'free_space' => __('Free space', 'tcd-genesis'),
    'section_content_free' => __('Content Free', 'tcd-genesis'),
    'section_title_break' => __('Title Break', 'tcd-genesis'),
    'section_recruitment' => __('Recruitment', 'tcd-genesis'),
    'marquee_text' => __('Marquee Text', 'tcd-genesis'),
  );

  if ($selected && isset($cb_content_select[$selected])) {
    $add_class = ' hidden';
  } else {
    $add_class = '';
  }

  $out = '<select name="dp_options[contents_builder][' . esc_attr($cb_index) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
  $out .= '<option value="" style="padding-right: 10px;">' . __("Choose the content", "tcd-genesis") . '</option>';

  foreach ($cb_content_select as $key => $value) {
    $attr = '';
    if ($key == $selected) {
      $attr = ' selected="selected"';
    }
    $out .= '<option value="' . esc_attr($key) . '"' . $attr . ' style="padding-right: 10px;">' . esc_html($value) . '</option>';
  }

  $out .= '</select>';

  echo $out;

}


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array())
{

  global $blog_label, $font_type_options, $image_position_type, $marquee_position_type, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $post;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html($options['news_label']) : __('News', 'tcd-genesis');
  $service_label = $options['service_label'] ? esc_html($options['service_label']) : __('Service', 'tcd-genesis');

  ?>

  <div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

    <?php
    // デザインバナー　-------------------------------------------------------------
    if ($cb_content_select == 'design_content') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['headline'])) {
        $value['headline'] = '';
      }
      if (!isset($value['sub_title'])) {
        $value['sub_title'] = '';
      }
      if (!isset($value['desc'])) {
        $value['desc'] = '';
      }
      if (!isset($value['desc_mobile'])) {
        $value['desc_mobile'] = '';
      }
      if (!isset($value['button_label'])) {
        $value['button_label'] = '';
      }
      if (!isset($value['button_url'])) {
        $value['button_url'] = '';
      }

      for ($i = 1; $i <= 2; $i++):
        if (!isset($value['item_headline' . $i])) {
          $value['item_headline' . $i] = '';
        }
        if (!isset($value['overlay_color' . $i])) {
          $value['overlay_color' . $i] = '#000000';
        }
        if (!isset($value['item_image' . $i])) {
          $value['item_image' . $i] = '';
        }
        if (!isset($value['item_title' . $i])) {
          $value['item_title' . $i] = '';
        }
        if (!isset($value['item_url' . $i])) {
          $value['item_url' . $i] = '';
        }
      endfor;
      ?>

      <h3 class="cb_content_headline">
        <?php _e('Design banner', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
      </h3>
      <label class="cb_content_switch">
        <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
            type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
              class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
      </label>
      <div class="cb_content tab_parent">

        <div class="cb_content_switch_target">

          <div class="cb_image">
            <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_design_content.jpg?3.0" width="" height="" />
          </div>

          <h4 class="theme_option_headline2">
            <?php _e('Basic settings', 'tcd-genesis'); ?>
          </h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><span class="num">1</span>
                <?php _e('Headline', 'tcd-genesis'); ?>
              </span><input type="text" class="cb-repeater-label full_width"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline]"
                value="<?php echo esc_attr($value['headline']); ?>" /></li>
            <li class="cf"><span class="label"><span class="num">2</span>
                <?php _e('Subheading', 'tcd-genesis'); ?>
              </span><input type="text" class="full_width"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
                value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
            <li class="cf"><span class="label"><span class="num">3</span>
                <?php _e('Description', 'tcd-genesis'); ?>
              </span><textarea class="full_width" cols="50" rows="3"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
            </li>
            <li class="cf"><span class="label"><span class="num">3</span>
                <?php _e('Description (mobile)', 'tcd-genesis'); ?>
              </span><textarea
                placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                class="full_width" cols="50" rows="3"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile]"><?php echo esc_textarea($value['desc_mobile']); ?></textarea>
            </li>
            <li class="cf"><span class="label"><span class="num">4</span>
                <?php _e('Link button label', 'tcd-genesis'); ?>
              </span><input type="text" class="full_width"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label]"
                value="<?php echo esc_attr($value['button_label']); ?>" /></li>
            <li class="cf"><span class="label"><span class="num">4</span>
                <?php _e('Link button url', 'tcd-genesis'); ?>
              </span><input type="text" class="full_width"
                name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_url]"
                value="<?php echo esc_attr($value['button_url']); ?>" /></li>
          </ul>

          <h4 class="theme_option_headline_number"><span class="num">5</span>
            <?php _e('Banner', 'tcd-genesis'); ?>
          </h4>
          <div class="sub_box_tab">
            <div class="tab active" data-tab="tab1">
              <?php _e('Left banner', 'tcd-genesis'); ?>
            </div>
            <div class="tab" data-tab="tab2">
              <?php _e('Right banner', 'tcd-genesis'); ?>
            </div>
          </div>

          <?php for ($i = 1; $i <= 2; $i++): ?>
            <div class="sub_box_tab_content<?php if ($i == 1) {
              echo ' active';
            }
            ; ?>" data-tab-content="tab<?php echo $i; ?>">

              <ul class="option_list">
                <li class="cf"><span class="label">
                    <?php _e('Headline', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_headline<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['item_headline' . $i]); ?>" /></li>
                <li class="cf">
                  <span class="label">
                    <?php _e('Background image', 'tcd-genesis'); ?>
                    <span class="recommend_desc">
                      <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '623', '450'); ?>
                    </span>
                  </span>
                  <div class="image_box cf">
                    <div class="cf cf_media_field hide-if-no-js dc_bg_image_<?php echo $cb_index; ?>_<?php echo $i; ?>">
                      <input type="hidden" value="<?php echo esc_attr($value['item_image' . $i]); ?>"
                        id="dc_bg_image_<?php echo $cb_index; ?>_<?php echo $i; ?>"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_image<?php echo $i; ?>]"
                        class="cf_media_id">
                      <div class="preview_field">
                        <?php if ($value['item_image' . $i]) {
                          echo wp_get_attachment_image($value['item_image' . $i], 'medium');
                        }
                        ; ?>
                      </div>
                      <div class="buttton_area">
                        <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>"
                          class="cfmf-select-img button">
                        <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if (!$value['item_image' . $i]) {
                             echo 'hidden';
                           }
                           ; ?>">
                      </div>
                    </div>
                  </div>
                </li>
                <li class="cf"><span class="label">
                    <?php _e('Color of overlay', 'tcd-genesis'); ?>
                  </span><input type="text"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][overlay_color<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['overlay_color' . $i]); ?>" data-default-color="#000000"
                    class="c-color-picker"></li>
                <li class="cf"><span class="label">
                    <?php _e('Link label', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_title<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['item_title' . $i]); ?>" /></li>
                <li class="cf"><span class="label">
                    <?php _e('Link URL', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_url<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['item_url' . $i]); ?>" /></li>
              </ul>

            </div><!-- END .sub_box_tab_content -->
          <?php endfor; ?>

        </div><!-- END .cb_content_switch_target -->

        <?php


      // Section Content Free　-------------------------------------------------------------
    } else if ($cb_content_select == 'section_content_free') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['show_tags'])) {
        $value['show_tags'] = 1;
      }
      if (!isset($value['animation_trigger'])) {
        $value['animation_trigger'] = 1;
      }
      if (!isset($value['position_of_image'])) {
        $value['position_of_image'] = 1;
      }
      if (!isset($value['super_headline'])) {
        $value['super_headline'] = '';
      }
      if (!isset($value['headline1'])) {
        $value['headline1'] = '';
      }
      if (!isset($value['headline2'])) {
        $value['headline2'] = '';
      }
      if (!isset($value['sub_title'])) {
        $value['sub_title'] = '';
      }
      if (!isset($value['desc'])) {
        $value['desc'] = '';
      }
      if (!isset($value['desc_mobile'])) {
        $value['desc_mobile'] = '';
      }
      if (!isset($value['button_label'])) {
        $value['button_label'] = '';
      }
      if (!isset($value['button_url'])) {
        $value['button_url'] = '';
      }
      if (!isset($value['item_image1'])) {
        $value['item_image1'] = '';
      }
      if (!isset($value['tag1'])) {
        $value['tag1'] = '';
      }
      if (!isset($value['tag2'])) {
        $value['tag2'] = '';
      }
      if (!isset($value['tag3'])) {
        $value['tag3'] = '';
      }
      if (!isset($value['tag4'])) {
        $value['tag4'] = '';
      }
     


      ?>

          <h3 class="cb_content_headline">
          <?php _e('Content Free', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
          </h3>
          <label class="cb_content_switch">
            <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                  class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
          </label>
          <div class="cb_content tab_parent">

            <div class="cb_content_switch_target">

              <h4 class="theme_option_headline2">
              <?php _e('Basic settings', 'tcd-genesis'); ?>
              </h4>
              <ul class="option_list">
                <li class="cf"><span class="label">
                  <?php _e('Super Headline', 'tcd-genesis'); ?>
                  </span><input type="text" class="cb-repeater-label full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][super_headline]"
                    value="<?php echo esc_attr($value['super_headline']); ?>" /></li>
                <li class="cf"><span class="label">
                  <?php _e('Headline Word 1', 'tcd-genesis'); ?>
                  </span><input type="text" class="cb-repeater-label full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline1]"
                    value="<?php echo esc_attr($value['headline1']); ?>" /></li>
                <li class="cf"><span class="label">
                  <?php _e('Headline Word 2', 'tcd-genesis'); ?>
                  </span><input type="text" class="cb-repeater-label full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline2]"
                    value="<?php echo esc_attr($value['headline2']); ?>" /></li>    
                <li class="cf"><span class="label">
                  <?php _e('Subheading', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
                    value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
                <li class="cf"><span class="label">
                  <?php _e('Description', 'tcd-genesis'); ?>
                  </span><textarea class="full_width" cols="50" rows="3"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
                </li>
                <li class="cf"><span class="label">
                  <?php _e('Description (mobile)', 'tcd-genesis'); ?>
                  </span><textarea
                    placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                    class="full_width" cols="50" rows="3"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile]"><?php echo esc_textarea($value['desc_mobile']); ?></textarea>
                </li>
                <li class="cf"><span class="label">
                  <?php _e('Link button label', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label]"
                    value="<?php echo esc_attr($value['button_label']); ?>" /></li>
                <li class="cf"><span class="label">
                  <?php _e('Link button url', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_url]"
                    value="<?php echo esc_attr($value['button_url']); ?>" /></li>
              
              </ul>

              <h4 class="theme_option_headline_number">
              <?php _e('Image', 'tcd-genesis'); ?>
              </h4>
              <div>
                <ul class="option_list">
                  <li class="cf">
                    <span class="label">
                    <?php _e('Image', 'tcd-genesis'); ?>
                    </span>
                    <div class="image_box cf">
                      <div class="cf cf_media_field hide-if-no-js dc_bg_image_<?php echo $cb_index; ?>">
                        <input type="hidden" value="<?php echo esc_attr($value['item_image1']); ?>"
                          id="dc_bg_image_<?php echo $cb_index; ?>"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_image1]" class="cf_media_id">
                        <div class="preview_field">
                        <?php if ($value['item_image1']) {
                          echo wp_get_attachment_image($value['item_image1'], 'medium');
                        }
                        ; ?>
                        </div>
                        <div class="buttton_area">
                          <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>"
                            class="cfmf-select-img button">
                          <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if (!$value['item_image1']) {
                               echo 'hidden';
                             }
                             ; ?>">
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                  
              </div>
                 <label class="custom_content_switch">
                      <h4>Image Position</h4> &nbsp;&nbsp;&nbsp;&nbsp;
                      <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][position_of_image]"
                          type="checkbox" value="1" <?php checked($value['position_of_image'], 1); ?>>
                          <span class="label"><span class="on">Right</span><span class="sep"></span><span class="off">Left</span></span>
                      </div>
                  </label>
                 <label class="custom_content_switch">
                    <h4>Animation of the Background</h4> &nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][animation_trigger]"
                        type="checkbox" value="1" <?php checked($value['animation_trigger'], 1); ?>>
                        <span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span>
                    </div>
                 </label>  
                <label class="custom_content_switch">
                    <h4>Tags Visibility</h4> &nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_tags]"
                        type="checkbox" value="1" <?php checked($value['show_tags'], 1); ?>>
                        <span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span>
                    </div>
                 </label>
               
                 <div class="custom_content tab_parent">
                    <div class="custom_content_switch_target">
                      <ul class="option_list">
                        <li class="cf"><span class="label">
                          <?php _e('Tags Background Color', 'tcd-genesis'); ?>
                          </span><?php echo tcd_color_option($options, 'tag_bg_color', 'js-color-preset-target--tag_bg_color'); ?>
                        </li>
                         <li class="cf"><span class="label">
                              <?php _e('Font size', 'tcd-genesis'); ?>
                            </span>
                            <?php echo tcd_font_size_option($options, 'tag_font_size'); ?>
                          </li>
                        <li class="cf"><span class="label">
                          <?php _e('Tag text 1', 'tcd-genesis'); ?>
                          </span><input type="text" class="cb-repeater-label full_width"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][tag1]"
                            value="<?php echo esc_attr($value['tag1']); ?>" />
                        </li>
                        <li class="cf"><span class="label">
                          <?php _e('Tag text 2', 'tcd-genesis'); ?>
                          </span><input type="text" class="cb-repeater-label full_width"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][tag2]"
                            value="<?php echo esc_attr($value['tag2']); ?>" />
                        </li>
                        <li class="cf"><span class="label">
                          <?php _e('Tag text 3', 'tcd-genesis'); ?>
                          </span><input type="text" class="cb-repeater-label full_width"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][tag3]"
                            value="<?php echo esc_attr($value['tag3']); ?>" />
                        </li>
                        <li class="cf"><span class="label">
                          <?php _e('Tag text 4', 'tcd-genesis'); ?>
                          </span><input type="text" class="cb-repeater-label full_width"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][tag4]"
                            value="<?php echo esc_attr($value['tag4']); ?>" />
                        </li>
                      </ul>  
                    </div>  
                 </div> 
            </div><!-- END .cb_content_switch_target -->
            <?php


// Section Recruitment Free　-------------------------------------------------------------
} else if ($cb_content_select == 'section_recruitment') {

if (!isset($value['show_content'])) {
  $value['show_content'] = 1;
}
if (!isset($value['super_headline'])) {
  $value['super_headline'] = '';
}

for ($i = 1; $i <= 3; $i++):
  if (!isset($value['item_title' . $i])) {
    $value['item_title' . $i] = '';
  }
  if (!isset($value['desc' . $i])) {
    $value['desc' . $i] = '';
  }
  if (!isset($value['desc_mobile' . $i])) {
    $value['desc_mobile' . $i] = '';
  }
  if (!isset($value['button_label' . $i])) {
    $value['button_label' . $i] = '';
  }
  if (!isset($value['button_url' . $i])) {
    $value['button_url' . $i] = '';
  }
  if (!isset($value['item_image' . $i])) {
    $value['item_image' . $i] = '';
  }
endfor;

?>

    <h3 class="cb_content_headline">
    <?php _e('Recruitment ', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
    </h3>
    <label class="cb_content_switch">
      <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
          type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
            class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
    </label>
    <div class="cb_content tab_parent">

      <div class="cb_content_switch_target">

        <h4 class="theme_option_headline2">
        <?php _e('Basic settings', 'tcd-genesis'); ?>
        </h4>
        <ul class="option_list">
          <li class="cf"><span class="label">
            <?php _e('Super Headline', 'tcd-genesis'); ?>
            </span><input type="text" class="cb-repeater-label full_width"
              name="dp_options[contents_builder][<?php echo $cb_index; ?>][super_headline]"
              value="<?php echo esc_attr($value['super_headline']); ?>" /></li>
        </ul>

        <h4 class="theme_option_headline_number">
          <?php _e('Image', 'tcd-genesis'); ?>
        </h4>
        <div class="sub_box_tab">
            <div class="tab active" data-tab="tab1">
              <?php _e('Opportunity 1', 'tcd-genesis'); ?>
            </div>
            <div class="tab" data-tab="tab2">
              <?php _e('Opportunity 2', 'tcd-genesis'); ?>
            </div>
            <div class="tab" data-tab="tab3">
              <?php _e('Explore tab', 'tcd-genesis'); ?>
            </div>
          </div>

          <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="sub_box_tab_content<?php if ($i == 1) {
              echo ' active';
            }
            ; ?>" data-tab-content="tab<?php echo $i; ?>">

              <ul class="option_list">
                <li class="cf"><span class="label">
                    <?php _e('Opportunity Title', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_title<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['item_title' . $i]); ?>" /></li>
                <li class="cf">
                  <span class="label">
                    <?php _e('Image', 'tcd-genesis'); ?>
                    <span class="recommend_desc">
                      <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '420', '240'); ?>
                    </span>
                  </span>
                  <div class="image_box cf">
                    <div class="cf cf_media_field hide-if-no-js dc_bg_image_<?php echo $cb_index; ?>_<?php echo $i; ?>">
                      <input type="hidden" value="<?php echo esc_attr($value['item_image' . $i]); ?>"
                        id="dc_bg_image_<?php echo $cb_index; ?>_<?php echo $i; ?>"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_image<?php echo $i; ?>]"
                        class="cf_media_id">
                      <div class="preview_field">
                        <?php if ($value['item_image' . $i]) {
                          echo wp_get_attachment_image($value['item_image' . $i], 'medium');
                        }
                        ; ?>
                      </div>
                      <div class="buttton_area">
                        <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>"
                          class="cfmf-select-img button">
                        <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if (!$value['item_image' . $i]) {
                             echo 'hidden';
                           }
                           ; ?>">
                      </div>
                    </div>
                  </div>
                </li> 
                <li class="cf"><span class="label">
                    <?php _e('Description', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['desc' . $i]); ?>" /></li>
                <li class="cf"><span class="label">
                    <?php _e('Description Mobile', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['desc_mobile' . $i]); ?>" /></li>
                <li class="cf"><span class="label">
                    <?php _e('Button label', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['button_label' . $i]); ?>" /></li>
                <li class="cf"><span class="label">
                    <?php _e('Button URL', 'tcd-genesis'); ?>
                  </span><input type="text" class="full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_url<?php echo $i; ?>]"
                    value="<?php echo esc_attr($value['button_url' . $i]); ?>" /></li>
              </ul>

            </div><!-- END .sub_box_tab_content -->
          <?php endfor; ?>

      </div><!-- END .cb_content_switch_target -->

            <?php


// Sectio Title Break　-------------------------------------------------------------
} else if ($cb_content_select == 'section_title_break') {

if (!isset($value['show_content'])) {
  $value['show_content'] = 1;
}
if (!isset($value['position_of_image'])) {
  $value['position_of_image'] = 1;
}
if (!isset($value['headline1'])) {
  $value['headline1'] = '';
}
if (!isset($value['sub_title'])) {
  $value['sub_title'] = '';
}

if (!isset($value['item_image1'])) {
  $value['item_image1'] = '';
}

?>

    <h3 class="cb_content_headline">
    <?php _e('Title Break', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
    </h3>
    <label class="cb_content_switch">
      <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
          type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
            class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
    </label>
    <div class="cb_content tab_parent">

      <div class="cb_content_switch_target">

        <h4 class="theme_option_headline2">
        <?php _e('Basic settings', 'tcd-genesis'); ?>
        </h4>
        <ul class="option_list">
          <li class="cf"><span class="label">
            <?php _e('Headline', 'tcd-genesis'); ?>
            </span><input type="text" class="cb-repeater-label full_width"
              name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline1]"
              value="<?php echo esc_attr($value['headline1']); ?>" /></li>    
          <li class="cf"><span class="label">
            <?php _e('Subheading', 'tcd-genesis'); ?>
            </span><input type="text" class="full_width"
              name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
              value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
        </ul>

        <h4 class="theme_option_headline_number">
        <?php _e('Image', 'tcd-genesis'); ?>
        </h4>
        <div>
          <ul class="option_list">
            <li class="cf">
              <span class="label">
              <?php _e('Title Image', 'tcd-genesis'); ?>
                <span class="recommend_desc">
                <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-genesis'), '570', '360'); ?>
                </span>
              </span>
              <div class="image_box cf">
                <div class="cf cf_media_field hide-if-no-js dc_bg_image_<?php echo $cb_index; ?>">
                  <input type="hidden" value="<?php echo esc_attr($value['item_image1']); ?>"
                    id="dc_bg_image_<?php echo $cb_index; ?>"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][item_image1]" class="cf_media_id">
                  <div class="preview_field">
                  <?php if ($value['item_image1']) {
                    echo wp_get_attachment_image($value['item_image1'], 'medium');
                  }
                  ; ?>
                  </div>
                  <div class="buttton_area">
                    <input type="button" value="<?php _e('Select Image', 'tcd-genesis'); ?>"
                      class="cfmf-select-img button">
                    <input type="button" value="<?php _e('Remove Image', 'tcd-genesis'); ?>" class="cfmf-delete-img button <?php if (!$value['item_image1']) {
                         echo 'hidden';
                       }
                       ; ?>">
                  </div>
                </div>
              </div>
            </li>
          </ul>   
        </div>
          <div class="custom_content tab_parent">
                      <div class="custom_content_switch_target">
                        <ul class="option_list">
                          <li class="cf"><span class="label">
                            <?php _e('Headline Text Color', 'tcd-genesis'); ?>
                            </span><?php echo tcd_color_option($options, 'title_headline_color', 'js-color-preset-target--title_headline_color'); ?>
                          </li>
                        </ul>
                      </div>    
            </div>   
          <div class="custom_content tab_parent">
                      <div class="custom_content_switch_target">
                        <ul class="option_list">
                          <li class="cf"><span class="label">
                            <?php _e('Sub Headline Text Color', 'tcd-genesis'); ?>
                            </span><?php echo tcd_color_option($options, 'title_sub_headline_color', 'js-color-preset-target--title_sub_headline_color'); ?>
                          </li>
                        </ul>
                      </div>    
            </div>   
           <div class="custom_content tab_parent">
                    <div class="custom_content_switch_target">
                      <ul class="option_list">
                        <li class="cf"><span class="label">
                          <?php _e('Title Section Background Color', 'tcd-genesis'); ?>
                          </span><?php echo tcd_color_option($options, 'title_bg_color', 'js-color-preset-target--title_bg_color'); ?>
                        </li>
                      </ul>
                    </div>    
           </div>    
           <label class="custom_content_switch">
                <h4>Title Section Image Position</h4> &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][position_of_image]"
                    type="checkbox" value="1" <?php checked($value['position_of_image'], 1); ?>>
                    <span class="label"><span class="on">Right</span><span class="sep"></span><span class="off">Left</span></span>
                </div>
            </label>
      </div><!-- END .cb_content_switch_target -->


    <?php


      // Marquee Text　-------------------------------------------------------------
    } else if ($cb_content_select == 'marquee_text') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['text_marquee'])) {
        $value['text_marquee'] = '';
      }
      ?>

          <h3 class="cb_content_headline">
          <?php _e('Marquee Text', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
          </h3>
          <label class="cb_content_switch">
            <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                  class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
          </label>
          <div class="cb_content tab_parent">

            <div class="cb_content_switch_target">

              <h4 class="theme_option_headline2">
              <?php _e('Basic settings', 'tcd-genesis'); ?>
              </h4>
              <ul class="option_list">
                <li class="cf"><span class="label">
                  <?php _e('Text Information', 'tcd-genesis'); ?>
                  </span><input type="text" class="cb-repeater-label full_width"
                    name="dp_options[contents_builder][<?php echo $cb_index; ?>][text_marquee]"
                    value="<?php echo esc_attr($value['text_marquee']); ?>" /></li>
                <li class="cf"><span class="label">
                  <?php _e('', 'tcd-genesis'); ?>
                  </span>
                  <?php echo tcd_basic_radio_button($options, 'index_marquee_position', $marquee_position_type); ?>
                  
                </li>    
              </ul>

            </div><!-- END .cb_content_switch_target -->
        
          <?php
      // サービス　-------------------------------------------------------------
    } elseif ($cb_content_select == 'service_list') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['headline'])) {
        $value['headline'] = '';
      }
      if (!isset($value['sub_title'])) {
        $value['sub_title'] = '';
      }
      if (!isset($value['desc'])) {
        $value['desc'] = '';
      }
      if (!isset($value['desc_mobile'])) {
        $value['desc_mobile'] = '';
      }
      if (!isset($value['button_label'])) {
        $value['button_label'] = '';
      }
      if (!isset($value['category_list'])) {
        $value['category_list'] = array();
      }
      if (!isset($value['headline_font_size'])) {
        $value['headline_font_size'] = '50';
      }
      if (!isset($value['headline_font_size_sp'])) {
        $value['headline_font_size_sp'] = '30';
      }

      ?>

            <h3 class="cb_content_headline">
            <?php printf(__('%s list', 'tcd-genesis'), $service_label); ?><span
                class="cb_content_headline_sub_title"></span>
            </h3>
            <label class="cb_content_switch">
              <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                  type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                    class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
            </label>
            <div class="cb_content tab_parent">

              <div class="cb_content_switch_target">

                <div class="cb_image">
                  <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_service_list.jpg?3.0" width="" height="" />
                </div>

                <h4 class="theme_option_headline2">
                <?php _e('Basic settings', 'tcd-genesis'); ?>
                </h4>
                <ul class="option_list">
                  <li class="cf"><span class="label"><span class="num">1</span>
                    <?php _e('Headline', 'tcd-genesis'); ?>
                    </span><input type="text" class="cb-repeater-label full_width"
                      name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline]"
                      value="<?php echo esc_attr($value['headline']); ?>" /></li>
                  <li class="cf"><span class="label"><span class="num">2</span>
                    <?php _e('Subheading', 'tcd-genesis'); ?>
                    </span><input type="text" class="full_width"
                      name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
                      value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
                  <li class="cf"><span class="label"><span class="num">3</span>
                    <?php _e('Description', 'tcd-genesis'); ?>
                    </span><textarea class="full_width" cols="50" rows="3"
                      name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
                  </li>
                  <li class="cf"><span class="label"><span class="num">3</span>
                    <?php _e('Description (mobile)', 'tcd-genesis'); ?>
                    </span><textarea
                      placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                      class="full_width" cols="50" rows="3"
                      name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile]"><?php echo esc_textarea($value['desc_mobile']); ?></textarea>
                  </li>
                  <li class="cf"><span class="label"><span class="num">4</span>
                    <?php _e('Link button label', 'tcd-genesis'); ?>
                    </span><input type="text" class="full_width"
                      name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label]"
                      value="<?php echo esc_attr($value['button_label']); ?>" /></li>
                  <li class="cf">
                    <span class="label"><span class="num">5</span>
                    <?php _e('Font size of category headline', 'tcd-genesis'); ?>
                    </span>
                    <div class="font_size_option">
                      <label class="font_size_label number_option">
                        <input class="hankaku input_font_size" type="number"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline_font_size]"
                          value="<?php echo esc_attr($value['headline_font_size']); ?>" />
                        <span class="icon icon_pc"></span>
                      </label>
                      <label class="font_size_label number_option">
                        <input class="hankaku input_font_size" type="number"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline_font_size_sp]"
                          value="<?php echo esc_attr($value['headline_font_size_sp']); ?>" />
                        <span class="icon icon_sp"></span>
                      </label>
                    </div>
                  </li>
                </ul>

                <div class="theme_option_message2">
                  <p>
                  <?php printf(__('If you want to display a button for each %s article when hovering over a category,<br>Go to "TCD Theme option > %s > Archive page" and set the "Display Format" to "Type2".', 'tcd-genesis'), $service_label, $service_label); ?>
                  </p>
                </div>

                <h4 class="theme_option_headline2">
                <?php _e('Category', 'tcd-genesis'); ?>
                </h4>
                <input type="hidden" name="dp_options[contents_builder][<?php echo $cb_index; ?>][category_list]" value="">
                <?php
                $category_list = get_terms('service_category', array('hide_empty' => true));
                if ($category_list && !is_wp_error($category_list)) {
                  ?>
                  <div class="theme_option_message2">
                    <p>
                    <?php printf(__('Please select %s category to display in front page.<br>Category will not be displayed when article is not registered.', 'tcd-genesis'), $service_label); ?>
                    </p>
                  </div>
                  <ul class="tag_check_list">
                    <?php
                    foreach ($category_list as $cat):
                      $cat_id = $cat->term_id;
                      $cat_name = $cat->name;
                      ?>
                      <li>
                        <label>
                          <input name="dp_options[contents_builder][<?php echo $cb_index; ?>][category_list][]" type="checkbox"
                            value="<?php echo esc_attr($cat_id); ?>" <?php checked(in_array($cat_id, $value['category_list']), true); ?> />
                          <span>
                          <?php echo esc_html($cat_name); ?>
                          </span>
                        </label>
                      </li>
                  <?php endforeach; ?>
                  </ul>
              <?php } else { ?>
                  <div class="theme_option_message2">
                    <p>
                    <?php printf(__('Please register %s category before using this option.', 'tcd-genesis'), $service_label); ?>
                    </p>
                  </div>
              <?php }
                ; ?>

              </div><!-- END .cb_content_switch_target -->


            <?php
      // ブログ一覧　-------------------------------------------------------------
    } elseif ($cb_content_select == 'blog_list') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['headline'])) {
        $value['headline'] = '';
      }
      if (!isset($value['sub_title'])) {
        $value['sub_title'] = '';
      }
      if (!isset($value['desc'])) {
        $value['desc'] = '';
      }
      if (!isset($value['desc_mobile'])) {
        $value['desc_mobile'] = '';
      }
      if (!isset($value['button_label'])) {
        $value['button_label'] = '';
      }
      if (!isset($value['post_num'])) {
        $value['post_num'] = '10';
      }
      if (!isset($value['post_num_sp'])) {
        $value['post_num_sp'] = '5';
      }

      if (!isset($value['post_type'])) {
        $value['post_type'] = 'recent_post';
      }
      if (!isset($value['post_order'])) {
        $value['post_order'] = 'date';
      }

      ?>

              <h3 class="cb_content_headline">
              <?php printf(__('%s list', 'tcd-genesis'), $blog_label); ?><span class="cb_content_headline_sub_title"></span>
              </h3>
              <label class="cb_content_switch">
                <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                    type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                      class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
              </label>
              <div class="cb_content">

                <div class="cb_content_switch_target">

                  <div class="cb_image">
                    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_blog_list.jpg?2.0" width="" height="" />
                  </div>

                  <h4 class="theme_option_headline2">
                  <?php _e('Basic settings', 'tcd-genesis'); ?>
                  </h4>
                  <ul class="option_list">
                    <li class="cf"><span class="label"><span class="num">1</span>
                      <?php _e('Headline', 'tcd-genesis'); ?>
                      </span><input type="text" class="cb-repeater-label full_width"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline]"
                        value="<?php echo esc_attr($value['headline']); ?>" /></li>
                    <li class="cf"><span class="label"><span class="num">2</span>
                      <?php _e('Subheading', 'tcd-genesis'); ?>
                      </span><input type="text" class="full_width"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
                        value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
                    <li class="cf"><span class="label"><span class="num">3</span>
                      <?php _e('Description', 'tcd-genesis'); ?>
                      </span><textarea class="full_width" cols="50" rows="3"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
                    </li>
                    <li class="cf"><span class="label"><span class="num">3</span>
                      <?php _e('Description (mobile)', 'tcd-genesis'); ?>
                      </span><textarea
                        placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                        class="full_width" cols="50" rows="3"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile]"><?php echo esc_textarea($value['desc_mobile']); ?></textarea>
                    </li>
                    <li class="cf"><span class="label"><span class="num">4</span>
                      <?php _e('Link button label', 'tcd-genesis'); ?>
                      </span><input type="text" class="full_width"
                        name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label]"
                        value="<?php echo esc_attr($value['button_label']); ?>" /></li>
                    <li class="cf">
                      <span class="label">
                      <?php _e('Post type', 'tcd-genesis'); ?>
                      </span>
                      <div class="standard_radio_button">
                        <input id="carousel_post_type_recent_post_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_type]" value="recent_post" <?php checked($value['post_type'], 'recent_post'); ?>>
                        <label for="carousel_post_type_recent_post_<?php echo $cb_index; ?>">
                        <?php _e('Recent post', 'tcd-genesis'); ?>
                        </label>
                        <input id="carousel_post_type_recommend_post_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_type]" value="recommend_post"
                        <?php checked($value['post_type'], 'recommend_post'); ?>>
                        <label for="carousel_post_type_recommend_post_<?php echo $cb_index; ?>">
                        <?php _e('Recommend post', 'tcd-genesis'); ?>
                        </label>
                        <input id="carousel_post_type_recommend2_post_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_type]" value="recommend_post2"
                        <?php checked($value['post_type'], 'recommend_post2'); ?>>
                        <label for="carousel_post_type_recommend2_post_<?php echo $cb_index; ?>">
                        <?php _e('Recommend post', 'tcd-genesis'); ?>2
                        </label>
                        <input id="carousel_post_type_recommend3_post_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_type]" value="recommend_post3"
                        <?php checked($value['post_type'], 'recommend_post3'); ?>>
                        <label for="carousel_post_type_recommend3_post_<?php echo $cb_index; ?>">
                        <?php _e('Recommend post', 'tcd-genesis'); ?>3
                        </label>
                      </div>
                    </li>
                    <li class="cf">
                      <span class="label">
                      <?php _e('Post order', 'tcd-genesis'); ?>
                      </span>
                      <div class="standard_radio_button">
                        <input id="carousel_post_order_date_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_order]" value="date" <?php checked($value['post_order'], 'date'); ?>>
                        <label for="carousel_post_order_date_<?php echo $cb_index; ?>">
                        <?php _e('Date', 'tcd-genesis'); ?>
                        </label>
                        <input id="carousel_post_order_rand_<?php echo $cb_index; ?>" type="radio"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_order]" value="rand" <?php checked($value['post_order'], 'rand'); ?>>
                        <label for="carousel_post_order_rand_<?php echo $cb_index; ?>">
                        <?php _e('Random', 'tcd-genesis'); ?>
                        </label>
                      </div>
                    </li>
                    <li class="cf">
                      <span class="label">
                      <?php _e('Number of post to display', 'tcd-genesis'); ?>
                      </span>
                      <div class="display_post_num_option">
                        <label for="cb_post_list_post_num_<?php echo $cb_index; ?>"><input type="number"
                            id="cb_post_list_post_num_<?php echo $cb_index; ?>"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_num]"
                            value="<?php echo esc_attr($value['post_num']); ?>"><span class="icon icon_pc"></span></label>
                        <label for="cb_post_list_post_num_sp_<?php echo $cb_index; ?>"><input type="number"
                            id="cb_post_list_post_num_sp_<?php echo $cb_index; ?>"
                            name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_num_sp]"
                            value="<?php echo esc_attr($value['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
                      </div>
                    </li>
                  </ul>

                </div><!-- END .cb_content_switch_target -->

              <?php
      // お知らせ一覧　-------------------------------------------------------------
    } elseif ($cb_content_select == 'news_list') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['headline'])) {
        $value['headline'] = '';
      }
      if (!isset($value['sub_title'])) {
        $value['sub_title'] = '';
      }
      if (!isset($value['desc'])) {
        $value['desc'] = '';
      }
      if (!isset($value['desc_mobile'])) {
        $value['desc_mobile'] = '';
      }
      if (!isset($value['button_label'])) {
        $value['button_label'] = '';
      }
      if (!isset($value['post_num'])) {
        $value['post_num'] = '10';
      }
      if (!isset($value['post_num_sp'])) {
        $value['post_num_sp'] = '5';
      }

      ?>

                <h3 class="cb_content_headline">
                <?php printf(__('%s list', 'tcd-genesis'), $news_label); ?><span
                    class="cb_content_headline_sub_title"></span>
                </h3>
                <label class="cb_content_switch">
                  <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                      type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                        class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
                </label>
                <div class="cb_content">

                  <div class="cb_content_switch_target">

                    <div class="cb_image">
                      <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_news_list.jpg?2.0" width="" height="" />
                    </div>

                    <div class="theme_option_message2">
                      <p>
                      <?php _e('Category sort button will automatically display when there is more than two categories registered.', 'tcd-genesis'); ?>
                      </p>
                    </div>

                    <h4 class="theme_option_headline2">
                    <?php _e('Basic settings', 'tcd-genesis'); ?>
                    </h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><span class="num">1</span>
                        <?php _e('Headline', 'tcd-genesis'); ?>
                        </span><input type="text" class="cb-repeater-label full_width"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][headline]"
                          value="<?php echo esc_attr($value['headline']); ?>" /></li>
                      <li class="cf"><span class="label"><span class="num">2</span>
                        <?php _e('Subheading', 'tcd-genesis'); ?>
                        </span><input type="text" class="full_width"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][sub_title]"
                          value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
                      <li class="cf"><span class="label"><span class="num">3</span>
                        <?php _e('Description', 'tcd-genesis'); ?>
                        </span><textarea class="full_width" cols="50" rows="3"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
                      </li>
                      <li class="cf"><span class="label"><span class="num">3</span>
                        <?php _e('Description (mobile)', 'tcd-genesis'); ?>
                        </span><textarea
                          placeholder="<?php _e('Please indicate if you would like to display a short text for mobile sizes.', 'tcd-genesis'); ?>"
                          class="full_width" cols="50" rows="3"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][desc_mobile]"><?php echo esc_textarea($value['desc_mobile']); ?></textarea>
                      </li>
                      <li class="cf"><span class="label"><span class="num">4</span>
                        <?php _e('Link button label', 'tcd-genesis'); ?>
                        </span><input type="text" class="full_width"
                          name="dp_options[contents_builder][<?php echo $cb_index; ?>][button_label]"
                          value="<?php echo esc_attr($value['button_label']); ?>" /></li>
                      <li class="cf">
                        <span class="label">
                        <?php _e('Number of post to display', 'tcd-genesis'); ?>
                        </span>
                        <div class="display_post_num_option">
                          <label for="cb_post_list_post_num_<?php echo $cb_index; ?>"><input type="number"
                              id="cb_post_list_post_num_<?php echo $cb_index; ?>"
                              name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_num]"
                              value="<?php echo esc_attr($value['post_num']); ?>"><span class="icon icon_pc"></span></label>
                          <label for="cb_post_list_post_num_sp_<?php echo $cb_index; ?>"><input type="number"
                              id="cb_post_list_post_num_sp_<?php echo $cb_index; ?>"
                              name="dp_options[contents_builder][<?php echo $cb_index; ?>][post_num_sp]"
                              value="<?php echo esc_attr($value['post_num_sp']); ?>"><span
                              class="icon icon_sp"></span></label>
                        </div>
                      </li>
                    </ul>

                  </div><!-- END .cb_content_switch_target -->

                <?php
      // フリースペース　-------------------------------------------------------------
    } elseif ($cb_content_select == 'free_space') {

      if (!isset($value['show_content'])) {
        $value['show_content'] = 1;
      }
      if (!isset($value['free_space'])) {
        $value['free_space'] = '';
      }
      if (!isset($value['content_width'])) {
        $value['content_width'] = 'type1';
      }

      ?>
                  <h3 class="cb_content_headline">
                  <?php _e('Free space', 'tcd-genesis'); ?><span class="cb_content_headline_sub_title"></span>
                  </h3>
                  <label class="cb_content_switch">
                    <div class="label_wrap"><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_content]"
                        type="checkbox" value="1" <?php checked($value['show_content'], 1); ?>><span class="label"><span
                          class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div>
                  </label>
                  <div class="cb_content">

                    <div class="cb_content_switch_target">

                      <h4 class="theme_option_headline2">
                      <?php _e('Basic setting', 'tcd-genesis'); ?>
                      </h4>
                      <ul class="option_list">
                        <li class="cf">
                          <span class="label">
                          <?php _e('Content width', 'tcd-genesis'); ?>
                          </span>
                          <div class="standard_radio_button">
                            <input id="cb_content_width_type1_<?php echo $cb_index; ?>" type="radio"
                              name="dp_options[contents_builder][<?php echo $cb_index; ?>][content_width]" value="type1" <?php checked($value['content_width'], 'type1'); ?>>
                            <label for="cb_content_width_type1_<?php echo $cb_index; ?>">1320px</label>
                            <input id="cb_content_width_type2_<?php echo $cb_index; ?>" type="radio"
                              name="dp_options[contents_builder][<?php echo $cb_index; ?>][content_width]" value="type2" <?php checked($value['content_width'], 'type2'); ?>>
                            <label for="cb_content_width_type2_<?php echo $cb_index; ?>">
                            <?php _e('Full size', 'tcd-genesis'); ?>
                            </label>
                          </div>
                        </li>
                      </ul>

                      <h4 class="theme_option_headline2">
                      <?php _e('Content', 'tcd-genesis'); ?>
                      </h4>
                      <?php
                      wp_editor(
                        $value['free_space'],
                        'cb_wysiwyg_editor-' . $cb_index,
                        array(
                          'textarea_name' => 'dp_options[contents_builder][' . $cb_index . '][free_space]',
                          'editor_class' => 'cb-repeater-label'
                        )
                      );
                      ?>

                    </div><!-- END .cb_content_switch_target -->

                  <?php
      // ボタンの表示　-------------------------------------------------------------
    } else {
      ?>
                    <h3 class="cb_content_headline">
                    <?php echo esc_html($cb_content_select); ?>
                    </h3>
                    <div class="cb_content">

                    <?php
    }
    ?>

                  <ul class="button_list cf">
                    <li><input type="submit" class="button-ml ajax_button"
                        value="<?php echo __('Save Changes', 'tcd-genesis'); ?>" /></li>
                    <li><a href="#" class="button-ml close-content">
                        <?php echo __('Close', 'tcd-genesis'); ?>
                      </a></li>
                  </ul>

                </div><!-- END .cb_content -->

              </div><!-- END .cb_content_wrap -->

              <?php

} // END the_cb_content_setting()

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_tiny_mce_before_init_theme_option($mceInit, $editor_id)
{
  if (strpos($editor_id, 'cb_cloneindex') !== false) {
    $mceInit['wp_skip_init'] = true;
  }
  return $mceInit;
}
add_filter('tiny_mce_before_init', 'cb_tiny_mce_before_init_theme_option', 10, 2);

?>