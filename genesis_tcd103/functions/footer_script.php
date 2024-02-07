<?php
     // 共通のスクリプト --------------------------------------------------------------------------
     function footer_common_script(){
       global $post;
       $options = get_design_plus_option();
?>
<?php
     // スマホでhoverエフェクトを無効化する :hoverのcssが読み込まれなくなるため注意 --------------------------------
     if(is_mobile()) {
?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
var touch = 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
if(touch) {
  try {
    for (var si in document.styleSheets) {
      var styleSheet = document.styleSheets[si];
      if (!styleSheet.rules) continue;
      for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
        if (!styleSheet.rules[ri].selectorText) continue;
        if (styleSheet.rules[ri].selectorText.match(':hover')) {
          styleSheet.deleteRule(ri);
        }
      }
    }
  } catch (ex) {}
}
<?php }; ?>

<?php // メガメニューのカルーセル --------------------------------- ?>
(function($) {

  if( $('.megamenu_post_carousel').length ){
    let megamenu_post_carousel = new Swiper(".megamenu_post_carousel", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      scrollbar: {
        el: ".post_carousel_scrollbar",
        hide: false,
        draggable: true,
        dragSize: 275,
      },
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
    });
  };

  if( $('.megamenu_b .item_list').length ){
    let megamenu_post_carousel2 = new Swiper(".megamenu_b .item_list", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      resistanceRatio : 0,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".megamenu_carousel_button_next",
        prevEl: ".megamenu_carousel_button_prev",
      },
    });
  };

})(jQuery);

