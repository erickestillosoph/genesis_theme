jQuery(document).ready(function($) {

  if($('body').hasClass('widgets-php')) {
    var current_item;
    var target_id;
    $(document).on('click', '.tcd_widget_tab_content_headline', function(){
      $(this).toggleClass('active');
      $(this).next('.tcd_widget_tab_content').toggleClass('open');
    });
  }

  // タブ記事ウィジェット
  $(document).on('change', '.tcd_widget_tab_content select.tab_post_list_post_type', function(event){
    if ( $(this).val() == 'popular_post' ) {
      $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').show();
      $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').hide();
    } else {
      $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').hide();
      $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').show();
    }
  });
  $('.tcd_widget_tab_content select.tab_post_list_post_type').each(function(){
    if ( $(this).val() == 'popular_post' ) {
      $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').show();
      $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').hide();
    } else {
      $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').hide();
      $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').show();
    }
  });

  $( document ).on( 'widget-added widget-updated', function(event, widget) {
    $('.tcd_widget_tab_content select.tab_post_list_post_type').each(function(){
      if ( $(this).val() == 'popular_post' ) {
        $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').show();
        $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').hide();
      } else {
        $(this).closest('.tcd_widget_tab_content').find('.widget_rank_range').hide();
        $(this).closest('.tcd_widget_tab_content').find('.widget_post_order').show();
      }
    });
  });


});


//カラーピッカー
(function($){
	function initColorPicker(widget) {
		widget.find('.color-picker').wpColorPicker( {
			change: _.throttle(function() { // For Customizer
				$(this).trigger('change');
			}, 3000 )
		});
	}
	function onFormUpdate(event, widget) {
		initColorPicker(widget);
	}
	$(document).on( 'widget-added widget-updated', onFormUpdate );
	$(document).ready( function() {
		$('#widgets-right .widget:has(.color-picker)').each(function(){
			initColorPicker($(this));
		});
	});
}(jQuery));

