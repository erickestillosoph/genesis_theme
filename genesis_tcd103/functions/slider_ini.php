<?php
     $options = get_design_plus_option();
?>

  var slideWrapper = $('#header_slider'),
      iframes = slideWrapper.find('.youtube-player'),
      ytPlayers = {},
      timers = { slickNext: null };

  // YouTube IFrame Player API script load
  if ($('#header_slider .youtube-player').length) {
    if (!$('script[src="//www.youtube.com/iframe_api"]').length) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
  }

  // YouTube IFrame Player API Ready
  window.onYouTubeIframeAPIReady = function(){
    slideWrapper.find('.youtube-player').each(function(){
      var ytPlayerId = $(this).attr('id');
      if (!ytPlayerId) return;
      var player = new YT.Player(ytPlayerId, {
        events: {
          onReady: function(e) {
            $('#'+ytPlayerId).css('opacity', 0).css('pointerEvents', 'none');
            iframes = slideWrapper.find('.youtube-player');
            ytPlayers[ytPlayerId] = player;
            ytPlayers[ytPlayerId].mute();
            ytPlayers[ytPlayerId].lastStatus = -1;
            var item = $('#'+ytPlayerId).closest('.item');
            if (item.hasClass('slick-current')) {
              playPauseVideo(item, 'play');
            }
          },
          onStateChange: function(e) {
            if (e.data === 0) { // ended
              if (slideWrapper.find('.item').length == 1) {<?php // youtubeスライド1枚のみのループ処理 ?>
                var slide = slideWrapper.find('.slick-current');
                slide.css('transition', 'none').removeClass('animate');
                slide.find('.animate_item').css('transition', 'none').removeClass('animate');
                setTimeout(function(){
                  slide.removeAttr('style');
                  slide.find('.animate_item').removeAttr('style');
                  slide.addClass('animate');
                  playPauseVideo(slide, 'play');
                }, 20);
              } else {
                $('#'+ytPlayerId).stop().css('opacity', 0);
                if ($('#'+ytPlayerId).closest('.item').hasClass('slick-current')) {
                  if (timers.slickNext) {
                    clearTimeout(timers.slickNext);
                    timers.slickNext = null;
                  }
                  slideWrapper.slick('slickNext');
                }
              }
            } else if (e.data === 1) { // play
              $('#'+ytPlayerId).not(':animated').css('opacity', 1);
              if (slideWrapper.find('.item').length > 1) {
                var slide = $('#'+ytPlayerId).closest('.item');
                var slickIndex = slide.attr('data-slick-index') || 0;
                clearInterval(timers[slickIndex]);
                timers[slickIndex] = setInterval(function(){
                  var state = ytPlayers[ytPlayerId].getPlayerState();
                  if (state != 1 && state != 3) {
                    clearInterval(timers[slickIndex]);
                  } else if (ytPlayers[ytPlayerId].getDuration() - ytPlayers[ytPlayerId].getCurrentTime() < 1) {
                    clearInterval(timers[slickIndex]);
                    if (timers.slickNext) {
                      clearTimeout(timers.slickNext);
                      timers.slickNext = null;
                    }
                    slideWrapper.slick('slickNext');
                  }
                }, 200);
              }
            } else if (e.data === 3) { // buffering
              if (ytPlayers[ytPlayerId].lastStatus === -1) {
                $('#'+ytPlayerId).delay(100).animate({opacity: 1}, 400);
              }
            }
            ytPlayers[ytPlayerId].lastStatus = e.data;
          }
        }
      });
    });
  };

  // play or puase video
  function playPauseVideo(slide, control){
    if (!slide) {
      slide = slideWrapper.find('.slick-current');
    }
    // youtube item --------------------------
    if (slide.hasClass('youtube')) {
      var ytPlayerId = slide.find('.youtube-player').attr('id');
      if (ytPlayerId) {
        switch (control) {
          case 'play':
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].seekTo(0, true);
            }
            // breakしない
          case 'resume':
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].playVideo();
            }
            if (timers.slickNext) {
              clearTimeout(timers.slickNext);
              timers.slickNext = null;
            }
            break;
          case 'pause':
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].pauseVideo();
            }
            if(slide.hasClass('first_item')){
              setTimeout(function(){
                slide.removeClass('first_item');
              }, 1000);
            }
            break;
        }
      }
    // video item ------------------------
    } else if (slide.hasClass('video')) {
      var video = slide.find('video').get(0);
      if (video) {
        switch (control) {
          case 'play':
            video.currentTime = 0;
            // breakしない
          case 'resume':
            video.play();
            var slickIndex = slide.attr('data-slick-index') || 0;
            clearInterval(timers[slickIndex]);
            timers[slickIndex] = setInterval(function(){
              if (video.paused) {
                // clearInterval(timers[slickIndex]);
              } else if (video.duration - video.currentTime < 2) {
                clearInterval(timers[slickIndex]);
                if (timers.slickNext) {
                  clearTimeout(timers.slickNext);
                  timers.slickNext = null;
                }
                slideWrapper.slick('slickNext');
                setTimeout(function(){
                  video.currentTime = 0;
                }, 2000);
              }
            }, 200);
            break;
          case 'pause':
            video.pause();
            if(slide.hasClass('first_item')){
              setTimeout(function(){
                slide.removeClass('first_item');
              }, 1000);
            }
            break;
        }
      }
    // normal image item --------------------
    } else if (slide.hasClass('image_item')) {
      switch (control) {
        case 'play':
        case 'resume':
          var zoom_type = ["zoom1", "zoom2", "zoom3", "zoom4"];
          var i = Math.floor(Math.random() * zoom_type.length);
          if(slide.find('.animation_zoom')){
            slide.find('.animation_zoom').addClass(zoom_type[i]);
          }
          if (timers.slickNext) {
            clearTimeout(timers.slickNext);
            timers.slickNext = null;
          }
          timers.slickNext = setTimeout(function(){
            slideWrapper.slick('slickNext');
          }, 4500);
          break;
        case 'pause':
          slide.find('.animation_zoom').removeClass('zoom1 zoom2 zoom3 zoom4');
          if(slide.hasClass('first_item')){
            setTimeout(function(){
              slide.removeClass('first_item');
            }, 1000);
          }
          break;
      }
    }
  }


  // resize youtube
  function youtube_resize(){
    var header_slider = $('#header_slider');
    var content_height = header_slider.innerHeight();
    var content_width = header_slider.innerWidth();
    var youtube_height = content_width*(9/16);
    var youtube_width = content_height*(16/9);
    if(content_width > youtube_width) {
      header_slider.find('.youtube_wrap').addClass('type1');
      header_slider.find('.youtube_wrap').removeClass('type2');
      header_slider.find('.youtube_wrap').css({'width': '100%', 'height': youtube_height});
    } else {
      header_slider.find('.youtube_wrap').removeClass('type1');
      header_slider.find('.youtube_wrap').addClass('type2');
      header_slider.find('.youtube_wrap').css({'width':youtube_width, 'height':content_height });
    }
  }


  // DOM Ready
  $(function() {
    slideWrapper.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
      if (currentSlide == nextSlide) return;
      slick.$slides.eq(nextSlide).addClass('animate');
      slick.$slides.eq(currentSlide).addClass('end_animate');
      setTimeout(function(){
        playPauseVideo(slick.$slides.eq(currentSlide), 'pause');
      }, slick.options.speed);
      playPauseVideo(slick.$slides.eq(nextSlide), 'play');
    });
    slideWrapper.on('afterChange', function(event, slick, currentSlide) {
      slick.$slides.not(':eq(' + currentSlide + ')').removeClass('animate end_animate');
    });
    slideWrapper.on('swipe', function(event, slick, direction){
      slideWrapper.slick('setPosition');
    });

    //start the slider
    slideWrapper.slick({
      slide: '.item',
      infinite: true,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      swipe: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      autoplay: false,
      fade: true,
      autoplaySpeed:10000,
      speed:1500,
      easing: 'easeOutExpo',
    });

    // initialize / first animate
    youtube_resize();
    playPauseVideo($('#header_slider .item1'), 'play');
    $('#header_slider .first_item').addClass('animate');
    $('#header_slider_catch_area').addClass('animate');
    $('#header_slider').addClass('animate');
  });

  // Resize event
  var currentWidth = $(window).innerWidth();
  $(window).on('resize', function(){
    //adjust_size();
    if (currentWidth == $(this).innerWidth()) {
      return;
    } else {
      youtube_resize();
    };
  });
