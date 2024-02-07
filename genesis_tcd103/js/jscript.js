(function($) {

  var $window = $(window);
  var $body = $('body');

  // メガメニュー -------------------------------------------------

  $('a.megamenu_button').parent().addClass('megamenu_parent');

  // mega menu basic animation
  $('[data-megamenu]').each(function() {

    var mega_menu_button = $(this);
    var sub_menu_wrap =  "#" + $(this).data("megamenu");
    var hide_sub_menu_timer;
    var hide_sub_menu_interval = function() {
      if (hide_sub_menu_timer) {
        clearInterval(hide_sub_menu_timer);
        hide_sub_menu_timer = null;
      }
      hide_sub_menu_timer = setInterval(function() {
        if (!$(mega_menu_button).is(':hover') && !$(sub_menu_wrap).is(':hover')) {
          $(sub_menu_wrap).stop().removeClass('active_mega_menu');
          if (!$('#global_menu li').hasClass('active') && !$('#global_menu li').hasClass('active_megamenu_button')) {
            $body.removeClass('active_header');
          }
          clearInterval(hide_sub_menu_timer);
          hide_sub_menu_timer = null;
        }
      }, 20);
    };

    mega_menu_button.hover(
     function(){
       if (hide_sub_menu_timer) {
         clearInterval(hide_sub_menu_timer);
         hide_sub_menu_timer = null;
       }
       $(this).parent().addClass('active_megamenu_button');
       $(this).parent().find("ul").addClass('megamenu_child_menu');
       $(sub_menu_wrap).stop().addClass('active_mega_menu');
       $body.addClass('active_header');
     },
     function(){
       $(this).parent().removeClass('active_megamenu_button');
       $(this).parent().find("ul").removeClass('megamenu_child_menu');
       $body.removeClass('active_header');
       hide_sub_menu_interval();
     }
    );

    $(sub_menu_wrap).hover(
      function(){
        $(mega_menu_button).parent().addClass('active_megamenu_button');
        $body.addClass('active_header');
      },
      function(){
        $(mega_menu_button).parent().removeClass('active_megamenu_button');
        $body.removeClass('active_header');
      }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
      hide_sub_menu_interval();
    });

  }); // メガメニューここまで


  // ヘッダーの検索フォーム
  $("#header_search").hover(function(){
    $('#header_search_input').focus();
  });


  // 固定ヘッダー
  if( $(window).scrollTop() > 0) {
    $body.addClass('header_fixed');
  } else {
    $body.removeClass('header_fixed');
  }
  $(window).scroll(function () {
    if( $(this).scrollTop() > 0) {
      $body.addClass('header_fixed');
    } else {
      $body.removeClass('header_fixed');
    }
  });


  // グローバルメニュー
  $("#global_menu li:not(.megamenu_parent)").hover(function(){
    $(">ul:not(:animated)",this).slideDown("fast");
    $(this).addClass("active");
  }, function(){
    $(">ul",this).slideUp("fast");
    $(this).removeClass("active");
  });
  $("#global_menu > ul > li.menu-item-has-children").hover(function(){
    $body.addClass('active_header');
  }, function(){
    $body.removeClass('active_header');
  });


  // インナーリンク
  $('a[href*=#], area[href*=#]').not("a.no_auto_scroll").click(function() {

    var speed = 1000,
        href = $(this).prop("href"),
        hrefPageUrl = href.split("#")[0],
        currentUrl = location.href,
        currentUrl = currentUrl.split("#")[0];

    if(hrefPageUrl == currentUrl){

      href = href.split("#");
      href = href.pop();
      href = "#" + href;

      var target = $(href == "#" || href == "" ? 'html' : href);
      if( target.length ){
        var position = target.offset().top - 0,
            body = 'html',
            userAgent = window.navigator.userAgent.toLowerCase(),
            header_height = $('#header').innerHeight();

        $(body).animate({ scrollTop: position - header_height }, speed, 'easeOutQuint');
      }
      $('html').removeClass('open_menu');

      return false;
    }

  });


  // 他のページから移動した際に、ターゲットまでスクロールして移動する
  const hash = location.hash;
  if(hash){
    $("html, body").stop().scrollTop(0);
    setTimeout(function(){
      const target = $(hash),
      position = target.offset().top - 0;
      header_height = $('#header').innerHeight();
      $("html, body").animate({scrollTop:position - header_height}, 1000, 'easeOutQuint');
    });
  }


  // コメントタブ
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  // デザインセレクトボックス
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });


  // アーカイブウィジェット　ドロップダウン
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  // カテゴリーウィジェット
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  // タブ記事ウィジェット
  $('.widget_tab_post_list_button').on('click', '.tab1', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab2', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab3', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').addClass('active');
    return false;
  });


  // 検索ウィジェット
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  // カレンダーウィジェット
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });


  // FAQリスト　ショートコード
  $('.faq_list .title').on('click', function() {
    var desc = $(this).next('.desc_area');
    var acc_height = desc.find('.desc').outerHeight(true);
    if($(this).hasClass('active')){
      desc.css('height', '');
      $(this).removeClass('active');
    }else{
      desc.css('height', acc_height);
      $(this).addClass('active');
    }
  });


  // クイックタグ - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        if ($body.hasClass('show-serumtal')) {
          var left = $(this).offset().left;
          if (window.scrollX > left - window.innerHeight) {
            $(this).addClass('is-active');
          }
        } else {
          var top = $(this).offset().top;
          if (window.scrollY > top - window.innerHeight) {
            $(this).addClass('is-active');
          }
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }


  // ページ上部へ戻るリンク
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  // トップページのサービス
  $('.cb_service_category_list.type2').on('click', '.item', function () {
    $(this).toggleClass('open');
  });