<?php
     // トップページ ------------------------------
     if(is_front_page()) {
      if ($options['contents_builder']) :
        $content_count = 1;
        $contents_builder = $options['contents_builder'];
        $blog_carousel_num = array();
        foreach($contents_builder as $content) :
          if ( $content['cb_content_select'] == 'blog_list' && $content['show_content'] ) {
            array_push($blog_carousel_num, $content_count);
          }
          $content_count++;
        endforeach;
      endif;
?>
(function($) {

  <?php // ブログ ------------------------ ?>
  if( $('.blog_carousel_wrap').length ){
<?php
    foreach($blog_carousel_num as $num):
?>
    let blog_carousel<?php echo $num; ?> = new Swiper("#cb_content_<?php echo $num; ?> .blog_carousel_wrap", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      scrollbar: {
        el: "#cb_content_<?php echo $num; ?> .blog_carousel_scrollbar",
        hide: false,
        draggable: true,
        dragSize: 120,
      },
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      breakpoints: {
        800: {
          scrollbar: {
            dragSize: 200,
          },
        }
      }
    });
<?php endforeach; ?>
  };

  <?php
       // コンテンツビルダー ------------------------
       if ($options['contents_builder']) :
         $show_news_content = true;
         $show_service_content = true;
         $contents_builder = $options['contents_builder'];
         foreach($contents_builder as $content) :

           // お知らせ ------------------------
           if ( ($show_news_content == true) && $content['cb_content_select'] == 'news_list' && $content['show_content'] ) {
             $show_news_content = false;
  ?>
  let news_carousel_cat_all;
  <?php
       $news_category_list = get_terms( 'news_category', array('hide_empty' => true ) );
       $category_total = count($news_category_list);
       if ( $news_category_list && ! is_wp_error( $news_category_list ) && ($category_total > 1) ) {
         foreach ( $news_category_list as $cat ):
           $cat_id = $cat->term_id;
  ?>
  let news_carousel_cat_<?php echo esc_attr($cat_id); ?>;
  <?php
         endforeach;
       };
  ?>

  function init_news_carousel(){

  if( $('#news_carousel_cat_all').length ){
    if(news_carousel_cat_all != undefined){
      news_carousel_cat_all.destroy();
    }
    news_carousel_cat_all = new Swiper("#news_carousel_cat_all", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      scrollbar: {
        el: "#news_carousel_scrollbar",
        hide: false,
        draggable: true,
        dragSize: 120,
      },
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      observer: true,
      observeParents: true,
      breakpoints: {
        800: {
          scrollbar: {
            dragSize: 200,
          },
        }
      }
    });
  };
  <?php
       // カテゴリー別記事一覧
       if ( $news_category_list && ! is_wp_error( $news_category_list ) && ($category_total > 1) ) {
         foreach ( $news_category_list as $cat ):
           $cat_id = $cat->term_id;
  ?>
  if( $('#news_carousel_cat_<?php echo esc_attr($cat_id); ?>').length ){
    if(news_carousel_cat_<?php echo esc_attr($cat_id); ?> != undefined){
      news_carousel_cat_<?php echo esc_attr($cat_id); ?>.destroy();
    }
    news_carousel_cat_<?php echo esc_attr($cat_id); ?> = new Swiper("#news_carousel_cat_<?php echo esc_attr($cat_id); ?>", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      scrollbar: {
        el: "#news_carousel_scrollbar_cat_<?php echo esc_attr($cat_id); ?>",
        hide: false,
        draggable: true,
        dragSize: 120,
      },
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      observer: true,
      observeParents: true,
      breakpoints: {
        800: {
          scrollbar: {
            dragSize: 200,
          },
        }
      }
    });
  };
  <?php
         endforeach;
       };
  ?>

  }; // END init_news_carousel();
  init_news_carousel();

  <?php
       // カテゴリーソートボタン
       if ( $news_category_list && ! is_wp_error( $news_category_list ) && ($category_total > 1) ) {
  ?>
  $('.news_category_button a').on('click',function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).parent().siblings().removeClass('current');
    $(this).parent().addClass('current');
    var news_category_id = $(this).data('category-id');
    if(news_category_id){
      $('.index_news_list').removeClass('active');
      $('#' + news_category_id).addClass('active');
      init_news_carousel();
    }
  });
  <?php
       };

           // サービス ------------------------
           } elseif ( ($show_service_content == true) && $content['cb_content_select'] == 'service_list' && $content['show_content'] ) {
             $show_service_content = false;
?>

  if( $('.cb_service_category_list_carousel').length ){
    let cb_service_category_list_carousel = new Swiper(".cb_service_category_list_carousel", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      resistanceRatio : 0,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".cb_service_category_list_button_next",
        prevEl: ".cb_service_category_list_button_prev",
      },
    });
  };

  $(window).on('load resize',function(){
    image_height = $('.cb_service_category_list_carousel .item').height();
    $('.cb_service_category_list_button_prev, .cb_service_category_list_button_next').css('top',image_height / 2);
  });

<?php
           };
         endforeach;
       endif; // END content builder
  ?>

})(jQuery);
<?php }; ?>

