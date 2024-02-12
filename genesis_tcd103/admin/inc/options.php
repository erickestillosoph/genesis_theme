<?php
/*
 * オプションの設定
 */

//フォントの縦方向
global $font_direction_options;
$font_direction_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Horizontal', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Vertical', 'tcd-genesis' )),
);


// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-genesis' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-genesis' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-genesis' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-genesis' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-genesis' )),
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-genesis' )),
);

global $image_position_type;
$image_position_type = array(
  'left' => array('value' => 'left','label' => __( 'Left', 'tcd-genesis' )),
  'right' => array('value' => 'right','label' => __( 'Right', 'tcd-genesis' )),
);

//フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-genesis' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-genesis' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-genesis' ),'label_en' => 'Times New Roman')
);


// レイアウトの設定
global $layout_options;
$layout_options = array(
 'type0' => array('value' => 'type0','label' => __( 'Use theme option setting', 'tcd-genesis' )),
 'type1' => array('value' => 'type1','label' => __( 'Don\'t display', 'tcd-genesis' )),
 'type2' => array('value' => 'type2','label' => __( 'Display on right side', 'tcd-genesis' )),
 'type3' => array('value' => 'type3','label' => __( 'Display on left side', 'tcd-genesis' )),
);


// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-genesis' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-genesis' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-genesis' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-genesis' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-genesis' ), 'img' => 'share_type5.jpg')
);


// 記事タイプ
global $post_type_options;
$post_type_options = array(
  'recent_post' => array('value' => 'recent_post','label' => __( 'All post', 'tcd-genesis' )),
  'recommend_post' => array('value' => 'recommend_post','label' => __( 'Recommend post1', 'tcd-genesis' )),
  'recommend_post2' => array('value' => 'recommend_post2','label' => __( 'Recommend post2', 'tcd-genesis' )),
  'pickup_post' => array('value' => 'pickup_post','label' => __( 'Pickup post', 'tcd-genesis' ))
);


// 記事の並び順
global $post_type_order_options;
$post_type_order_options = array(
  'date1' => array('value' => 'date1','label' => __( 'Date (DESC)', 'tcd-genesis' )),
  'date2' => array('value' => 'date2','label' => __( 'Date (ASC)', 'tcd-genesis' )),
  'rand' => array('value' => 'rand','label' => __( 'Random', 'tcd-genesis' ))
);


// スライダーやロードアイコンで使用
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-genesis'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-genesis'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-genesis'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-genesis'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-genesis'), 5)),
);


// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.gif'
  )
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-genesis' ), 'img' => 'gmap_marker_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-genesis' ), 'img' => 'gmap_marker_type2.jpg' )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-genesis' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-genesis' ) )
);


// ページ分割ナビのタイプ
global $pagenation_type_options;
$pagenation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Page numbers', 'tcd-genesis' ), 'img' => 'page_link_type1.jpg' ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Read more button', 'tcd-genesis' ), 'img' => 'page_link_type2.jpg' )
);


// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-genesis' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-genesis' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-genesis' ))
);
// コンテンツの方向（縦方向）
global $content_direction_options2;
$content_direction_options2 = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align top', 'tcd-genesis' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align middle', 'tcd-genesis' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align bottom', 'tcd-genesis' ))
);


// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-genesis' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-genesis' )),
);


// スライダーのコンテンツタイプ
global $index_slider_content_type_options;
$index_slider_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Same as PC setting', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Display diffrent content in mobile size', 'tcd-genesis' )),
);


// スライダーのアイテムタイプ
global $slider_type_options;
$slider_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-genesis' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-genesis' )),
  'type4' => array('value' => 'type4','label' => __( 'Logo content', 'tcd-genesis' ))
);


// メガメニュー
global $megamenu_options;
$megamenu_options = array(
  'type2' => array('value' => 'type2', 'title' => __( 'Mega menu A', 'tcd-genesis' ), 'label' => __( 'Mega menu A', 'tcd-genesis' ), 'img' => 'megamenu2.jpg'),
  'type3' => array('value' => 'type3', 'title' => __( 'Mega menu B', 'tcd-genesis' ), 'label' => __( 'Mega menu B', 'tcd-genesis' ), 'img' => 'megamenu3.jpg'),
  'type4' => array('value' => 'type4', 'title' => __( 'Mega menu C', 'tcd-genesis' ), 'label' => __( 'Mega menu C', 'tcd-genesis' ), 'img' => 'megamenu4.jpg'),
);


// パララックスの設定
global $para_options;
$para_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Use parallax effect', 'tcd-genesis' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Don\'t use parallax effect', 'tcd-genesis' ))
);


// クイックタグ カスタムボタンタイプ
global $qt_custom_button_type_options;
$qt_custom_button_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Flat button', 'tcd-genesis' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Rounded button', 'tcd-genesis' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Oval button', 'tcd-genesis' )
	)
);