// レスポンシブ ------------------------------------------------------------------------
const mql = window.matchMedia('screen and (min-width: 1100px)');
const checkBreakPoint = (event) => {

  if (event.matches) { // PC

    $("html").removeClass("mobile");
    $("html").addClass("pc");

  } else { // スマホ

    $("html").removeClass("pc");
    $("html").addClass("mobile");

    // ドロワーメニュー内の子メニューに開閉ボタンを追加
    $("#mobile_menu .child_menu_button").remove();
    $('#mobile_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
    $("#mobile_menu .child_menu_button").on('click',function() {
      if($(this).parent().hasClass("open")) {
        $(this).parent().removeClass("open");
        var parent_menu = $(this).parent().find('>ul:not(:animated)');
        parent_menu.slideUp("fast");
        $('li',parent_menu).removeClass('animate');
        return false;
      } else {
        $(this).parent().addClass("open");
        var parent_menu = $(this).parent().find('>ul:not(:animated)');
        parent_menu.slideDown("fast");
        $('li',parent_menu).each(function(i){
          $(this).delay(i *100).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
        return false;
      };
    });

    // ドロワーメニューの開閉ボタン
    var menu_button = $('#drawer_menu_button');
    menu_button.off();
    menu_button.toggleClass("active",false);
    var scrollTop;

    // ドロワーメニューを開く
    menu_button.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('html').toggleClass('open_menu');
      $('#container').one('click', function(e){
        if($('html').hasClass('open_menu')){
          $('html').removeClass('open_menu');
          return false;
        };
      });
    });

    // ドロワーメニューを閉じる
    $("#drawer_mneu_close_button").off();
    $("#drawer_mneu_close_button").on('click',function() {
      $('html').toggleClass("open_menu");
      return false;
    });

    // フッターバー
    var footerBar = $("#js-footer-bar");
    if( footerBar.length == 0 ) return;

    footerBar.find( '.js-footer-bar-share, #js-footer-bar-modal-overlay' ).on('click', function(e) {
      e.preventDefault();
      footerBar.find('#js-footer-bar-modal').toggleClass('is-active');		
      return false;
    });
    footerBar.find('#js-footer-bar-modal').on('touchmove', function(e) {
      e.preventDefault();
    });

    (new IntersectionObserver(function (entries) {
      if( entries[0].isIntersecting ){
        footerBar[0].classList.remove('is-active');
      } else {
        footerBar[0].classList.add('is-active');
      }
    })).observe(document.getElementById('js-body-start'));

  };

};
mql.addEventListener("change", checkBreakPoint);
checkBreakPoint(mql);


// 100%用スクリプト
const setVw = function() {
  const vw = document.documentElement.clientWidth / 100;
  document.documentElement.style.setProperty('--vw', `${vw}px`);
}
window.addEventListener('DOMContentLoaded', setVw);
window.addEventListener('resize', setVw);



})(jQuery);