<?php
     // お知らせアーカイブ ------------------------------
     if(is_post_type_archive('news') || is_tax('news_category') || is_front_page()) {
?>
(function($) {

  if( $('.news_category_button').length ){
    let news_category_button = new Swiper(".news_category_button", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
    });
  };

})(jQuery);
<?php
     };
     // お知らせアーカイブとカテゴリーページ
     if(is_post_type_archive('news') || is_tax('news_category')) {
       $ajax_item = 'get_news_items';
?>
(function($) {

  <?php // カテゴリーソートボタン ------------------------ ?>
  $('.news_category_button a').on('click',function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).parent().siblings().removeClass('current');
    $(this).parent().addClass('current');
    var news_category_id = $(this).data('category-id');
    if(news_category_id){
      $('.news_list').find('.item').removeClass('animate').removeAttr('style');
      $('.ajax_post_list_wrap').removeClass('active');
      $(news_category_id).addClass('active');
      $(news_category_id).find(".item").each(function(i){
        $(this).delay(300).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }
  });

  <?php
       // AJAXを使って記事をロードする ------------------------
       if(is_mobile()){
         $post_num = $options['archive_news_num_sp'];
       } else {
         $post_num = $options['archive_news_num'];
       }
  ?>
  var offsetPost = '',
      catid = '',
      flag = false;

  $(document).on("click", ".entry-more", function() {
    offsetPost = $(this).data('offset-post');
    catid = $(this).data('catid');
    current_button = $(this);
    if (!flag) {
      entry_loading = current_button.closest('.ajax_post_list_wrap').find('.entry-loading');
      news_list = current_button.closest('.ajax_post_list_wrap').find('.news_list');
      current_button.addClass("is-hide");
      entry_loading.addClass("is-show");
      flag = true;
      $.ajax({
        type: "POST",
        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
        data: {
          action: '<?php echo esc_attr($ajax_item); ?>',
          offset_post_num: offsetPost,
          post_cat_id: catid
        },
        dataType: 'json'
      }).done(function(data, textStatus, jqXHR) {
        if (data.html) {
          news_list.append(data.html);
          $(".ajax_item",news_list).each(function(i) {
            $(this).css('opacity','0').show();
            $(this).delay(300).queue(function(next) {
              $(this).addClass('animate').fadeIn();
              $(this).removeClass('ajax_item');
              next();
            });
          });
        }
        entry_loading.removeClass("is-show");
        if (data.remain) {
          current_button.removeClass("is-hide");
        }
        offsetPost += <?php echo esc_attr($post_num); ?>;
        current_button.attr('data-offset-post',offsetPost);
        current_button.data('offset-post',offsetPost);
        flag = false;
      }).fail(function(jqXHR, textStatus, errorThrown) {
        entry_loading.removeClass("is-show");
        // console.log('fail loading');
      });
    }
  });

})(jQuery);
<?php
     };

     // ブログ詳細ページ ------------------------------
     if(is_singular('post')) {
?>
(function($) {

  if( $('.related_post_carousel').length ){
    let related_post_carousel = new Swiper(".related_post_carousel", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".related_post_carousel_button_next",
        prevEl: ".related_post_carousel_button_prev",
      },
      scrollbar: {
        el: ".related_carousel_scrollbar",
        hide: false,
        draggable: true,
        dragSize: 120,
        enabled: true,
      },
      breakpoints: {
        800: {
          scrollbar: {
            enabled: false,
          },
        }
      }
    });
  };

  $(window).on('load resize',function(){
    image_height = $('.related_post_carousel .image_link').height();
    $('.related_post_carousel_button_prev, .related_post_carousel_button_next').css('top',image_height / 2);
  });

})(jQuery);
<?php
     };

     // バナーウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'tcd_banner_widget', true)) || (is_page() && is_active_widget(false, false, 'tcd_banner_widget', true)) ) {
?>
(function($) {

  if( $('.banner_widget').length ){
    let banner_inner = new Swiper(".banner_widget", {
      loop: true,
      effect: "fade",
      speed: 1000,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
    });
  }

})(jQuery);
<?php
     } // バナーウィジェット

     // 固定ページ ------------------------------
     if(is_page()) {
?>
(function($) {

  if( $('.gallery_content_carousel_wrap').length ){
    var slider = $('.gallery_content_carousel');
    var item_num = $('.gallery_content_carousel .item').length;
    var animation_time = 15 * item_num;
    slider.clone().insertBefore(slider);
    slider.clone().insertAfter(slider);
    $('.gallery_content_carousel').css('animation-duration', animation_time + 's');
    $('.gallery_content_carousel:nth-child(2)').css('animation-delay', -animation_time  / 1.5 + 's');
    $('.gallery_content_carousel:last-child').css('animation-delay', -animation_time / 3 + 's');
  };

})(jQuery);
<?php }; ?>

<?php
     // フッターメニュー ------------------------------
     if (has_nav_menu('footer-menu')) {
?>
(function($) {

  if( $('#footer_nav').length ){
    let footer_nav = new Swiper("#footer_nav", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
    });
  };

})(jQuery);
<?php }; ?>