// クイックタグ カスタムボタンサイズ
global $qt_custom_button_size_options;
$qt_custom_button_size_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Small size button - Width:130px Height:40px', 'tcd-genesis' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Medium size button - Width:270px Height:60px', 'tcd-genesis' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Large size button - Width:400px Height:70px', 'tcd-genesis' )
	)
);


// テキストの方向
global $text_align_options;
$text_align_options = array(
 'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-genesis' )),
 'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-genesis' )),
);


// テキストの方向2
global $text_direction_options;
$text_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Display horizontally', 'tcd-genesis' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Display vertically', 'tcd-genesis' )),
);


// コンテンツの横幅
global $content_width_options;
$content_width_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Normal content width', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Full screen width', 'tcd-genesis' ))
);


// 表示設定
global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-genesis' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-genesis' ),
	)
);


// 表示設定
global $single_page_display_options;
$single_page_display_options = array(
	'top' => array(
		'value' => 'top',
		'label' => __( 'Above post', 'tcd-genesis' ),
	),
	'bottom' => array(
		'value' => 'bottom',
		'label' => __( 'Under post', 'tcd-genesis' ),
	),
	'both' => array(
		'value' => 'both',
		'label' => __( 'Both above and bottom', 'tcd-genesis' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-genesis' ),
	),
);


// クイックタグ関連 -------------------------------------------------------------------------------------------


// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-genesis' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-genesis' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-genesis' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-genesis' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-genesis' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-genesis' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid line', 'tcd-genesis' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot line', 'tcd-genesis' )),
	'double' => array('value' => 'double','label' => __( 'Double line', 'tcd-genesis' ))
);


// ボタン
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Normal', 'tcd-genesis' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-genesis' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-genesis' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-genesis' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-genesis' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-genesis' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-genesis' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-genesis' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-genesis' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-genesis' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-genesis' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-genesis' ))
);


// 囲み枠
global $flame_border_radius_options;
$flame_border_radius_options = array(
	'0' => array('value' => '0','label' => __( 'Square', 'tcd-genesis' )),
	'10' => array('value' => '10','label' => __( 'Rounded', 'tcd-genesis' ))
);


// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-genesis' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-genesis' ))
);


// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-genesis' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-genesis' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-genesis' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-genesis' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-genesis' ))
);



// ロード画面関連 -------------------------------------------------------------------------------------------


// ローディングアイコンの種類の設定
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	)
);


global $loading_display_page_options;
$loading_display_page_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-genesis' )),
 'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-genesis' ))
);


global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-genesis' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-genesis' ))
);


global $loading_animation_type_options;
$loading_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Fade', 'tcd-genesis' )),
  'type2' => array('value' => 'type2','label' => __( 'Float', 'tcd-genesis' )),
  'type3' => array('value' => 'type3','label' => sprintf( __( 'Slides(%s)', 'tcd-genesis' ), '&#x2192;' ) ),
  'type4' => array('value' => 'type4','label' => sprintf( __( 'Slides(%s)', 'tcd-genesis' ), '&#x2191;' ) ),
);


// ドロワーメニュー
global $drawer_menu_color_type_options;
$drawer_menu_color_type_options = array(
	'dark' => array(
		'value' => 'dark',
		'label' => __( 'Dark color', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/drawer_menu_color_type1.jpg?ver2'
	),
	'light' => array(
		'value' => 'light',
		'label' => __( 'Light color', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/drawer_menu_color_type2.jpg?ver2'
	)
);


// フッター関連 -------------------------------------------------------------------------------------------
global $footer_bar_type_options;
$footer_bar_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Hide', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Button with icon (Dark color)', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Button with icon (Light color)', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type3.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Button without icon', 'tcd-genesis' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type4.jpg'
	)
);


// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-genesis' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-genesis' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-genesis' ))
);

// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
  // ブログ
	'e80d' =>  array( 'type' => 'google', 'label' => 'Share' ), // シェア
	'e8dc' =>  array( 'type' => 'google', 'label' => 'Thumb Up' ), // いいね
	// 汎用
	'e5d2' =>  array( 'type' => 'google', 'label' => 'Menu' ), // メニュー
	'e5ca' =>  array( 'type' => 'google', 'label' => 'Check' ), // チェック
	'e838' =>  array( 'type' => 'google', 'label' => 'Star' ), // スター
	'e87d' =>  array( 'type' => 'google', 'label' => 'Favorite' ), // ハート
	'eafb' =>  array( 'type' => 'google', 'label' => 'Currency Yen' ), // 円
	'e894' =>  array( 'type' => 'google', 'label' => 'Language' ), // 言語
	'e7fd' =>  array( 'type' => 'google', 'label' => 'Person' ), // ユーザー
	'ebcc' =>  array( 'type' => 'google', 'label' => 'Calendar Month' ), // カレンダー
	'e8b5' =>  array( 'type' => 'google', 'label' => 'Schedule' ), // スケジュール
	'e0f0' =>  array( 'type' => 'google', 'label' => 'Lightbulb' ), // ヒント
	'e158' =>  array( 'type' => 'google', 'label' => 'Mail' ), // メール
	'e7f4' =>  array( 'type' => 'google', 'label' => 'Notifications' ), // おしらせ
	'e0b0' =>  array( 'type' => 'google', 'label' => 'Call' ), // 電話
	'e0b7' =>  array( 'type' => 'google', 'label' => 'Chat' ), // チャット
	'e3c9' =>  array( 'type' => 'google', 'label' => 'Edit' ), // 執筆
	'e413' =>  array( 'type' => 'google', 'label' => 'Photo Library' ), // ギャラリー
	'e873' =>  array( 'type' => 'google', 'label' => 'Description' ), // ノート
	'f0e2' =>  array( 'type' => 'google', 'label' => 'Support Agent' ), // ヘッドフォン
	'e869' =>  array( 'type' => 'google', 'label' => 'Build' ), // 修理
	'e80b' =>  array( 'type' => 'google', 'label' => 'Public' ), // 地球
	// 食事
	'e88a' =>  array( 'type' => 'google', 'label' => 'Home' ), // Home
	'e56c' =>  array( 'type' => 'google', 'label' => 'Restaurant' ), // レストラン
	'ea61' =>  array( 'type' => 'google', 'label' => 'Lunch Dining' ), // ランチ
	'ea64' =>  array( 'type' => 'google', 'label' => 'Ramen Dining' ), // 麺類
	'e541' =>  array( 'type' => 'google', 'label' => 'Local Cafe' ), // カフェ
	'e91d' =>  array( 'type' => 'google', 'label' => 'Pets' ), // ペット	
  // アクセス
	'e55b' =>  array( 'type' => 'google', 'label' => 'Map' ), // マップ
	'e0c8' =>  array( 'type' => 'google', 'label' => 'Location On' ), // マップアイコン
	'e539' =>  array( 'type' => 'google', 'label' => 'Flight' ), // 飛行機
	'e532' =>  array( 'type' => 'google', 'label' => 'Directions Boat' ), // 船
	'e570' =>  array( 'type' => 'google', 'label' => 'Train' ), // 電車
	'e531' =>  array( 'type' => 'google', 'label' => 'Directions Car' ), // 車
	'eb29' =>  array( 'type' => 'google', 'label' => 'Pedal Bike' ), // 自転車
	'e536' =>  array( 'type' => 'google', 'label' => 'Directions Walk' ), // 徒歩
	// SNS
	'ea92' =>  array( 'type' => 'sns', 'label' => 'Instagram' ), // Instagram
	'e94d' =>  array( 'type' => 'sns', 'label' => 'TikTok' ), // TikTok
	'e950' =>  array( 'type' => 'sns', 'label' => 'Twitter' ), // Twitter
	'e944' =>  array( 'type' => 'sns', 'label' => 'Facebook' ), // Facebook
	'ea9d' =>  array( 'type' => 'sns', 'label' => 'YouTube' ), // YouTube
	'e909' =>  array( 'type' => 'sns', 'label' => 'Line' ), // Line
);


// カラープリセット
define( 'TCD_COLOR_PRESET', array(
	__('Orange', 'tcd-genesis') => array(
		'main' => '#ff4000',
		'bg' => '#fafafa'
	),
	__('Green', 'tcd-genesis') => array(
		'main' => '#00B200',
		'bg' => '#fafafa'
	),
	__('Blue', 'tcd-genesis') => array(
		'main' => '#0085B2',
		'bg' => '#fafafa'
	),
	__('Navy', 'tcd-genesis') => array(
		'main' => '#00468C',
		'bg' => '#fafafa'
	),
	__('Red', 'tcd-genesis') => array(
		'main' => '#D90000',
		'bg' => '#fafafa'
	)
) );


// ツイッターのサムネイルサイズ
$twitter_image_options = array(
	'summary' => array('value' => 'summary','label' => __( 'Normal', 'tcd-genesis' )),
	'summary_large_image' => array('value' => 'summary_large_image','label' => __( 'Largish', 'tcd-genesis' ))
);


// メガメニューのカラータイプ
global $megamenu_color_type_options;
$megamenu_color_type_options = array(
  'megamenu_light_color' => array(
    'value' => 'megamenu_light_color',
    'label' => __( 'Light color', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/megamenu_light_ver.jpg'
  ),
  'megamenu_dark_color' => array(
    'value' => 'megamenu_dark_color',
    'label' => __( 'Dark color', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/megamenu_dark_ver.jpg'
  )
);


// スライダーのレイアウト
global $slider_layout_options;
$slider_layout_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Type1', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/slider_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Type2', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/slider_type2.jpg'
  ),
  'type3' => array(
    'value' => 'type3',
    'label' => __( 'Type3', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/slider_type3.jpg'
  )
);


// サービスカテゴリー
global $service_category_type_options;
$service_category_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Type1', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/service_category_type1.jpg?2.1'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Type2', 'tcd-genesis' ),
    'image' => get_template_directory_uri() . '/admin/img/service_category_type2.jpg?2.1'
  )
);


?>