<?php
     }; // END footer common script

     //  ブラウザのスクロールに合わせたアニメーション -----------------------
     function inview_animaton(){
       global $post;
?>
(function($) {

  const targets = document.querySelectorAll('.inview');
  const options = {
    root: null,
    rootMargin: '-100px 0px',
    threshold: 0
  };
  const observer = new IntersectionObserver(intersect, options);
  targets.forEach(target => {
    observer.observe(target);
  });
  function intersect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
<?php if( is_page_template('page-tcd-lp.php') ) { echo 'setTimeout(function(){' . "\n"; }; ?>
        $(entry.target).addClass('animate');
        $(".item",entry.target).each(function(i){
          $(this).delay(i * 300).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
        observer.unobserve(entry.target);
<?php if( is_page_template('page-tcd-lp.php') ) { echo '}, 500);' . "\n"; }; ?>
      }
    });
  }

<?php if( is_page_template('page-tcd-lp.php') ) { ?>
  setTimeout(function(){
    $('#lp_page_header').addClass('animate');
  }, 100);
<?php }; ?>


})(jQuery);
<?php
     };

     // ロード画面を表示する場合 -----------------------------------------------------------------
     function show_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

function after_load() {
  (function($) {

  $('body').addClass('end_loading');
  setTimeout(function(){
    $('html').addClass('end_loading_show_scroll_bar');
  }, 100);

  setTimeout(function(){
    <?php inview_animaton(); ?>

    // #header_messageが存在する場合のみ処理を実行
    if ($('#header_message').length) {
      const headerMessageHeight = jQuery('#header_message').outerHeight();
      // スクロール位置によって#headerのpositionとtopのスタイルを動的に変更
      $(window).on('scroll', function() {
        const scrollPosition = jQuery(this).scrollTop();
        if (scrollPosition < headerMessageHeight) {
          $('#header').css({
            'position': 'relative',
              'top': '0px'
          });
        } else {
          $('#header').css({
            'position': 'fixed',
            'top': '0px'
          });
        }
      });
    }

    <?php if(is_front_page() && $options['index_slider_image']) { ?>
    setTimeout(function(){
      $('#header').removeClass('first_animate');
    }, 300);
    <?php } else { ?>
    $('#header').removeClass('first_animate');
    <?php }; ?>
  }, 1200);

  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page() && $options['index_slider_image']) {
  ?>
  setTimeout(function(){
    $('#header_slider_wrap').addClass('start_slide');
  }, 900);
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

  })( jQuery );
}

(function($) {

  <?php if ( $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  $('#site_loader_overlay').addClass('start_loading');

  <?php if ($options['loading_type'] == 'type5') { ?>

  $('#site_loader_overlay_for_catchphrase').addClass('start_loading');

  setTimeout(function(){
    $('#site_loader_overlay_for_catchphrase').addClass('active');
    $('#site_loader_overlay').addClass('active');
  }, 2000);
  setTimeout(function(){
    after_load();
  }, 5000);

  <?php } else { ?>

  setTimeout(function(){
    after_load();
  }, <?php echo esc_attr($options['loading_time']); ?>);

  <?php }; ?>

})( jQuery );

</script>
<?php
     };

     // ロード画面を表示しない場合 ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

(function($) {

  <?php inview_animaton(); ?>

  // #header_messageが存在する場合のみ処理を実行
  if ($('#header_message').length) {
    const headerMessageHeight = jQuery('#header_message').outerHeight();
    // スクロール位置によって#headerのpositionとtopのスタイルを動的に変更
    $(window).on('scroll', function() {
      const scrollPosition = jQuery(this).scrollTop();
      if (scrollPosition < headerMessageHeight) {
        $('#header').css({
          'position': 'relative',
            'top': '0px'
        });
      } else {
        $('#header').css({
          'position': 'fixed',
          'top': '0px'
        });
      }
    });
  }

  <?php if(is_front_page() && $options['index_slider_image']) { ?>
  setTimeout(function(){
    $('#header').removeClass('first_animate');
  }, 600);
  <?php } else { ?>
  setTimeout(function(){
    $('#header').removeClass('first_animate');
  }, 300);
  <?php }; ?>


  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page() && $options['index_slider_image']) {
  ?>
  $('#header_slider_wrap').addClass('start_slide');
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

})( jQuery );

</script>
<?php } ?>